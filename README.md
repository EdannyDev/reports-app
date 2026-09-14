# 🚀Sistema Gestor de Reportes de Área - Frontend y Backend  

## 📌Descripción  
Este proyecto es un **sistema gestor de reportes de área**, desarrollado como parte de mi primera estadía profesional en la empresa **Los Cinco Soles**.  

**Usuarios pueden:**  
- Registrar y consultar reportes de diferentes áreas de la empresa.  
- Administrar los datos de los reportes y usuarios.  

Este sistema está diseñado para **agilizar la gestión de información** y mejorar la **trazabilidad de reportes** en la organización.  

## 🛠️Tecnologías utilizadas  

- **Backend: PHP (Laravel 9)** – Framework backend MVC.  
- **Base de datos: MySQL** - Base de datos relacional.
- **Frontend: Bootstrap** – Interfaz moderna y responsiva.  
- **Servidor local: XAMPP** - (Apache + MySQL + PHP).  

## ⚙️Instalación y ejecución  

```bash
# 1. Clonar el repositorio
git clone https://github.com/EdannyDev/reports-app.git

# 2. Mover los archivos al directorio de XAMPP
htdocs/reports-app

# 3. Crear una base de datos en MySQL llamada:
CREATE DATABASE reports_db;

# 4. Configurar el archivo .env de Laravel

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reports_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Instalar dependencias de Laravel con Composer:
composer install

# 6. Ejecutar migraciones y seeders (para crear tablas y datos iniciales):
php artisan migrate --seed

# 7. Ejecutar el servidor de desarrollo de Laravel:
php artisan serve

# 8. Abrir en el navegador:
http://localhost:8000

```

## ✨Características principales
- Registro y gestión de reportes de diferentes áreas.
- Listados y búsqueda de reportes por área y usuario.
- Interfaz responsiva desarrollada con Bootstrap.
