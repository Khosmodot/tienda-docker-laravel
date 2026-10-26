<?php
namespace Tests\Feature;
use App\Models\Producto;
use Database\Seeders\ProductoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ProductosTest extends TestCase
{
    use RefreshDatabase;
    public function test_lista_los_cinco_productos_con_precios_en_guaranies(): void
    {
        $this->seed(ProductoSeeder::class);
        $this->seed(ProductoSeeder::class);
        $this->assertDatabaseCount('productos', 5);
        $response = $this->get('/productos')->assertOk();
        foreach (['Chipa', 'Mbejú', 'Cocido', 'Sopa paraguaya', 'Chipa guasu'] as $nombre) {
            $response->assertSee($nombre);
        }
        $response->assertSee('Gs. 5.000')->assertSee('Gs. 10.000');
    }
    public function test_muestra_un_estado_vacio(): void
    {
        $this->get('/productos')->assertOk()->assertSee('Todavía no hay productos disponibles.');
    }
    public function test_escapa_el_nombre_del_producto(): void
    {
        Producto::create(['nombre' => '<script>alert(1)</script>', 'precio' => 1000]);
        $this->get('/productos')->assertOk()->assertSee('&lt;script&gt;', false)->assertDontSee('<script>', false);
    }
}
