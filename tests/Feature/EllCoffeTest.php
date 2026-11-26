<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
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

    public function test_public_home_displays_profile_categories_and_products(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('EllCoffe');
        $response->assertSee('PT EllCoffe Nusantara');
        $response->assertSee('Signature Espresso');
        $response->assertSee('EllCoffe Aren Latte');
    }

    public function test_public_home_can_filter_by_category(): void
    {
        $manualBrew = Category::where('name', 'Manual Brew Nusantara')->firstOrFail();

        $response = $this->get('/?category=' . $manualBrew->id);

        $response->assertStatus(200);
        $response->assertSee('V60 Aceh Gayo Wine');
        $response->assertDontSee('EllCoffe Aren Latte');
    }

    public function test_public_detail_page_displays_product(): void
    {
        $product = Product::firstOrFail();

        $response = $this->get('/produk/' . $product->id);

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Rp ' . number_format($product->price, 0, ',', '.'));
    }

    public function test_admin_pages_load_successfully(): void
    {
        $product = Product::firstOrFail();

        $this->get('/admin/products')->assertStatus(200)->assertSee('Daftar Menu EllCoffe');
        $this->get('/admin/products/create')->assertStatus(200)->assertSee('Tambah Menu Baru');
        $this->get('/admin/products/' . $product->id . '/edit')->assertStatus(200)->assertSee('Ubah Data Menu');
    }

    public function test_admin_store_validates_input(): void
    {
        $response = $this->post('/admin/products', [
            'category_id' => 99999,
            'name' => '',
            'price' => 500,
            'description' => '',
        ]);

        $response->assertSessionHasErrors(['category_id', 'name', 'price', 'description']);
    }

    public function test_admin_crud_with_image_upload_and_cleanup(): void
    {
        Storage::fake('public');
        $category = Category::firstOrFail();

        $pngBinary = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
        $file1 = UploadedFile::fake()->createWithContent('kopi1.png', $pngBinary);

        $storeResponse = $this->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'Kopi Tubruk Nusantara',
            'price' => 22000,
            'description' => 'Kopi tubruk klasik dengan aroma rempah dan cokelat.',
            'image' => $file1,
        ]);

        $storeResponse->assertRedirect('/admin/products');
        $storeResponse->assertSessionHas('success');

        $product = Product::where('name', 'Kopi Tubruk Nusantara')->firstOrFail();
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists($product->image);
        $oldImage = $product->image;

        // Update dengan gambar baru -> gambar lama harus terhapus
        $file2 = UploadedFile::fake()->createWithContent('kopi2.png', $pngBinary);
        $updateResponse = $this->put('/admin/products/' . $product->id, [
            'category_id' => $category->id,
            'name' => 'Kopi Tubruk Spesial',
            'price' => 25000,
            'description' => 'Kopi tubruk spesial dengan biji pilihan.',
            'image' => $file2,
        ]);

        $updateResponse->assertRedirect('/admin/products');
        $product->refresh();
        $this->assertEquals('Kopi Tubruk Spesial', $product->name);
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($product->image);
        $newImage = $product->image;

        // Delete -> produk dan gambar harus terhapus
        $deleteResponse = $this->delete('/admin/products/' . $product->id);
        $deleteResponse->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($newImage);
    }
}
