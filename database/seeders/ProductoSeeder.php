<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['nombre' => 'Chipa', 'precio' => 5000],
            ['nombre' => 'Mbejú', 'precio' => 7000],
            ['nombre' => 'Cocido', 'precio' => 3000],
            ['nombre' => 'Sopa paraguaya', 'precio' => 10000],
            ['nombre' => 'Chipa guasu', 'precio' => 10000],
        ] as $producto) {
            Producto::firstOrCreate(['nombre' => $producto['nombre']], ['precio' => $producto['precio']]);
        }
    }
}
