<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExportImportController extends Controller
{
    public function showImport()
    {
        return view('admin.import-products');
    }

    public function exportOrdersPdf(Request $request)
    {
        $query = Order::with('user', 'items.product')->latest();
        if ($request->status) $query->where('status', $request->status);
        if ($request->date_from) $query->whereDate('created_at', '>=', $request->date_from);
        if ($request->date_to) $query->whereDate('created_at', '<=', $request->date_to);
        $orders = $query->get();

        $statusLabels = ['pending'=>'Menunggu','processing'=>'Diproses','shipped'=>'Dikirim','delivered'=>'Selesai','cancelled'=>'Dibatalkan'];

        $html = view('admin.exports.orders-pdf', compact('orders', 'statusLabels'))->render();
        $pdf  = app('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('A4', 'landscape');

        SystemLog::create(['level'=>'info','message'=>'Export pesanan PDF ('.$orders->count().' data)','user_id'=>auth()->id(),'ip_address'=>request()->ip()]);

        return $pdf->download('laporan-pesanan-'.now()->format('Ymd-His').'.pdf');
    }

    public function exportOrdersExcel(Request $request)
    {
        $query = Order::with('user', 'items.product')->latest();
        if ($request->status) $query->where('status', $request->status);
        $orders = $query->get();
        $statusLabels = ['pending'=>'Menunggu','processing'=>'Diproses','shipped'=>'Dikirim','delivered'=>'Selesai','cancelled'=>'Dibatalkan'];

        $filename = 'laporan-pesanan-'.now()->format('Ymd-His').'.csv';
        $headers  = ['Content-Type'=>'text/csv; charset=UTF-8','Content-Disposition'=>'attachment; filename="'.$filename.'"'];

        $callback = function () use ($orders, $statusLabels) {
            $f = fopen('php://output', 'w');
            fprintf($f, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($f, ['No. Pesanan','Pelanggan','Email','Total (Rp)','Metode Pembayaran','Status','Alamat Pengiriman','Jumlah Item','Tanggal']);
            foreach ($orders as $o) {
                fputcsv($f, [$o->order_number,$o->user->name??'-',$o->user->email??'-',$o->total_amount,ucwords(str_replace('_',' ',$o->payment_method??'-')),$statusLabels[$o->status]??$o->status,$o->shipping_address,$o->items->count(),$o->created_at->format('d/m/Y H:i')]);
            }
            fclose($f);
        };

        SystemLog::create(['level'=>'info','message'=>'Export pesanan Excel ('.$orders->count().' data)','user_id'=>auth()->id(),'ip_address'=>request()->ip()]);
        return response()->stream($callback, 200, $headers);
    }

    public function exportProductsPdf(Request $request)
    {
        $query = Product::with('category')->latest();
        if ($request->category_id) $query->where('category_id', $request->category_id);
        $products = $query->get();

        $html = view('admin.exports.products-pdf', compact('products'))->render();
        $pdf  = app('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('A4', 'portrait');

        SystemLog::create(['level'=>'info','message'=>'Export produk PDF ('.$products->count().' data)','user_id'=>auth()->id(),'ip_address'=>request()->ip()]);
        return $pdf->download('laporan-produk-'.now()->format('Ymd-His').'.pdf');
    }

    public function exportProductsExcel(Request $request)
    {
        $products = Product::with('category')->latest()->get();
        $filename = 'laporan-produk-'.now()->format('Ymd-His').'.csv';
        $headers  = ['Content-Type'=>'text/csv; charset=UTF-8','Content-Disposition'=>'attachment; filename="'.$filename.'"'];

        $callback = function () use ($products) {
            $f = fopen('php://output', 'w');
            fprintf($f, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($f, ['ID','Nama Produk','Kategori','Harga (Rp)','Stok','Satuan','Status','Deskripsi','Tanggal']);
            foreach ($products as $p) {
                fputcsv($f, [$p->id,$p->name,$p->category->name??'-',$p->price,$p->stock,$p->unit,$p->is_active?'Aktif':'Nonaktif',$p->description,$p->created_at->format('d/m/Y')]);
            }
            fclose($f);
        };

        SystemLog::create(['level'=>'info','message'=>'Export produk Excel ('.$products->count().' data)','user_id'=>auth()->id(),'ip_address'=>request()->ip()]);
        return response()->stream($callback, 200, $headers);
    }

    public function downloadTemplate()
    {
        $headers = ['Content-Type'=>'text/csv; charset=UTF-8','Content-Disposition'=>'attachment; filename="template-import-produk.csv"'];
        $callback = function () {
            $f = fopen('php://output', 'w');
            fprintf($f, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($f, ['nama_produk','kategori_id','harga','stok','satuan','deskripsi','status_aktif']);
            fputcsv($f, ['Vitamin C 500mg','1','25000','100','Tube / 10 Tablet','Vitamin C untuk daya tahan tubuh','1']);
            fputcsv($f, ['Paracetamol 500mg','2','5000','200','Strip / 10 Tablet','Obat penurun demam','1']);
            fputcsv($f, ['Omega-3 Fish Oil','1','120000','30','Botol / 30 Kapsul','Minyak ikan omega 3','1']);
            fclose($f);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'file.required' => 'File import wajib dipilih.',
            'file.mimes'    => 'Format file harus CSV.',
            'file.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $handle = fopen($request->file('file')->getRealPath(), 'r');
        if (!$handle) return back()->with('error', 'Gagal membaca file.');

        $header = null; $imported = 0; $skipped = 0; $errors = []; $rowNum = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $rowNum++;
            if ($rowNum === 1) { $header = array_map('trim', $row); continue; }
            if (empty(array_filter($row))) continue;
            if (count($header) !== count($row)) { $errors[] = "Baris {$rowNum}: Kolom tidak sesuai, dilewati."; $skipped++; continue; }

            $data = array_combine($header, array_map('trim', $row));

            if (empty($data['nama_produk'])) { $errors[] = "Baris {$rowNum}: nama_produk kosong."; $skipped++; continue; }
            if (!is_numeric($data['harga'] ?? '') || floatval($data['harga']) < 0) { $errors[] = "Baris {$rowNum}: harga tidak valid."; $skipped++; continue; }
            if (!is_numeric($data['stok'] ?? '') || intval($data['stok']) < 0) { $errors[] = "Baris {$rowNum}: stok tidak valid."; $skipped++; continue; }

            $catId = intval($data['kategori_id'] ?? 1);
            if (!Category::find($catId)) $catId = Category::first()->id ?? 1;

            Product::create([
                'name'        => $data['nama_produk'],
                'slug'        => Str::slug($data['nama_produk']).'-'.uniqid(),
                'category_id' => $catId,
                'price'       => floatval($data['harga']),
                'stock'       => intval($data['stok']),
                'unit'        => $data['satuan'] ?? 'Pcs',
                'description' => $data['deskripsi'] ?? '',
                'is_active'   => intval($data['status_aktif'] ?? 1) === 1,
            ]);
            $imported++;
        }

        fclose($handle);
        SystemLog::create(['level'=>'info','message'=>"Import produk: {$imported} berhasil, {$skipped} dilewati",'user_id'=>auth()->id(),'ip_address'=>request()->ip()]);

        $msg = "{$imported} produk berhasil diimport.";
        if ($skipped > 0) $msg .= " {$skipped} baris dilewati.";

        return back()->with('import_success', $msg)->with('import_errors', $errors);
    }
}