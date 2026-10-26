# Tienda de sabores

Tarea Docker + Laravel: modelo Producto con nombre y precio, cinco productos mediante seeder y catálogo Blade en `/productos`, con precios en guaraníes. PHP 8.4 + Apache, Laravel 13, MySQL 8.0 y phpMyAdmin.

## Requisitos y arranque

Docker con contenedores Linux y puertos 8080, 8081 y 3308 disponibles. PHP y Composer se ejecutan dentro del contenedor.

Si acabás de clonar el repositorio y no tenés `.env`, crealo antes de arrancar Docker:

```sh
cp .env.example .env
```

Si ya existe, conservá tu `.env`. Para MySQL, Laravel usa `DB_CONNECTION=mysql`, `DB_HOST=db` y `DB_PORT=3306`. Las credenciales deben corresponder a las del volumen existente: cambiar `.env` no cambia la contraseña de una base ya creada.

```sh
docker compose up -d --build
docker compose logs -f app
```

Cuando Apache esté listo, salí de los registros con Ctrl+C y ejecutá:

```sh
docker compose exec app php artisan migrate --seed
```

El arranque instala las dependencias de `composer.lock`, prepara permisos y genera la clave solamente si falta. MySQL tiene un control de salud; la aplicación y phpMyAdmin esperan a que esté disponible.

- Catálogo: http://localhost:8080/productos
- phpMyAdmin: http://localhost:8081
- MySQL desde el equipo: `127.0.0.1:3308`
- Ejemplo original conservado: http://localhost:8080/hola

## Productos

| Producto | Precio |
| --- | ---: |
| Chipa | Gs. 5.000 |
| Mbejú | Gs. 7.000 |
| Cocido | Gs. 3.000 |
| Sopa paraguaya | Gs. 10.000 |
| Chipa guasu | Gs. 10.000 |

Son precios de ejemplo. El seeder agrega los productos que falten, sin duplicar nombres ni actualizar precios existentes. Conserva también los productos propios. La vista muestra los registros de MySQL, escapa los nombres y contempla la lista vacía.

## phpMyAdmin y la red Docker

Ingresá con `DB_USERNAME` y `DB_PASSWORD` de tu `.env`; seleccioná la base indicada en `DB_DATABASE`. Para una instalación nueva, `.env.example` contiene credenciales locales de ejemplo.

`PMA_HOST=db` apunta al servicio MySQL mediante la red de Compose. Dentro del contenedor de phpMyAdmin, `localhost` apunta al propio phpMyAdmin. Por eso tanto phpMyAdmin como Laravel usan `db:3306`, mientras el equipo accede por `127.0.0.1:3308`.

## Archivos de la tarea

- `app/Models/Producto.php`: modelo con nombre y precio.
- `database/migrations/2026_10_26_122600_create_productos_table.php`: tabla productos.
- `database/seeders/ProductoSeeder.php`: cinco productos sin sobrescribir datos.
- `app/Http/Controllers/ProductoController.php`: consulta del catálogo.
- `resources/views/productos/index.blade.php`: lista Blade con precios en guaraníes.
- `routes/web.php`: `/productos`, redirección desde `/` y `/hola`.
- `compose.yaml`: app, db y phpmyadmin.
- `captura-productos-docker.png`: captura real del catálogo servido por Docker con MySQL.

La consigna utiliza `php artisan make:model Producto -mcrs` para generar la estructura. Los archivos terminados ya están incluidos: no repitas ese comando sobre esta implementación, porque puede crear otra migración. Para reproducir la generación, usá un proyecto Laravel vacío dentro del contenedor.

## Validación

```sh
docker compose config --quiet
docker compose ps
docker compose exec app php artisan migrate:status
docker compose exec app php artisan route:list --path=productos
docker compose exec app php artisan test --compact
```

Validado el 26/10/2026: construcción y arranque con Docker, migración y seeder en MySQL, cinco productos, repetición del seeder sin duplicados, HTTP 200 en catálogo y phpMyAdmin, y conexión desde phpMyAdmin a MySQL. Seis pruebas correctas, 20 aserciones. Las pruebas usan SQLite en memoria, separado de la base MySQL; la imagen incluye la extensión necesaria.

La integración conservó el `.env` original byte por byte y el volumen existente `tienda_datos_db`. Los respaldos privados se guardaron fuera del repositorio, en `/home/josue/proyectos/respaldos/tienda-20261026`.

## Trabajo diario y datos

```sh
docker compose up -d
docker compose down
docker compose logs app
docker compose exec app php artisan migrate --seed
```

`docker compose down` conserva el volumen `datos_db`. No uses `down -v`, `migrate:fresh` ni `db:wipe` si necesitás conservar los datos. La migración integrada agrega la tabla productos sin recrear las tablas anteriores.

## GitHub

`.env`, dependencias y archivos temporales están excluidos. `.env.example`, `composer.lock` y la captura final se incluyen. Los respaldos con credenciales y datos quedan fuera del repositorio.

Repositorio privado: https://github.com/Khosmodot/tienda-docker-laravel

El estado y las evidencias están en `ESTADO-ENTREGA.md`.
