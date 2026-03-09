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
                ['image' => 'images/ceramics/ceramics-large-pot2.webp', 'name' => 'Ceramic Large Pot 2'],
                ['image' => 'images/ceramics/ceramics-large-pot3.webp', 'name' => 'Ceramic Large Pot 3'],
                ['image' => 'images/ceramics/ceramics-large-pot5.webp', 'name' => 'Ceramic Large Pot 5'],
                ['image' => 'images/ceramics/ceramics-large-pot6.webp', 'name' => 'Ceramic Large Pot 6'],
                ['image' => 'images/ceramics/ceramics-large-pot7.webp', 'name' => 'Ceramic Large Pot 7'],
                ['image' => 'images/ceramics/ceramics-large-pot8.webp', 'name' => 'Ceramic Large Pot 8'],
                ['image' => 'images/ceramics/ceramics-large-pot9.webp', 'name' => 'Ceramic Large Pot 9'],
                ['image' => 'images/ceramics/ceramics-large-pot10.webp', 'name' => 'Ceramic Large Pot 10'],
            ],
            'medium' => [
                ['image' => 'images/ceramics/ceramics-medium-pot1.webp', 'name' => 'Ceramic Medium Pot 1'],
                ['image' => 'images/ceramics/ceramics-medium-pot2.jpg', 'name' => 'Ceramic Medium Pot 2'],
                ['image' => 'images/ceramics/ceramics-medium-pot3.webp', 'name' => 'Ceramic Medium Pot 3'],
                ['image' => 'images/ceramics/ceramics-medium-pot4.webp', 'name' => 'Ceramic Medium Pot 4'],
                ['image' => 'images/ceramics/ceramics-medium-pot5.avif', 'name' => 'Ceramic Medium Pot 5'],
            ],
            'small' => [
                ['image' => 'images/ceramics/ceramics-small-pot1.webp', 'name' => 'Ceramic Small Pot 1'],
                ['image' => 'images/ceramics/ceramics-small-pot2.jfif', 'name' => 'Ceramic Small Pot 2'],
                ['image' => 'images/ceramics/ceramics-small-pot3.jpg', 'name' => 'Ceramic Small Pot 3'],
                ['image' => 'images/ceramics/ceramics-small-pot4.webp', 'name' => 'Ceramic Small Pot 4'],
                ['image' => 'images/ceramics/ceramics-small-pot5.avif', 'name' => 'Ceramic Small Pot 5'],
                ['image' => 'images/ceramics/ceramics-small-pot6.jpg', 'name' => 'Ceramic Small Pot 6'],
            ],
        ];
        return view('products.pots.ceramics', compact('products'));
    }

    public function cement()
    {
        $products = [
            'large' => [
                ['image' => 'images/cement/cement-large-pot1.jpg', 'name' => 'Cement Large Pot 1'],
                ['image' => 'images/cement/cement-large-pot2.webp', 'name' => 'Cement Large Pot 2'],
                ['image' => 'images/cement/cement-large-pot3.webp', 'name' => 'Cement Large Pot 3'],
                ['image' => 'images/cement/cement-large-pot4.webp', 'name' => 'Cement Large Pot 4'],
                ['image' => 'images/cement/cement-large-pot5.webp', 'name' => 'Cement Large Pot 5'],
            ],
            'medium' => [
                ['image' => 'images/cement/cement-medium-pot1.webp', 'name' => 'Cement Medium Pot 1'],
                ['image' => 'images/cement/cement-medium-pot2.jpg', 'name' => 'Cement Medium Pot 2'],
                ['image' => 'images/cement/cement-medium-pot3.webp', 'name' => 'Cement Medium Pot 3'],
                ['image' => 'images/cement/cement-medium-pot4.webp', 'name' => 'Cement Medium Pot 4'],
                ['image' => 'images/cement/cement-medium-pot5.webp', 'name' => 'Cement Medium Pot 5'],
            ],
            'small' => [
                ['image' => 'images/cement/cement-small-pot1.jpg', 'name' => 'Cement Small Pot 1'],
                ['image' => 'images/cement/cement-small-pot2.webp', 'name' => 'Cement Small Pot 2'],
                ['image' => 'images/cement/cement-small-pot3.webp', 'name' => 'Cement Small Pot 3'],
                ['image' => 'images/cement/cement-small-pot4.webp', 'name' => 'Cement Small Pot 4'],
                ['image' => 'images/cement/cement-small-pot5.webp', 'name' => 'Cement Small Pot 5'],
            ],
        ];
        return view('products.pots.cement', compact('products'));
    }

    public function mud()
    {
        $products = [
            ['image' => 'images/mud/mud-large-pot1.webp', 'name' => 'Mud Pot 1'],
            ['image' => 'images/mud/mud-large-pot2.webp', 'name' => 'Mud Pot 2'],
            ['image' => 'images/mud/mud-large-pot3.webp', 'name' => 'Mud Pot 3'],
            ['image' => 'images/mud/mud-large-pot4.webp', 'name' => 'Mud Pot 4'],
            ['image' => 'images/mud/mud-large-pot5.webp', 'name' => 'Mud Pot 5'],
        ];
        return view('products.pots.mud', compact('products'));
    }

    public function plastic()
    {
        $products = [
            'large' => [
                ['image' => 'images/plastic/plastic-large-pot1.jpg', 'name' => 'Plastic Large Pot 1'],
                ['image' => 'images/plastic/plastic-large-pot2.jpg', 'name' => 'Plastic Large Pot 2'],
                ['image' => 'images/plastic/plastic-large-pot3.jpeg', 'name' => 'Plastic Large Pot 3'],
                ['image' => 'images/plastic/plastic-large-pot4.jpeg', 'name' => 'Plastic Large Pot 4'],
                ['image' => 'images/plastic/plastic-large-pot5.jpeg', 'name' => 'Plastic Large Pot 5'],
            ],
            'medium' => [
                ['image' => 'images/plastic/plastic-medium-pot.jpg', 'name' => 'Plastic Medium Pot'],
                ['image' => 'images/plastic/plastic-medium-pot1.png', 'name' => 'Plastic Medium Pot 1'],
                ['image' => 'images/plastic/plastic-medium-pot2.png', 'name' => 'Plastic Medium Pot 2'],
                ['image' => 'images/plastic/plastic-medium-pot3.webp', 'name' => 'Plastic Medium Pot 3'],
                ['image' => 'images/plastic/plastic-medium-pot4.webp', 'name' => 'Plastic Medium Pot 4'],
            ],
            'small' => [
                ['image' => 'images/plastic/plastic-small-pot1.webp', 'name' => 'Plastic Small Pot 1'],
                ['image' => 'images/plastic/plastic-small-pot2.webp', 'name' => 'Plastic Small Pot 2'],
                ['image' => 'images/plastic/plastic-small-pot3.webp', 'name' => 'Plastic Small Pot 3'],
                ['image' => 'images/plastic/plastic-small-pot4.webp', 'name' => 'Plastic Small Pot 4'],
            ],
        ];
        return view('products.pots.plastic', compact('products'));
    }

    public function plants()
    {
        $products = [
            ['image' => 'images/Plants/Aloevera.jfif', 'name' => 'Aloe Vera'],
            ['image' => 'images/Plants/Aloevera2.jfif', 'name' => 'Aloe Vera'],
            ['image' => 'images/Plants/Boston_Fern.webp', 'name' => 'Boston Fern'],
            ['image' => 'images/Plants/Boston_Fern2.webp', 'name' => 'Boston Fern'],
            ['image' => 'images/Plants/money_plant.webp', 'name' => 'Money Plant'],
            ['image' => 'images/Plants/money_plant1.webp', 'name' => 'Money Plant'],
            ['image' => 'images/Plants/snake_plant.webp', 'name' => 'Snake Plant'],
            ['image' => 'images/Plants/snake_plant1.webp', 'name' => 'Snake Plant'],
            ['image' => 'images/Plants/spider_plant.webp', 'name' => 'Spider Plant'],
            ['image' => 'images/Plants/spider_plant2.webp', 'name' => 'Spider Plant'],
        ];
        return view('products.plants', compact('products'));
    }
}