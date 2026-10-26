<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Operations\Repositories\ProductRepository;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Operations\Repositories\CategoryRepository;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Operations\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
