<?php

namespace App\Contracts;

interface ProductRepositoryInterface
{
    public function all();
    public function findBySlug(string $slug);
    public function paginate(int $perPage = 12);
    public function create(array $data);
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getLowStock(int $threshold = 5);
}
