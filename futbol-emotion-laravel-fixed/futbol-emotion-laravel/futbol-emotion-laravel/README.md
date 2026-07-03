# Fútbol Emotion — Backend Laravel

## Requisitos del servidor
- PHP 8.1 o superior
- Composer
- MySQL 5.7 o superior
- Extensiones PHP: mbstring, xml, curl, mysql, zip, bcmath

---

## Instalación en el servidor (paso a paso)

### 1. Conectarte al servidor por SSH
```bash
ssh usuario@IP_DEL_SERVIDOR
```

### 2. Ir a la carpeta web
```bash
cd /var/www/html
```

### 3. Subir este proyecto
Puedes usar FTP (FileZilla) o SCP:
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
DB_PASSWORD=tu_contraseña_mysql
```

### 7. Crear la base de datos en MySQL
```bash
mysql -u root -p
CREATE DATABASE futbol_emotion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 8. Ejecutar migraciones (crea las tablas)
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
