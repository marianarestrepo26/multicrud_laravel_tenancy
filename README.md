# Sistema Multi-Tenant Laravel - MultiStore

Este proyecto es una implementación de arquitectura Multi-Inquilino (Multi-Tenancy) utilizando **Laravel 11** y el paquete **stancl/tenancy**.
Permite gestionar múltiples tiendas independientes desde un único panel central, donde cada tienda tiene su propio dominio, base de datos e inventario aislado.

## 🚀 Características Principales

### 🏢 Dominio Central (Administración Global)
- **Gestión de Tenants**: Crear, editar, eliminar y suspender tiendas.
- **Gestión de Administradores**: Control de usuarios con acceso al panel central.
- **Gestión de Admins de Tienda**: Crear usuarios administradores directamente en las tiendas desde el panel central.
- **Panel de Control**: Interfaz limpia usando Bootstrap 5.

### 🏪 Dominio del Tenant (Tiendas)
- **Aislamiento Total**: Base de datos independiente por tenant.
- **Catálogo Público**: Landing page pública con listado de productos visible sin login.
- **Panel de Administración Privado**: Dashboard para que cada dueño de tienda gestione su inventario.
- **Autenticación Independiente**: Los usuarios de una tienda no existen en otra.
- **Gestión de Inventario**: CRUD de productos con carga de imágenes.

## 🛠️ Requisitos Técnicos

- PHP 8.2+
- MySQL 5.7+ / 8.0+
- Composer
- Node.js (opcional, para assets si se compilan, aquí se usa CDN)

## 📦 Instalación y Despliegue

1. **Clonar el repositorio**
   ```bash
   git clone <URL_REPO>
   cd MultiCRUD
   ```

2. **Instalar Dependencias**
   ```bash
   composer install
   ```

3. **Configurar Entorno**
   - Copiar `.env.example` a `.env`
   - Configurar base de datos (DB_HOST, DB_PASSWORD, etc).
   - **IMPORTANTE**: El usuario de BD debe tener permisos para CREAR nuevas bases de datos.

4. **Generar Key y Migrar**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
   *(Esto creará las tablas del dominio central)*

5. **Poblar Datos de Prueba (Seed)**
   El proyecto incluye un seeder que crea 1 Admin Central y 5 Tenants con datos de prueba.
   ```bash
   php artisan db:seed --class=DemoSeeder
   ```

6. **Configurar Dominios Locales**
   Para probar en local, debes agregar los siguientes dominios a tu archivo `/etc/hosts` (o `C:\Windows\System32\drivers\etc\hosts`):
   ```text
   127.0.0.1 localhost
   127.0.0.1 cocina.localhost
   127.0.0.1 ferreteria.localhost
   127.0.0.1 joyeria.localhost
   127.0.0.1 gamer.localhost
   127.0.0.1 papeleria.localhost
   ```

## 🔑 Credenciales de Acceso

### Panel Central (http://localhost)
- **Admin**: `admin@central.com`
- **Password**: `password`
- **Ruta Admin**: Visitar la raíz o `/admins` una vez logueado.

### Tiendas de Prueba

| Tienda | URL | Admin User | Password |
|--------|-----|------------|----------|
| **Todo Cocina** | http://cocina.localhost | `admin@cocina.com` | `password` |
| **Ferretería** | http://ferreteria.localhost | `admin@ferreteria.com` | `password` |
| **Joyería** | http://joyeria.localhost | `admin@joyeria.com` | `password` |
| **Gamer Zone** | http://gamer.localhost | `admin@gamer.com` | `password` |
| **Papelería** | http://papeleria.localhost | `admin@papeleria.com` | `password` |

Cada tienda tiene su propio login en `/login` y su panel en `/admin`.

## 📂 Estructura del Proyecto

- `routes/web.php`: Rutas del dominio central.
- `routes/tenant.php`: Rutas de los tenants (catálogo y admin local).
- `app/Http/Controllers/Central`: Controladores del admin central.
- `app/Http/Controllers/Tenant`: Controladores de las tiendas.
- `resources/views/central`: Vistas del panel central.
- `resources/views/tenant`: Vistas de las tiendas.

---
Proyecto desarrollado como demostración de Multi-Tenancy en Laravel.
