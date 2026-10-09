<?php

namespace App\Operations\Services;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\FileStorageServiceInterface;
use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceInterface
{
    protected ProductRepositoryInterface $productRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    protected FileStorageServiceInterface $fileStorageService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        FileStorageServiceInterface $fileStorageService
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->fileStorageService = $fileStorageService;
    }

    public function getAllProducts(): Collection
    {
        return Cache::store('redis')->rememberForever('admin_products', function () {
            return $this->productRepository->all();
        });
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->all();
    }

    public function createProduct(array $data, ?object $image, ?array $otherPhotos): Product
    {
        if ($image) {
            $data['image'] = $this->fileStorageService->store($image, 'products');
        }

        $product = $this->productRepository->create($data);

        if ($otherPhotos) {
            foreach ($otherPhotos as $photo) {
                $photoPath = $this->fileStorageService->store($photo, 'products/photos');
                $this->productRepository->addPhoto($product, $photoPath);
            }
        }

        Cache::store('redis')->forget('admin_products');
        Cache::store('redis')->forget('user_categories_with_products');

        return $product;
    }

    public function updateProduct(Product $product, array $data, ?object $image, ?array $otherPhotos): bool
    {
        if ($image) {
            if ($product->image) {
                $this->fileStorageService->delete($product->image);
            }
            $data['image'] = $this->fileStorageService->store($image, 'products');
        } else {
            unset($data['image']);
        }

        $this->productRepository->update($product->id, $data);

        if ($otherPhotos) {
            foreach ($otherPhotos as $photo) {
                $photoPath = $this->fileStorageService->store($photo, 'products/photos');
                $this->productRepository->addPhoto($product, $photoPath);
            }
        }

        Cache::store('redis')->forget('admin_products');
        Cache::store('redis')->forget('user_categories_with_products');

        return true;
    }

    public function deleteProduct(Product $product): bool
    {
        if ($product->image) {
            $this->fileStorageService->delete($product->image);
        }

        foreach ($product->product_photos as $photo) {
            $this->fileStorageService->delete($photo->photo);
        }

        $deleted = $this->productRepository->delete($product->id);

        if ($deleted) {
            Cache::store('redis')->forget('admin_products');
            Cache::store('redis')->forget('user_categories_with_products');
        }

        return $deleted;
    }
}
