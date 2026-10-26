# Tienda de sabores

Aplicación de la tarea Docker + Laravel: catálogo en Blade, MySQL y phpMyAdmin.

## Requisitos

Docker Desktop encendido con contenedores Linux. Puertos 8080, 8081 y 3308 disponibles.
No hace falta instalar PHP, Composer, Node ni MySQL en la computadora.

## Puesta en marcha

Desde esta carpeta:

```sh
docker compose up -d --build
```

El primer arranque instala las dependencias de `composer.lock`, crea `.env` a partir de `.env.example`, genera la clave de Laravel y prepara los permisos. Esperá a que los registros indiquen que Apache arrancó:

```sh
docker compose logs -f app
```

Salí de los registros con Ctrl+C y ejecutá:

```sh
docker compose exec app php artisan migrate --seed
```

Abrí http://localhost:8080/productos. El seeder carga estos productos de ejemplo:

| Producto | Precio |
| --- | ---: |
| Chipa | Gs. 5.000 |
| Mbejú | Gs. 7.000 |
| Cocido | Gs. 3.000 |
| Sopa paraguaya | Gs. 10.000 |
| Chipa guasu | Gs. 10.000 |

El seeder se puede repetir sin duplicar los cinco registros. Los precios son datos de ejemplo de la tarea.

## phpMyAdmin

Abrí http://localhost:8081 y usá el usuario `root`, contraseña `secreto`, base `laravel`.
Las credenciales de `.env.example` son para desarrollo local. Si las cambiás, hacelo antes de crear el volumen de MySQL por primera vez.

**¿Por qué PMA_HOST es db y no localhost?** Docker Compose conecta los servicios a una red y resuelve sus nombres. `db` identifica el contenedor de MySQL. Dentro de phpMyAdmin, `localhost` apunta al propio contenedor de phpMyAdmin, donde no corre MySQL. Laravel también usa `DB_HOST=db` y el puerto interno 3306. Desde Windows se usa `127.0.0.1:3308`.

## Archivos de la tarea

- `app/Models/Producto.php`: modelo con nombre y precio.
- `database/migrations/*_create_productos_table.php`: tabla productos.
- `database/seeders/ProductoSeeder.php`: cinco productos.
- `app/Http/Controllers/ProductoController.php`: consulta y vista.
- `resources/views/productos/index.blade.php`: lista con precios en guaraníes.
- `routes/web.php`: ruta `/productos`, redirección desde `/` y ejemplo `/hola`.
- `compose.yaml`: servicios app, db y phpmyadmin.

## Artisan y comprobación

El comando pedido por la consigna para generar la estructura inicial es:

```sh
docker compose exec app php artisan make:model Producto -mcrs
```

Los archivos terminados ya están incluidos. No lo repitas sobre ellos. Para reproducir la generación, usá un proyecto Laravel vacío y luego agregá las implementaciones de esta entrega.

```sh
docker compose exec app php artisan route:list --path=productos
docker compose exec app php artisan test
docker compose exec app php artisan migrate:status
```

Las pruebas de la aplicación usan SQLite en memoria, sin modificar la base MySQL. Si querés ejecutarlas en el contenedor, la imagen instala las extensiones SQLite necesarias.

## Trabajo diario

```sh
docker compose up -d
docker compose down
docker compose logs app
docker compose exec app php artisan migrate --seed
```

`down` conserva la base en el volumen `datos_db`. No hace falta borrar volúmenes para usar la aplicación.

## Entrega en GitHub

`.env`, `vendor`, `node_modules` y archivos temporales están excluidos. `.env.example` y `composer.lock` sí se incluyen.

Con GitHub CLI autenticado, desde esta carpeta:

```sh
gh repo create tienda-docker-laravel --private --source=. --remote=origin --push
```

El repositorio es privado por defecto. Compartí acceso con el docente o hacelo público según lo que te solicite.
Se incluye `captura-productos-preview.png`, una captura real de la aplicación con PHP temporal y SQLite. Reemplazala por la captura final de `http://localhost:8080/productos` después de arrancar Docker y ejecutar las migraciones. La fecha de entrega indicada por la presentación es el martes 27/10.

## Fuentes técnicas

- Laravel: https://laravel.com/docs/13.x
- Docker y Laravel: https://docs.docker.com/guides/laravel/

## Estado de esta entrega

Consultá `ESTADO-ENTREGA.md` para distinguir las verificaciones realizadas de los pasos que dependen de Docker y del acceso a GitHub.

