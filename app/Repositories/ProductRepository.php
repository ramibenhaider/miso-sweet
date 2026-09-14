<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::with('product_photos')->orderByDesc('created_at')->get();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $product = $this->find($id);
        if ($product) {
            return $product->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $product = $this->find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }

    public function addPhoto(Product $product, string $photoPath): void
    {
        $product->product_photos()->create([
            'photo' => $photoPath,
        ]);
    }
}
