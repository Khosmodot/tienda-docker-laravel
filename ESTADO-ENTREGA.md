# Estado de la entrega

## Realizado

- Proyecto Laravel 13 con Dockerfile basado en el kit de la clase.
- Compose con PHP 8.4 + Apache, MySQL 8.0 y phpMyAdmin en el puerto 8081.
- Modelo, migración, controlador y seeder generados mediante `php artisan make:model Producto -mcrs` y luego implementados.
- Cinco productos, vista Blade en `/productos` y formato `Gs. 5.000`.
- `.env.example`, `composer.lock`, exclusión de `.env` y README con comandos y respuesta sobre `PMA_HOST=db`.
- Repositorio Git local con la implementación.
- Captura `captura-productos-preview.png`: página real en `http://localhost:8080/productos`, ejecutada con PHP temporal y SQLite para la vista previa.

## Verificado

- Cinco pruebas correctas, 17 aserciones: cinco productos, seeder repetible, formato de precios, lista vacía, escape HTML y redirección inicial.
- Migraciones y seeder ejecutados correctamente con SQLite.
- Catálogo abierto e inspeccionado en el navegador.
- Configuración de Compose válida mediante `docker compose config --quiet`.
- `.env` y `vendor` excluidos por Git; `.env.example` incluido.

## Pendiente por acceso al entorno

1. Ejecutar el proyecto con Docker y MySQL. El motor responde con acceso denegado desde esta sesión.
2. Cumplir la evidencia específica de generación con Artisan **dentro del contenedor**. La generación realizada aquí usó PHP temporal, porque Docker no fue accesible. El README incluye el comando para reproducirla en un proyecto vacío dentro del contenedor.
3. Tomar la captura final con la aplicación ejecutándose en Docker. La captura incluida corresponde a la vista previa con SQLite y no certifica conexión a MySQL.
4. Publicar el repositorio y obtener el enlace de GitHub. La credencial existente de GitHub CLI está vencida o es inválida. Autenticarse nuevamente con `gh auth login`, luego seguir el README.

La tarea no está entregada en GitHub ni se ha probado el arranque de los contenedores. No se borró ninguna base de datos o contenedor existente.
