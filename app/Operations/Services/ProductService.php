<?php

namespace App\Operations\Services;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\FileStorageServiceInterface;
use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

    public function getAllProducts(): array
    {
        return Cache::rememberForever('admin_products', function () {
            return $this->productRepository->all();
        });
    }

    public function getAllCategories(): array
    {
        return $this->categoryRepository->all()->toArray();
    }

public function createProduct(array $data, ?UploadedFile $image, ?array $otherPhotos): Product
{
    $uploadedFiles = [];

    try {
        if ($image) {
            $data['image'] = $this->fileStorageService->store($image, 'products');
            $uploadedFiles[] = $data['image'];
        }

        if ($otherPhotos) {
            foreach ($otherPhotos as $photo) {
                $uploadedFiles[] = $this->fileStorageService->store($photo, 'products/photos');
            }
        }

        $product = DB::transaction(function () use ($data, $uploadedFiles) {
            $product = $this->productRepository->create($data);

            $photoOffset = isset($data['image']) ? 1 : 0;
            foreach (array_slice($uploadedFiles, $photoOffset) as $photoPath) {
                $this->productRepository->addPhoto($product, $photoPath);
            }

            return $product;
        });

        Cache::forget('admin_products');
        Cache::forget('user_categories_with_products');

        return $product;

    } catch (\Throwable $e) {
        foreach ($uploadedFiles as $path) {
            $this->fileStorageService->delete($path);
        }
        throw $e;
    }
}


    public function updateProduct(Product $product, array $data, ?UploadedFile $image, ?array $otherPhotos): bool
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

        Cache::forget('admin_products');
        Cache::forget('user_categories_with_products');

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
            Cache::forget('admin_products');
            Cache::forget('user_categories_with_products');
        }

        return $deleted;
    }
}


