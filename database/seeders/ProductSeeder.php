<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ── Ceramics ────────────────────────────────────────────────────
            ['name' => 'Ceramic Large Pot 2',  'image' => 'images/ceramics/ceramics-large-pot2.webp',  'price' => 2500, 'category' => 'ceramics', 'size' => 'large',  'badge' => 'Popular'],
            ['name' => 'Ceramic Large Pot 3',  'image' => 'images/ceramics/ceramics-large-pot3.webp',  'price' => 2800, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],
            ['name' => 'Ceramic Large Pot 5',  'image' => 'images/ceramics/ceramics-large-pot5.webp',  'price' => 3200, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],
            ['name' => 'Ceramic Large Pot 6',  'image' => 'images/ceramics/ceramics-large-pot6.webp',  'price' => 2900, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],
            ['name' => 'Ceramic Large Pot 7',  'image' => 'images/ceramics/ceramics-large-pot7.webp',  'price' => 3500, 'category' => 'ceramics', 'size' => 'large',  'badge' => 'New'],
            ['name' => 'Ceramic Large Pot 8',  'image' => 'images/ceramics/ceramics-large-pot8.webp',  'price' => 3100, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],
            ['name' => 'Ceramic Large Pot 9',  'image' => 'images/ceramics/ceramics-large-pot9.webp',  'price' => 2700, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],
            ['name' => 'Ceramic Large Pot 10', 'image' => 'images/ceramics/ceramics-large-pot10.webp', 'price' => 3300, 'category' => 'ceramics', 'size' => 'large',  'badge' => null],

            ['name' => 'Ceramic Medium Pot 1', 'image' => 'images/ceramics/ceramics-medium-pot1.webp', 'price' => 1800, 'category' => 'ceramics', 'size' => 'medium', 'badge' => null],
            ['name' => 'Ceramic Medium Pot 2', 'image' => 'images/ceramics/ceramics-medium-pot2.jpg',  'price' => 1600, 'category' => 'ceramics', 'size' => 'medium', 'badge' => null],
            ['name' => 'Ceramic Medium Pot 3', 'image' => 'images/ceramics/ceramics-medium-pot3.webp', 'price' => 1900, 'category' => 'ceramics', 'size' => 'medium', 'badge' => null],
            ['name' => 'Ceramic Medium Pot 4', 'image' => 'images/ceramics/ceramics-medium-pot4.webp', 'price' => 2100, 'category' => 'ceramics', 'size' => 'medium', 'badge' => null],
            ['name' => 'Ceramic Medium Pot 5', 'image' => 'images/ceramics/ceramics-medium-pot5.avif', 'price' => 1750, 'category' => 'ceramics', 'size' => 'medium', 'badge' => null],

            ['name' => 'Ceramic Small Pot 1',  'image' => 'images/ceramics/ceramics-small-pot1.webp',  'price' =>  850, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],
            ['name' => 'Ceramic Small Pot 2',  'image' => 'images/ceramics/ceramics-small-pot2.jfif',  'price' =>  750, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],
            ['name' => 'Ceramic Small Pot 3',  'image' => 'images/ceramics/ceramics-small-pot3.jpg',   'price' =>  900, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],
            ['name' => 'Ceramic Small Pot 4',  'image' => 'images/ceramics/ceramics-small-pot4.webp',  'price' =>  800, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],
            ['name' => 'Ceramic Small Pot 5',  'image' => 'images/ceramics/ceramics-small-pot5.avif',  'price' => 1050, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],
            ['name' => 'Ceramic Small Pot 6',  'image' => 'images/ceramics/ceramics-small-pot6.jpg',   'price' =>  950, 'category' => 'ceramics', 'size' => 'small',  'badge' => null],

            // ── Cement ──────────────────────────────────────────────────────
            ['name' => 'Cement Large Pot 1',  'image' => 'images/cement/cement-large-pot1.jpg',   'price' => 1800, 'category' => 'cement', 'size' => 'large',  'badge' => null],
            ['name' => 'Cement Large Pot 2',  'image' => 'images/cement/cement-large-pot2.webp',  'price' => 2000, 'category' => 'cement', 'size' => 'large',  'badge' => null],
            ['name' => 'Cement Large Pot 3',  'image' => 'images/cement/cement-large-pot3.webp',  'price' => 2200, 'category' => 'cement', 'size' => 'large',  'badge' => null],
            ['name' => 'Cement Large Pot 4',  'image' => 'images/cement/cement-large-pot4.webp',  'price' => 1900, 'category' => 'cement', 'size' => 'large',  'badge' => null],
            ['name' => 'Cement Large Pot 5',  'image' => 'images/cement/cement-large-pot5.webp',  'price' => 2400, 'category' => 'cement', 'size' => 'large',  'badge' => 'New'],

            ['name' => 'Cement Medium Pot 1', 'image' => 'images/cement/cement-medium-pot1.webp', 'price' => 1200, 'category' => 'cement', 'size' => 'medium', 'badge' => null],
            ['name' => 'Cement Medium Pot 2', 'image' => 'images/cement/cement-medium-pot2.jpg',  'price' => 1100, 'category' => 'cement', 'size' => 'medium', 'badge' => null],
            ['name' => 'Cement Medium Pot 3', 'image' => 'images/cement/cement-medium-pot3.webp', 'price' => 1300, 'category' => 'cement', 'size' => 'medium', 'badge' => null],
            ['name' => 'Cement Medium Pot 4', 'image' => 'images/cement/cement-medium-pot4.webp', 'price' => 1400, 'category' => 'cement', 'size' => 'medium', 'badge' => null],
            ['name' => 'Cement Medium Pot 5', 'image' => 'images/cement/cement-medium-pot5.webp', 'price' => 1250, 'category' => 'cement', 'size' => 'medium', 'badge' => null],

            ['name' => 'Cement Small Pot 1',  'image' => 'images/cement/cement-small-pot1.jpg',   'price' =>  600, 'category' => 'cement', 'size' => 'small',  'badge' => null],
            ['name' => 'Cement Small Pot 2',  'image' => 'images/cement/cement-small-pot2.webp',  'price' =>  550, 'category' => 'cement', 'size' => 'small',  'badge' => null],
            ['name' => 'Cement Small Pot 3',  'image' => 'images/cement/cement-small-pot3.webp',  'price' =>  650, 'category' => 'cement', 'size' => 'small',  'badge' => null],
            ['name' => 'Cement Small Pot 4',  'image' => 'images/cement/cement-small-pot4.webp',  'price' =>  700, 'category' => 'cement', 'size' => 'small',  'badge' => null],
            ['name' => 'Cement Small Pot 5',  'image' => 'images/cement/cement-small-pot5.webp',  'price' =>  580, 'category' => 'cement', 'size' => 'small',  'badge' => null],

            // ── Mud ─────────────────────────────────────────────────────────
            ['name' => 'Mud Pot 1', 'image' => 'images/mud/mud-large-pot1.webp', 'price' => 350, 'category' => 'mud', 'size' => null, 'badge' => null],
            ['name' => 'Mud Pot 2', 'image' => 'images/mud/mud-large-pot2.webp', 'price' => 400, 'category' => 'mud', 'size' => null, 'badge' => null],
            ['name' => 'Mud Pot 3', 'image' => 'images/mud/mud-large-pot3.webp', 'price' => 300, 'category' => 'mud', 'size' => null, 'badge' => null],
            ['name' => 'Mud Pot 4', 'image' => 'images/mud/mud-large-pot4.webp', 'price' => 450, 'category' => 'mud', 'size' => null, 'badge' => null],
            ['name' => 'Mud Pot 5', 'image' => 'images/mud/mud-large-pot5.webp', 'price' => 380, 'category' => 'mud', 'size' => null, 'badge' => null],

            // ── Plastic ─────────────────────────────────────────────────────
            ['name' => 'Plastic Large Pot 1',  'image' => 'images/plastic/plastic-large-pot1.jpg',    'price' => 800, 'category' => 'plastic', 'size' => 'large',  'badge' => null],
            ['name' => 'Plastic Large Pot 2',  'image' => 'images/plastic/plastic-large-pot2.jpg',    'price' => 850, 'category' => 'plastic', 'size' => 'large',  'badge' => null],
            ['name' => 'Plastic Large Pot 3',  'image' => 'images/plastic/plastic-large-pot3.jpeg',   'price' => 900, 'category' => 'plastic', 'size' => 'large',  'badge' => null],
            ['name' => 'Plastic Large Pot 4',  'image' => 'images/plastic/plastic-large-pot4.jpeg',   'price' => 950, 'category' => 'plastic', 'size' => 'large',  'badge' => null],
            ['name' => 'Plastic Large Pot 5',  'image' => 'images/plastic/plastic-large-pot5.jpeg',   'price' => 780, 'category' => 'plastic', 'size' => 'large',  'badge' => null],

            ['name' => 'Plastic Medium Pot',   'image' => 'images/plastic/plastic-medium-pot.jpg',    'price' => 450, 'category' => 'plastic', 'size' => 'medium', 'badge' => null],
            ['name' => 'Plastic Medium Pot 1', 'image' => 'images/plastic/plastic-medium-pot1.png',   'price' => 480, 'category' => 'plastic', 'size' => 'medium', 'badge' => null],
            ['name' => 'Plastic Medium Pot 2', 'image' => 'images/plastic/plastic-medium-pot2.png',   'price' => 500, 'category' => 'plastic', 'size' => 'medium', 'badge' => null],
            ['name' => 'Plastic Medium Pot 3', 'image' => 'images/plastic/plastic-medium-pot3.webp',  'price' => 420, 'category' => 'plastic', 'size' => 'medium', 'badge' => null],
            ['name' => 'Plastic Medium Pot 4', 'image' => 'images/plastic/plastic-medium-pot4.webp',  'price' => 460, 'category' => 'plastic', 'size' => 'medium', 'badge' => null],

            ['name' => 'Plastic Small Pot 1',  'image' => 'images/plastic/plastic-small-pot1.webp',   'price' => 200, 'category' => 'plastic', 'size' => 'small',  'badge' => null],
            ['name' => 'Plastic Small Pot 2',  'image' => 'images/plastic/plastic-small-pot2.webp',   'price' => 220, 'category' => 'plastic', 'size' => 'small',  'badge' => null],
            ['name' => 'Plastic Small Pot 3',  'image' => 'images/plastic/plastic-small-pot3.webp',   'price' => 180, 'category' => 'plastic', 'size' => 'small',  'badge' => null],
            ['name' => 'Plastic Small Pot 4',  'image' => 'images/plastic/plastic-small-pot4.webp',   'price' => 250, 'category' => 'plastic', 'size' => 'small',  'badge' => null],

            // ── Plants ──────────────────────────────────────────────────────
            ['name' => 'Aloe Vera',                'image' => 'images/Plants/Aloevera.jfif',     'price' => 350, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Aloe Vera (Large)',         'image' => 'images/Plants/Aloevera2.jfif',    'price' => 550, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Boston Fern',               'image' => 'images/Plants/Boston_Fern.webp',  'price' => 450, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Boston Fern (Premium)',     'image' => 'images/Plants/Boston_Fern2.webp', 'price' => 650, 'category' => 'plants', 'size' => null, 'badge' => 'Premium'],
            ['name' => 'Money Plant',               'image' => 'images/Plants/money_plant.webp',  'price' => 300, 'category' => 'plants', 'size' => null, 'badge' => 'Trending'],
            ['name' => 'Money Plant (Potted)',      'image' => 'images/Plants/money_plant1.webp', 'price' => 500, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Snake Plant',               'image' => 'images/Plants/snake_plant.webp',  'price' => 600, 'category' => 'plants', 'size' => null, 'badge' => 'Popular'],
            ['name' => 'Snake Plant (Large)',       'image' => 'images/Plants/snake_plant1.webp', 'price' => 850, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Spider Plant',              'image' => 'images/Plants/spider_plant.webp', 'price' => 400, 'category' => 'plants', 'size' => null, 'badge' => null],
            ['name' => 'Spider Plant (Hanging)',    'image' => 'images/Plants/spider_plant2.webp','price' => 550, 'category' => 'plants', 'size' => null, 'badge' => null],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
