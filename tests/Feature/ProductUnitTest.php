<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user for product management tests
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create a default category
        $this->category = Category::create([
            'name' => 'حلويات عربية',
        ]);
    }

    /**
     * Test creating a product with unit 'للكيلو'.
     */
    public function test_can_create_product_with_per_kg_unit(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post(route('product.store'), [
            'name' => 'بقلاوة بالفستق',
            'price' => 120.00,
            'price_by' => 'للكيلو',
            'category_id' => $this->category->id,
            'description' => 'بقلاوة طازجة فاخرة محشوة بالفستق الحلبي الممتاز',
            'is_available' => 1,
            'image' => UploadedFile::fake()->create('baklava.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'name' => 'بقلاوة بالفستق',
            'price_by' => 'للكيلو',
        ]);
    }

    /**
     * Test creating a product with unit 'للقطعة'.
     */
    public function test_can_create_product_with_per_piece_unit(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post(route('product.store'), [
            'name' => 'كيكة تشيز كيك',
            'price' => 25.00,
            'price_by' => 'للقطعة',
            'category_id' => $this->category->id,
            'description' => 'تشيز كيك بالتوت الطازج غنية ولذيذة',
            'is_available' => 1,
            'image' => UploadedFile::fake()->create('cheesecake.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'name' => 'كيكة تشيز كيك',
            'price_by' => 'للقطعة',
        ]);
    }

    /**
     * Test updating product unit to 'لم يتم التحديد'.
     */
    public function test_can_update_product_unit_to_not_specified(): void
    {
        Storage::fake('public');

        $product = Product::create([
            'name' => 'معمول بالتمر',
            'price' => 45.00,
            'price_by' => 'للكيلو',
            'category_id' => $this->category->id,
            'description' => 'معمول بالتمر الفاخر هش ولذيذ جداً',
            'image' => 'products/maamoul.jpg',
            'is_available' => true,
        ]);

        $response = $this->actingAs($this->admin)->put(route('product.update', $product->id), [
            'name' => 'معمول بالتمر المعدل',
            'price' => 45.00,
            'price_by' => 'لم يتم التحديد',
            'category_id' => $this->category->id,
            'description' => 'معمول بالتمر الفاخر هش ولذيذ جداً ومميز',
            'is_available' => 1,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price_by' => 'لم يتم التحديد',
        ]);
    }
}
