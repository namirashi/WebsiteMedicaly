<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@medicaly.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Demo User
        User::create([
            'name' => 'john',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Categories
        $categories = [
            ['name' => 'Vitamin & Suplemen', 'slug' => 'vitamin-suplemen', 'icon' => 'capsule'],
            ['name' => 'Obat Bebas', 'slug' => 'obat-bebas', 'icon' => 'heart-pulse'],
            ['name' => 'Perawatan Tubuh', 'slug' => 'perawatan-tubuh', 'icon' => 'droplet'],
            ['name' => 'Alat Kesehatan', 'slug' => 'alat-kesehatan', 'icon' => 'thermometer'],
            ['name' => 'Ibu & Anak', 'slug' => 'ibu-anak', 'icon' => 'person-hearts'],
            ['name' => 'Herbal', 'slug' => 'herbal', 'icon' => 'flower1'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Products
        $products = [
            ['name' => 'Blackmores BIO D3 1000 IU', 'category_id' => 1, 'price' => 125000, 'stock' => 50, 'unit' => 'Botol / 60 Kapsul', 'description' => 'Blackmores Vitamin D3 1000 IU untuk memenuhi kebutuhan Vitamin D harian. Mendukung kesehatan tulang, gigi, dan sistem imun.'],
            ['name' => "Scott's Emulsion Cod Liver Oil", 'category_id' => 1, 'price' => 65000, 'stock' => 80, 'unit' => 'Botol / 200ml', 'description' => 'Minyak ikan cod kaya Omega-3, Vitamin A dan D untuk pertumbuhan anak.'],
            ['name' => 'Vitacimin Vitamin C 500mg', 'category_id' => 1, 'price' => 35000, 'stock' => 120, 'unit' => 'Strip / 10 Tablet', 'description' => 'Suplemen Vitamin C 500mg untuk menjaga daya tahan tubuh dan antioksidan.'],
            ['name' => 'Natur-E Advanced 100 IU', 'category_id' => 1, 'price' => 55000, 'stock' => 60, 'unit' => 'Botol / 60 Kapsul', 'description' => 'Vitamin E alami untuk menjaga kesehatan kulit dan antioksidan tubuh.'],
            ['name' => 'Enervon-C Multivitamin', 'category_id' => 1, 'price' => 48000, 'stock' => 100, 'unit' => 'Botol / 30 Tablet', 'description' => 'Kombinasi Vitamin C, B kompleks untuk energi dan imun tubuh.'],
            ['name' => 'Omega-3 Fish Oil 1000mg', 'category_id' => 1, 'price' => 95000, 'stock' => 45, 'unit' => 'Botol / 30 Softgel', 'description' => 'Asam lemak Omega-3 EPA dan DHA untuk kesehatan jantung dan otak.'],
            ['name' => 'Paracetamol 500mg', 'category_id' => 2, 'price' => 12000, 'stock' => 200, 'unit' => 'Strip / 10 Tablet', 'description' => 'Analgetik-antipiretik untuk meringankan demam dan nyeri ringan.'],
            ['name' => 'Antangin JRG Jahe Madu', 'category_id' => 2, 'price' => 18000, 'stock' => 90, 'unit' => 'Sachet isi 12', 'description' => 'Obat masuk angin dengan jahe dan madu alami, menghangatkan tubuh.'],
            ['name' => 'OBH Combi Batuk Berdahak', 'category_id' => 2, 'price' => 28000, 'stock' => 70, 'unit' => 'Botol / 60ml', 'description' => 'Sirup untuk meredakan batuk berdahak dengan rasa mint yang menyegarkan.'],
            ['name' => 'Promag Tablet', 'category_id' => 2, 'price' => 15000, 'stock' => 150, 'unit' => 'Strip / 10 Tablet', 'description' => 'Antasida untuk meredakan nyeri lambung dan maag.'],
            ['name' => 'Ibuprofen 400mg', 'category_id' => 2, 'price' => 22000, 'stock' => 3, 'unit' => 'Strip / 10 Tablet', 'description' => 'NSAID untuk meredakan nyeri sedang, demam, dan peradangan.'],
            ['name' => 'Betadine Antiseptik 30ml', 'category_id' => 3, 'price' => 20000, 'stock' => 110, 'unit' => 'Botol 30ml', 'description' => 'Antiseptik povidone-iodine untuk membersihkan luka dan mencegah infeksi.'],
            ['name' => 'Hansaplast Plester 20pcs', 'category_id' => 3, 'price' => 18500, 'stock' => 85, 'unit' => 'Pack / 20pcs', 'description' => 'Plester steril untuk perawatan luka kecil sehari-hari.'],
            ['name' => 'Tensimeter Digital Omron', 'category_id' => 4, 'price' => 350000, 'stock' => 15, 'unit' => 'Unit', 'description' => 'Alat pengukur tekanan darah digital otomatis dengan layar LCD.'],
            ['name' => 'Termometer Digital', 'category_id' => 4, 'price' => 45000, 'stock' => 40, 'unit' => 'Unit', 'description' => 'Termometer digital akurat untuk mengukur suhu tubuh dalam hitungan detik.'],
            ['name' => 'Masker Medis 3-ply 50pcs', 'category_id' => 4, 'price' => 35000, 'stock' => 200, 'unit' => 'Box / 50pcs', 'description' => 'Masker medis 3 lapisan untuk perlindungan pernapasan.'],
            ['name' => 'Sangobion Kapsul', 'category_id' => 5, 'price' => 42000, 'stock' => 65, 'unit' => 'Botol / 30 Kapsul', 'description' => 'Suplemen zat besi untuk ibu hamil dan menyusui, mencegah anemia.'],
            ['name' => 'Prenagen Mommy Vanilla', 'category_id' => 5, 'price' => 95000, 'stock' => 35, 'unit' => 'Kotak / 400g', 'description' => 'Susu ibu hamil dan menyusui kaya DHA, asam folat, dan kalsium.'],
            ['name' => 'Tolak Angin Sido Muncul', 'category_id' => 6, 'price' => 22000, 'stock' => 130, 'unit' => 'Box / 12 Sachet', 'description' => 'Jamu herbal tradisional untuk mengatasi masuk angin dan perut kembung.'],
            ['name' => 'Temulawak Kapsul', 'category_id' => 6, 'price' => 38000, 'stock' => 75, 'unit' => 'Botol / 60 Kapsul', 'description' => 'Suplemen herbal temulawak untuk menjaga kesehatan liver dan nafsu makan.'],
            ['name' => 'Kunyit Asam Herbal', 'category_id' => 6, 'price' => 18000, 'stock' => 4, 'unit' => 'Botol / 150ml', 'description' => 'Minuman herbal kunyit asam untuk meredakan nyeri haid dan melancarkan pencernaan.'],
        ];
        foreach ($products as $prod) {
            $prod['slug'] = Str::slug($prod['name']) . '-' . uniqid();
            $prod['is_active'] = true;
            Product::create($prod);
        }

    }
}