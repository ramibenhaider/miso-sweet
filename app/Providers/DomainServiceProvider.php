<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\FileStorageServiceInterface;
use App\Operations\Services\FileStorageService;
use App\Contracts\Services\ProductServiceInterface;
use App\Operations\Services\ProductService;
use App\Contracts\Services\UserServiceInterface;
use App\Operations\Services\UserService;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FileStorageServiceInterface::class, FileStorageService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
