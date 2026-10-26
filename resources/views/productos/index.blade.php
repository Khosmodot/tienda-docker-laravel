<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos | Tienda de sabores</title>
    <style>
        :root { color-scheme: light; }
        * { box-sizing: border-box; }
        body { margin: 0; background: #f7f3eb; color: #203a30; font-family: system-ui, sans-serif; }
        header { border-bottom: 1px solid #d4dace; padding: 24px max(6vw, 20px); font-weight: 750; letter-spacing: .04em; }
        main { max-width: 960px; margin: 64px auto; padding: 0 24px; }
        .eyebrow { color: #596c48; text-transform: uppercase; letter-spacing: .15em; font-size: .8rem; font-weight: 700; }
        h1 { font-family: Georgia, serif; font-size: clamp(2.5rem, 7vw, 4.5rem); font-weight: 400; margin: 16px 0; }
        .intro { color: #58675e; line-height: 1.7; max-width: 560px; margin-bottom: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th { text-transform: uppercase; font-size: .75rem; letter-spacing: .12em; color: #58675e; }
        th, td { padding: 22px 12px; text-align: left; border-bottom: 1px solid #d4dace; }
        td { font-size: 1.1rem; }
        th:last-child, td:last-child { text-align: right; white-space: nowrap; }
        td:last-child { font-variant-numeric: tabular-nums; font-weight: 650; }
        caption { text-align: left; color: #58675e; margin-bottom: 16px; }
        footer { margin-top: 32px; color: #58675e; font-size: .85rem; }
    </style>
</head>
<body>
    <header>TIENDA DE SABORES</header>
    <main>
        <p class="eyebrow">Hecho en Paraguay</p>
        <h1>Sabores de casa</h1>
        <p class="intro">Un encuentro con nuestros favoritos de siempre. Consultá los productos y sus precios en guaraníes.</p>
        <table>
            <caption>{{ $productos->count() }} productos disponibles</caption>
            <thead><tr><th scope="col">Producto</th><th scope="col">Precio</th></tr></thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr><td>{{ $producto->nombre }}</td><td>Gs. {{ number_format((float) $producto->precio, 0, ',', '.') }}</td></tr>
                @empty
                    <tr><td colspan="2">Todavía no hay productos disponibles.</td></tr>
                @endforelse
            </tbody>
        </table>
        <footer>Precios expresados en guaraníes paraguayos.</footer>
    </main>
</body>
</html>
