<?php

namespace App\Contracts\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductServiceInterface
{
    public function getAllProducts(): array;
    public function getAllCategories(): array;
    public function createProduct(array $data, ?object $image, ?array $otherPhotos): Product;
    public function updateProduct(Product $product, array $data, ?object $image, ?array $otherPhotos): bool;
    public function deleteProduct(Product $product): bool;
}
