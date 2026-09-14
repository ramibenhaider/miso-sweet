<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();
        $categories = $this->productService->getAllCategories();
        
        return view('admin.products', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['is_available'] = $request->boolean('is_available');

        $this->productService->createProduct(
            $data,
            $request->file('image'),
            $request->file('other_photos')
        );

        return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['is_available'] = $request->boolean('is_available');

        $this->productService->updateProduct(
            $product,
            $data,
            $request->file('image'),
            $request->file('other_photos')
        );

        return redirect()->back()->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }
}
