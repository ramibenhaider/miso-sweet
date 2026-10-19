<?php

namespace App\Operations\Services;

use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Services\FileStorageServiceInterface;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ProductService implements ProductServiceInterface
{

    protected $fileStorageService;
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        FileStorageServiceInterface $fileStorageService,
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->fileStorageService = $fileStorageService;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllProducts(): array
    {
        return Cache::rememberForever('products', function () {
            return $this->productRepository->all()->toArray();
        });
    }

    public function getAllCategories(): array
    {
        return Cache::rememberForever('categories', function () {
            return $this->categoryRepository->all()->toArray();
        });
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

        Cache::forget('products');
        Cache::forget('categories');

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
                $this->productRepository->addPhoto($product, $this->fileStorageService->store($photo, 'products/photos'));
            }
        }

        Cache::forget('products');
        Cache::forget('categories');

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

        $this->productRepository->delete($product->id);

        Cache::forget('products');
        Cache::forget('categories');

        return true;
        
    }

    public function deleteProductPhoto(ProductPhoto $productPhoto): bool
    {
        if ($productPhoto->photo) {

            $this->fileStorageService->delete($productPhoto->photo);
        } else {
            return false;
        }

        $productPhoto->delete();

        Cache::forget('products');

        return true;
    }
}