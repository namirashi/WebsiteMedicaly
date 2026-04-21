use App\Models\Category;

public function run(): void
{
    Category::create(['name' => 'Obat']);
    Category::create(['name' => 'Vitamin']);
    Category::create(['name' => 'Alat Kesehatan']);
}