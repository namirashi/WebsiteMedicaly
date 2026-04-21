<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SystemMonitorController extends Controller
{
    public function index(Request $request)
    {
        // Catat akses monitor ke log
        SystemLog::create([
            'level'      => 'info',
            'message'    => 'Admin mengakses halaman monitor sistem',
            'ip_address' => $request->ip(),
            'user_id'    => auth()->id(),
        ]);

        // Alert stok habis
        $outOfStock = Product::where('stock', 0)->where('is_active', true)->count();
        if ($outOfStock > 0) {
            SystemLog::firstOrCreate(
                ['message' => "ALERT: {$outOfStock} produk kehabisan stok", 'level' => 'warning'],
                ['ip_address' => $request->ip(), 'user_id' => auth()->id()]
            );
        }

        return view('admin.monitor');
    }
}