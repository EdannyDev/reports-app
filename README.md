🚀Sistema Gestor de Reportes de Área - Frontend y Backend

📌Descripción
Este proyecto es un sistema gestor de reportes de área, desarrollado como parte de mi primera estadía profesional en la empresa Los Cinco Soles.

Permite a los usuarios:
-Registrar y consultar reportes de diferentes áreas de la empresa.
-Administrar los datos de los reportes y usuarios.

Este sistema está pensado para agilizar la gestión de información y mejorar la trazabilidad de reportes en la organización.

🛠️Tecnologías utilizadas
-PHP (Laravel 9) – framework backend MVC.
-MySQL – base de datos relacional.
-Bootstrap – frontend responsivo y moderno.
-XAMPP – servidor local (Apache + MySQL + PHP).

⚙️Instalación y ejecución

1.-Clonar el repositorio:
git clone https://github.com/EdannyDev/reports-app.git

2.-Copiar los archivos a tu carpeta de XAMPP (ej. htdocs/reports-app).

3.-Crear una base de datos en MySQL llamada reports_db (o el nombre que prefieras).

4.-Configurar el archivo .env de Laravel con tus credenciales de base de datos y demás variables:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reports_db
DB_USERNAME=root
DB_PASSWORD=

5.-Instalar dependencias de Laravel (si usas Composer):
composer install

6.-Ejecutar migraciones y seeders (para crear tablas y datos iniciales):
php artisan migrate --seed

7.-Ejecutar el servidor de desarrollo de Laravel:
php artisan serve

8.-Abrir en el navegador:
http://localhost:8000

✨Características principales
-Registro y gestión de reportes de diferentes áreas.
-Listados y búsqueda de reportes por área y usuario.
-Interfaz responsiva con Bootstrap.
