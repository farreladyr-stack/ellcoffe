<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EllCoffeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_pages_load_without_login(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Ellcoffee')->assertSee('A Little Coffee, A Lot of Comfort.');
        $this->get('/produk')->assertStatus(200)->assertSee('Ell Latte')->assertSee('Classic Americano');

        $product = Product::firstOrFail();
        $this->get('/produk/' . $product->id)->assertStatus(200)->assertSee($product->name);
    }

    public function test_public_products_filter_by_category(): void
    {
        $nonCoffee = Category::where('name', 'Non Coffee')->firstOrFail();

        $response = $this->get('/produk?category=' . $nonCoffee->id);
        $response->assertStatus(200);
        $response->assertSee('Matcha Ell');
        $response->assertDontSee('Classic Americano');
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
        $this->get('/admin/products')->assertRedirect('/admin/login');
        $this->get('/admin/categories')->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_access_dashboard_and_crud_pages(): void
    {
        $admin = User::where('email', 'admin@ellcoffee.id')->firstOrFail();

        $this->post('/admin/login', [
            'email' => 'admin@ellcoffee.id',
            'password' => 'ellcoffee123',
        ])->assertRedirect('/admin/dashboard');

        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200)->assertSee('Dashboard Admin');
        $this->actingAs($admin)->get('/admin/products')->assertStatus(200)->assertSee('Data Produk Ellcoffee');
        $this->actingAs($admin)->get('/admin/categories')->assertStatus(200)->assertSee('Data Kategori');
    }

    public function test_admin_product_validation_and_crud_with_image(): void
    {
        Storage::fake('public');
        $admin = User::where('email', 'admin@ellcoffee.id')->firstOrFail();
        $category = Category::firstOrFail();

        // Validasi input tidak valid
        $this->actingAs($admin)->post('/admin/products', [
            'category_id' => 99999,
            'name' => '',
            'price' => -500,
            'description' => '',
        ])->assertSessionHasErrors(['category_id', 'name', 'price', 'description']);

        $pngBinary = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
        $file1 = UploadedFile::fake()->createWithContent('latte.png', $pngBinary);

        $this->actingAs($admin)->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'Hazelnut Ell',
            'price' => 28000,
            'description' => 'Espresso lembut dengan sirup hazelnut panggang.',
            'image' => $file1,
        ])->assertRedirect('/admin/products');

        $product = Product::where('name', 'Hazelnut Ell')->firstOrFail();
        Storage::disk('public')->assertExists($product->image);
        $oldImage = $product->image;

        // Update dengan gambar baru
        $file2 = UploadedFile::fake()->createWithContent('latte2.png', $pngBinary);
        $this->actingAs($admin)->put('/admin/products/' . $product->id, [
            'category_id' => $category->id,
            'name' => 'Hazelnut Ell Spesial',
            'price' => 30000,
            'description' => 'Varian spesial dengan cream foam.',
            'image' => $file2,
        ])->assertRedirect('/admin/products');

        $product->refresh();
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($product->image);
        $newImage = $product->image;

        // Hapus produk
        $this->actingAs($admin)->delete('/admin/products/' . $product->id)->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($newImage);
    }

    public function test_admin_category_crud(): void
    {
        $admin = User::where('email', 'admin@ellcoffee.id')->firstOrFail();

        $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Pastry',
            'description' => 'Aneka roti dan kue pendamping kopi.',
        ])->assertRedirect('/admin/categories');

        $category = Category::where('name', 'Pastry')->firstOrFail();

        $this->actingAs($admin)->put('/admin/categories/' . $category->id, [
            'name' => 'Artisan Pastry',
            'description' => 'Roti artisan hangat setiap pagi.',
        ])->assertRedirect('/admin/categories');

        $this->assertDatabaseHas('categories', ['name' => 'Artisan Pastry']);

        $this->actingAs($admin)->delete('/admin/categories/' . $category->id)->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
