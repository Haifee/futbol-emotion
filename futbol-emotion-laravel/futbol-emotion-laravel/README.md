# Fútbol Emotion — Backend Laravel

## Requisitos del servidor
- PHP 8.2 o superior
- Composer
- MySQL 5.7 o superior
- Extensiones PHP: mbstring, xml, curl, mysql, zip, bcmath

---

## Despliegue en Coolify (Nixpacks)

En la configuración del recurso en Coolify:

- **Base Directory:** `/` (raíz del repo, si subes solo esta carpeta como repositorio) o la ruta donde quede este proyecto dentro de tu repo.
- **Publish Directory:** `/public`
- **Install / Build / Start Command:** dejar vacíos, Nixpacks los detecta automáticamente.

### Variables de entorno obligatorias en Coolify
No subas `.env` al repositorio. Configura estas variables directamente en la sección "Environment Variables" de Coolify:

```
APP_NAME="Fútbol Emotion"
APP_ENV=production
APP_KEY=            # generar, ver abajo
APP_DEBUG=false
APP_URL=https://tu-dominio.com

APP_LOCALE=es
APP_FALLBACK_LOCALE=es

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=futbol_emotion
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=file
SESSION_LIFETIME=480

CACHE_STORE=file
QUEUE_CONNECTION=sync
```

### Generar APP_KEY
Localmente (con PHP y Composer instalados) o vía la terminal que Coolify ofrece dentro del contenedor ya desplegado:
```bash
php artisan key:generate --show
```
Copia el valor generado (empieza con `base64:`) y pégalo como `APP_KEY` en las variables de entorno de Coolify. Vuelve a desplegar después de agregarlo.

### Migraciones
Después del primer deploy exitoso, ejecuta las migraciones desde la terminal del contenedor en Coolify:
```bash
php artisan migrate --force
```

---

## Instalación manual alternativa (SSH directo, sin Coolify)

### 1. Conectarte al servidor por SSH
```bash
ssh usuario@IP_DEL_SERVIDOR
```

### 2. Ir a la carpeta web
```bash
cd /var/www/html
```

### 3. Subir este proyecto
```bash
scp -r futbol-emotion-laravel/ usuario@IP:/var/www/html/
```

### 4. Instalar dependencias Laravel
```bash
cd /var/www/html/futbol-emotion-laravel
composer install --no-dev --optimize-autoloader
```

### 5. Configurar el entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 6. Editar .env con los datos de tu base de datos
```
DB_HOST=127.0.0.1
DB_DATABASE=futbol_emotion
DB_USERNAME=tu_usuario_mysql
DB_PASSWORD=tu_contraseña
```

### 7. Crear la base de datos en MySQL
```bash
mysql -u root -p
CREATE DATABASE futbol_emotion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 8. Ejecutar migraciones
```bash
php artisan migrate
```

### 9. Permisos
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 10. Configurar Apache o Nginx
Apuntar el DocumentRoot a: `/var/www/html/futbol-emotion-laravel/public`

---

## Migrar datos del localStorage al servidor
Abre el archivo `public/migrar.html` en el navegador donde tienes la app actual.
Sigue las instrucciones para exportar e importar todos los datos.
