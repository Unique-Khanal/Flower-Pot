<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function pots()
    {
        return view('products.pots.index');
    }

    public function ceramics()
    {
        $products = [
            'large' => [
                ['image' => 'images/ceramics/ceramics-large-pot2.webp', 'name' => 'Ceramic Large Pot 2', 'price' => 2500],
                ['image' => 'images/ceramics/ceramics-large-pot3.webp', 'name' => 'Ceramic Large Pot 3', 'price' => 2800],
                ['image' => 'images/ceramics/ceramics-large-pot5.webp', 'name' => 'Ceramic Large Pot 5', 'price' => 3200],
                ['image' => 'images/ceramics/ceramics-large-pot6.webp', 'name' => 'Ceramic Large Pot 6', 'price' => 2900],
                ['image' => 'images/ceramics/ceramics-large-pot7.webp', 'name' => 'Ceramic Large Pot 7', 'price' => 3500],
                ['image' => 'images/ceramics/ceramics-large-pot8.webp', 'name' => 'Ceramic Large Pot 8', 'price' => 3100],
                ['image' => 'images/ceramics/ceramics-large-pot9.webp', 'name' => 'Ceramic Large Pot 9', 'price' => 2700],
                ['image' => 'images/ceramics/ceramics-large-pot10.webp', 'name' => 'Ceramic Large Pot 10', 'price' => 3300],
            ],
            'medium' => [
                ['image' => 'images/ceramics/ceramics-medium-pot1.webp', 'name' => 'Ceramic Medium Pot 1', 'price' => 1800],
                ['image' => 'images/ceramics/ceramics-medium-pot2.jpg', 'name' => 'Ceramic Medium Pot 2', 'price' => 1600],
                ['image' => 'images/ceramics/ceramics-medium-pot3.webp', 'name' => 'Ceramic Medium Pot 3', 'price' => 1900],
                ['image' => 'images/ceramics/ceramics-medium-pot4.webp', 'name' => 'Ceramic Medium Pot 4', 'price' => 2100],
                ['image' => 'images/ceramics/ceramics-medium-pot5.avif', 'name' => 'Ceramic Medium Pot 5', 'price' => 1750],
            ],
            'small' => [
                ['image' => 'images/ceramics/ceramics-small-pot1.webp', 'name' => 'Ceramic Small Pot 1', 'price' => 850],
                ['image' => 'images/ceramics/ceramics-small-pot2.jfif', 'name' => 'Ceramic Small Pot 2', 'price' => 750],
                ['image' => 'images/ceramics/ceramics-small-pot3.jpg', 'name' => 'Ceramic Small Pot 3', 'price' => 900],
                ['image' => 'images/ceramics/ceramics-small-pot4.webp', 'name' => 'Ceramic Small Pot 4', 'price' => 800],
                ['image' => 'images/ceramics/ceramics-small-pot5.avif', 'name' => 'Ceramic Small Pot 5', 'price' => 1050],
                ['image' => 'images/ceramics/ceramics-small-pot6.jpg', 'name' => 'Ceramic Small Pot 6', 'price' => 950],
            ],
        ];
        return view('products.pots.ceramics', compact('products'));
    }

    public function cement()
    {
        $products = [
            'large' => [
                ['image' => 'images/cement/cement-large-pot1.jpg', 'name' => 'Cement Large Pot 1', 'price' => 1800],
                ['image' => 'images/cement/cement-large-pot2.webp', 'name' => 'Cement Large Pot 2', 'price' => 2000],
                ['image' => 'images/cement/cement-large-pot3.webp', 'name' => 'Cement Large Pot 3', 'price' => 2200],
                ['image' => 'images/cement/cement-large-pot4.webp', 'name' => 'Cement Large Pot 4', 'price' => 1900],
                ['image' => 'images/cement/cement-large-pot5.webp', 'name' => 'Cement Large Pot 5', 'price' => 2400],
            ],
            'medium' => [
                ['image' => 'images/cement/cement-medium-pot1.webp', 'name' => 'Cement Medium Pot 1', 'price' => 1200],
                ['image' => 'images/cement/cement-medium-pot2.jpg', 'name' => 'Cement Medium Pot 2', 'price' => 1100],
                ['image' => 'images/cement/cement-medium-pot3.webp', 'name' => 'Cement Medium Pot 3', 'price' => 1300],
                ['image' => 'images/cement/cement-medium-pot4.webp', 'name' => 'Cement Medium Pot 4', 'price' => 1400],
                ['image' => 'images/cement/cement-medium-pot5.webp', 'name' => 'Cement Medium Pot 5', 'price' => 1250],
            ],
            'small' => [
                ['image' => 'images/cement/cement-small-pot1.jpg', 'name' => 'Cement Small Pot 1', 'price' => 600],
                ['image' => 'images/cement/cement-small-pot2.webp', 'name' => 'Cement Small Pot 2', 'price' => 550],
                ['image' => 'images/cement/cement-small-pot3.webp', 'name' => 'Cement Small Pot 3', 'price' => 650],
                ['image' => 'images/cement/cement-small-pot4.webp', 'name' => 'Cement Small Pot 4', 'price' => 700],
                ['image' => 'images/cement/cement-small-pot5.webp', 'name' => 'Cement Small Pot 5', 'price' => 580],
            ],
        ];
        return view('products.pots.cement', compact('products'));
    }

    public function mud()
    {
        $products = [
            ['image' => 'images/mud/mud-large-pot1.webp', 'name' => 'Mud Pot 1', 'price' => 350],
            ['image' => 'images/mud/mud-large-pot2.webp', 'name' => 'Mud Pot 2', 'price' => 400],
            ['image' => 'images/mud/mud-large-pot3.webp', 'name' => 'Mud Pot 3', 'price' => 300],
            ['image' => 'images/mud/mud-large-pot4.webp', 'name' => 'Mud Pot 4', 'price' => 450],
            ['image' => 'images/mud/mud-large-pot5.webp', 'name' => 'Mud Pot 5', 'price' => 380],
        ];
        shuffle($products);
        return view('products.pots.mud', compact('products'));
    }

    public function plastic()
    {
        $products = [
            'large' => [
                ['image' => 'images/plastic/plastic-large-pot1.jpg', 'name' => 'Plastic Large Pot 1', 'price' => 800],
                ['image' => 'images/plastic/plastic-large-pot2.jpg', 'name' => 'Plastic Large Pot 2', 'price' => 850],
                ['image' => 'images/plastic/plastic-large-pot3.jpeg', 'name' => 'Plastic Large Pot 3', 'price' => 900],
                ['image' => 'images/plastic/plastic-large-pot4.jpeg', 'name' => 'Plastic Large Pot 4', 'price' => 950],
                ['image' => 'images/plastic/plastic-large-pot5.jpeg', 'name' => 'Plastic Large Pot 5', 'price' => 780],
            ],
            'medium' => [
                ['image' => 'images/plastic/plastic-medium-pot.jpg', 'name' => 'Plastic Medium Pot', 'price' => 450],
                ['image' => 'images/plastic/plastic-medium-pot1.png', 'name' => 'Plastic Medium Pot 1', 'price' => 480],
                ['image' => 'images/plastic/plastic-medium-pot2.png', 'name' => 'Plastic Medium Pot 2', 'price' => 500],
                ['image' => 'images/plastic/plastic-medium-pot3.webp', 'name' => 'Plastic Medium Pot 3', 'price' => 420],
                ['image' => 'images/plastic/plastic-medium-pot4.webp', 'name' => 'Plastic Medium Pot 4', 'price' => 460],
            ],
            'small' => [
                ['image' => 'images/plastic/plastic-small-pot1.webp', 'name' => 'Plastic Small Pot 1', 'price' => 200],
                ['image' => 'images/plastic/plastic-small-pot2.webp', 'name' => 'Plastic Small Pot 2', 'price' => 220],
                ['image' => 'images/plastic/plastic-small-pot3.webp', 'name' => 'Plastic Small Pot 3', 'price' => 180],
                ['image' => 'images/plastic/plastic-small-pot4.webp', 'name' => 'Plastic Small Pot 4', 'price' => 250],
            ],
        ];
        return view('products.pots.plastic', compact('products'));
    }

    public function plants()
    {
        $products = [
            ['image' => 'images/Plants/Aloevera.jfif', 'name' => 'Aloe Vera', 'price' => 350],
            ['image' => 'images/Plants/Aloevera2.jfif', 'name' => 'Aloe Vera (Large)', 'price' => 550],
            ['image' => 'images/Plants/Boston_Fern.webp', 'name' => 'Boston Fern', 'price' => 450],
            ['image' => 'images/Plants/Boston_Fern2.webp', 'name' => 'Boston Fern (Premium)', 'price' => 650],
            ['image' => 'images/Plants/money_plant.webp', 'name' => 'Money Plant', 'price' => 300],
            ['image' => 'images/Plants/money_plant1.webp', 'name' => 'Money Plant (Potted)', 'price' => 500],
            ['image' => 'images/Plants/snake_plant.webp', 'name' => 'Snake Plant', 'price' => 600],
            ['image' => 'images/Plants/snake_plant1.webp', 'name' => 'Snake Plant (Large)', 'price' => 850],
            ['image' => 'images/Plants/spider_plant.webp', 'name' => 'Spider Plant', 'price' => 400],
            ['image' => 'images/Plants/spider_plant2.webp', 'name' => 'Spider Plant (Hanging)', 'price' => 550],
        ];
        return view('products.plants', compact('products'));
    }
}
