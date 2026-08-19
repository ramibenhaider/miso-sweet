<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('product_photos')->orderByDesc('created_at')->get();
        $categories = Category::all();
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

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_available'] = $request->boolean('is_available');

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'image' => $data['image'],
            'is_available' => $data['is_available'],
        ]);

        
        if ($request->hasFile('other_photos')) {
            foreach ($request->file('other_photos') as $photo) {
                $photoPath = $photo->store('products/photos', 'public');
                $product->product_photos()->create([
                    'photo' => $photoPath,
                ]);
            }
        }

        return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $new_data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $new_data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($new_data['image']);
        }

        $new_data['is_available'] = $request->boolean('is_available');

        $product->update($new_data);

        if ($request->hasFile('other_photos')) {
            foreach ($request->file('other_photos') as $photo) {
                $photoPath = $photo->store('products/photos', 'public');
                $product->product_photos()->create([
                    'photo' => $photoPath,
                ]);
            }
        }

        return redirect()->back()->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }
}
