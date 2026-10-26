# Estado de la entrega — 26/10/2026

## Integrado y validado

- Solución preparada integrada en `/home/josue/proyectos/tienda`, conservando el historial Git de origen.
- `.env` original idéntico: comparación SHA-256 correcta antes y después.
- Volumen MySQL original `tienda_datos_db` conservado; respaldo SQL previo fuera del repositorio.
- Docker Compose construido y arrancado: app en 8080, MySQL 8.0 saludable y phpMyAdmin en 8081.
- Migraciones anteriores conservadas; migración de productos ejecutada en MySQL.
- Cinco productos consultados directamente en MySQL; seeder repetido sin duplicados.
- Seeder ajustado para conservar precios editados y otros productos.
- Catálogo y phpMyAdmin responden HTTP 200; conexión desde el contenedor de phpMyAdmin a MySQL comprobada con una consulta de los cinco productos.
- Seis pruebas correctas con 20 aserciones, ejecutadas dentro del contenedor usando SQLite en memoria.
- Captura real `captura-productos-docker.png`, tomada con Edge contra `http://localhost:8080/productos` con Laravel en Docker y datos de MySQL.
- README actualizado con arranque, conservación de datos, credenciales desde `.env` y explicación de `PMA_HOST=db`.

## Respaldos privados

`/home/josue/proyectos/respaldos/tienda-20261026`: `.env` original, huella SHA-256, SQL antes y después, y archivos previos a la integración. No se incluyen en Git.

## GitHub

Credencial de GitHub CLI válida. Entrega publicada en el repositorio privado https://github.com/Khosmodot/tienda-docker-laravel, con la captura Docker/MySQL y sin el `.env` ni los respaldos.
