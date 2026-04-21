<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::with('category')->where('is_active', true)->get();
    }
    public function findBySlug(string $slug)
    {
        return Product::where('slug', $slug)->with('reviews.user')->firstOrFail();
    }
    public function paginate(int $perPage = 12)
    {
        return Product::where('is_active', true)->with('category')->paginate($perPage);
    }
    public function create(array $data)
    {
        return Product::create($data);
    }
    public function update(int $id, array $data): bool
    {
        return Product::findOrFail($id)->update($data);
    }
    public function delete(int $id): bool
    {
        return Product::findOrFail($id)->delete();
    }
    public function getLowStock(int $threshold = 5)
    {
        return Product::where('stock', '<', $threshold)->where('is_active', true)->get();
    }
    public function getLowStockFromProcedure(int $threshold = 5)
    {
        return DB::select('CALL GetLowStockProducts(?)', [$threshold]);
    }

}
