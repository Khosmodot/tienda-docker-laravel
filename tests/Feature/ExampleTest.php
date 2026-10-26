<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_redirige_al_catalogo(): void
    {
        $this->get('/')->assertRedirect('/productos');
    }
}
