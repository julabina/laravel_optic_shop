<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\MountAttribute;
use App\Models\OcularAttribute;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductPicture;
use App\Models\TelescopeAttribute;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $mock = json_decode(file_get_contents(storage_path().'/mock-products.json'), true);
        //dd(count($mock['products']), count($mock['productsAttributes']));
        $user = User::factory()->create([
            'firstname' => 'Bob',
            'lastname' => 'Dylan',
            'email' => 'test@test.fr',
        ]);

        //CREATE BRANDS

        Brand::factory()->create([
            'name' => 'Skywatcher',
        ]);
        Brand::factory()->create([
            'name' => 'Takahashi',
        ]);
        Brand::factory()->create([
            'name' => 'Celestron',
        ]);
        Brand::factory()->create([
            'name' => 'Unistellar',
        ]);
        Brand::factory()->create([
            'name' => 'Televue',
        ]);
        Brand::factory()->create([
            'name' => 'Orion',
        ]);
        Brand::factory()->create([
            'name' => 'Pentax',
        ]);
        Brand::factory()->create([
            'name' => 'Explore Scientific',
        ]);
        Brand::factory()->create([
            'name' => 'Baader',
        ]);
        Brand::factory()->create([
            'name' => '10Micron',
        ]);

        //CREATE PRODUCTS

        for ($i = 0; $i < count($mock['products']); $i++) {
            $product = Product::factory()->create([
                'name' => $mock['products'][$i]['name'],
                'price' => $mock['products'][$i]['price'],
                'stock' => $mock['products'][$i]['stock'],
                'category' => $mock['products'][$i]['category'],
                'onDiscount' => $mock['products'][$i]['promo'],
                'discountValue' => $mock['products'][$i]['promoValue'],
                'brand_id' => $mock['productsAttributes'][$i]['brand'],
            ]);

            foreach ($mock['products'][$i]['pictures'] as $key => $picture) {
                ProductPicture::factory()->create([
                    'product_id' => $product->id,
                    'path' => $picture,
                ]);
            }

            ProductDescription::factory()->create([
                'product_id' => $product->id,
                'description' => $mock['products'][$i]['description1'],
            ]);

            if ($mock['products'][$i]['description2'] !== null) {
                ProductDescription::factory()->create([
                    'product_id' => $product->id,
                    'description' => $mock['products'][$i]['description2'],
                ]);
            }

            if ($mock['products'][$i]['descriptionPicture'] !== null) {
                ProductDescription::factory()->create([
                    'product_id' => $product->id,
                    'description' => null,
                    'picturePath' => $mock['products'][$i]['descriptionPicture'],
                ]);
            }

            if ($mock['products'][$i]['description3'] !== null) {
                ProductDescription::factory()->create([
                    'product_id' => $product->id,
                    'description' => $mock['products'][$i]['description3'],
                ]);
            }

            if ($mock['products'][$i]['category'] === 'telescope') {
                TelescopeAttribute::factory()->create([
                    'product_id' => $product->id,
                    'type' => $mock['productsAttributes'][$i]['telescopeType'],
                    'diameter' => $mock['productsAttributes'][$i]['diameter'],
                    'focalLength' => $mock['productsAttributes'][$i]['focal'],
                    'mount' => $mock['productsAttributes'][$i]['mount'],
                ]);
            } elseif ($mock['products'][$i]['category'] === 'monture') {
                MountAttribute::factory()->create([
                    'product_id' => $product->id,
                    'type' => $mock['productsAttributes'][$i]['mountType'],
                    'capacity' => $mock['productsAttributes'][$i]['capacity'],
                    'goto' => $mock['productsAttributes'][$i]['goTo'],
                ]);
            } else {
                OcularAttribute::factory()->create([
                    'product_id' => $product->id,
                    'model' => $mock['productsAttributes'][$i]['oculaireModel'],
                    'focalLength' => $mock['productsAttributes'][$i]['focal'],
                    'fov' => $mock['productsAttributes'][$i]['fov'],
                    'eyeRelief' => $mock['productsAttributes'][$i]['eyeRelief'],
                    'size' => $mock['productsAttributes'][$i]['coulant'],
                ]);
            }
        }
    }
}
