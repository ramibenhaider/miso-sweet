<?php

namespace App\Contracts\Services;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\UploadedFile;

interface ProductServiceInterface
{
    public function getAllProducts(): array;
    public function getAllCategories(): array;
    public function createProduct(array $data, ?UploadedFile $image, ?array $otherPhotos): Product;
    public function updateProduct(Product $product, array $data, ?UploadedFile $image, ?array $otherPhotos): bool;
    public function deleteProduct(Product $product): bool;
    public function deleteProductPhoto(ProductPhoto $productPhoto): bool;
}


