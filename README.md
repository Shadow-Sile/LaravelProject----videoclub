# -> Videoclub — Gestión de Catálogo de Películas

Proyecto desarrollado como práctica de desarrollo web por un estudiante de **19 años** del ciclo de **Desarrollo de Aplicaciones Web (DAW)**. Una aplicación web construida con **Laravel** que simula el sistema de gestión de un videoclub: catálogo de películas con sistema de alquiler, búsqueda y filtrado en tiempo real.

---

## -> ¿Qué hace esta aplicación?

Es un **CRUD con sistema de alquiler** para gestionar un catálogo de películas. A través de una interfaz tipo galería con pósters, el usuario puede:

- Ver el **catálogo completo** de películas en formato grid con pósters
- **Buscar películas** por título con barra de búsqueda
- **Filtrar** el catálogo por disponibilidad (todas / disponibles / alquiladas)
- **Ordenar** alfabéticamente de A→Z o Z→A
- Ver el **detalle completo** de una película (título, año, director, sinopsis)
- **Añadir** nuevas películas al catálogo
- **Editar** los datos de una película existente
- **Eliminar** películas del catálogo
- **Alquilar** una película (marca como no disponible)
- **Devolver** una película (vuelve a estar disponible)

---

## -> Estructura del proyecto

El proyecto sigue la arquitectura **MVC (Modelo - Vista - Controlador)** de Laravel:

### Modelo — `Movie.php`
Define la entidad `Movie` y su conexión con la tabla `movies` de la base de datos. Cada película tiene un campo booleano `rented` que gestiona su estado de disponibilidad.

### Controlador — `CatalogController.php`
Contiene toda la lógica de negocio. Destacan especialmente los métodos de búsqueda/filtrado y el sistema de alquiler:

| Método | Acción |
|--------|--------|
| `index()` | Lista el catálogo con búsqueda, filtros y orden aplicados |
| `create()` | Muestra el formulario de nueva película |
| `new()` | Valida y guarda la nueva película en la BD |
| `show()` | Muestra el detalle de una película por ID |
| `edit()` | Muestra el formulario de edición pre-rellenado |
| `update()` | Valida y actualiza los datos de la película |
| `destroy()` | Elimina una película del catálogo |
| `rent()` | Marca una película como alquilada (`rented = true`) |
| `return()` | Marca una película como devuelta (`rented = false`) |

### Sistema de búsqueda y filtrado
El método `index()` construye la consulta de forma dinámica usando `Movie::query()`, encadenando condiciones solo cuando los parámetros están presentes en la request:

```php
// Búsqueda por título (LIKE)
$query->where('title', 'like', '%' . $request->search . '%');

// Filtro de disponibilidad
$query->where('rented', false); // disponible
$query->where('rented', true);  // alquilada

// Ordenación alfabética
$query->orderBy('title', 'asc');  // A→Z
$query->orderBy('title', 'desc'); // Z→A
```

### Vistas — `resources/views/catalog/`
Las vistas usan **Blade** y **Bootstrap 5**. El catálogo se presenta en formato **grid de pósters** con un efecto hover que muestra la información de la película. Cada tarjeta incluye un badge de color indicando si está disponible (verde) o alquilada (rojo).

- `index.blade.php` — grid de películas con barra de búsqueda y filtros
- `create.blade.php` — formulario para añadir una película
- `show.blade.php` — vista detalle con opciones de alquilar/devolver
- `edit.blade.php` — formulario de edición pre-rellenado
- `new.blade.php` / `update.blade.php` — procesamiento de formularios

### Rutas — `routes/web.php`
Las rutas cubren todos los endpoints del CRUD más las acciones específicas de alquiler, usando los métodos HTTP semánticamente correctos (`GET`, `PUT`, `DELETE`, `PATCH`):

```
GET    /catalog              → listado con filtros
GET    /catalog/create       → formulario nueva película
PUT    /catalog/new          → guardar nueva película
GET    /catalog/show/{id}    → detalle de película
GET    /catalog/edit/{id}    → formulario edición
PUT    /catalog/update/{id}  → guardar edición
DELETE /catalog/show/{id}    → eliminar película
PATCH  /catalog/{id}/rent    → alquilar película
PATCH  /catalog/{id}/return  → devolver película
```

### Migración — `create_movies_table.php`
Crea la tabla `movies` en la base de datos con los campos:

- `id` — clave primaria autoincremental
- `title` — título de la película
- `year` — año de estreno
- `director` — nombre del director
- `poster` — URL de la imagen del póster
- `synopsi` — sinopsis de la película
- `rented` — booleano, `false` por defecto (disponible)
- `timestamps` — fechas de creación y actualización automáticas

---

## -> Validaciones

El formulario de alta y edición valida los datos antes de guardarlos. Todos los campos son obligatorios:

- `title` — requerido
- `year` — requerido
- `director` — requerido
- `poster` — requerido (URL del póster)
- `synopsis` — requerido

---

## -> Tecnologías utilizadas

- **PHP 8+**
- **Laravel 11**
- **MySQL** (vía XAMPP / Laragon)
- **Bootstrap 5** + Bootstrap Icons
- **Blade** (motor de plantillas de Laravel)

---

## -> Instalación local

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/videoclub-clean.git
cd videoclub-clean

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar la base de datos en .env y migrar
php artisan migrate

# 6. Lanzar el servidor
php artisan serve
```

Accede desde el navegador en `http://localhost:8000` o, si usas Laragon, en `http://videoclub-clean.test`.

---

## -> Autor

Proyecto realizado por un estudiante de **18 años** del ciclo formativo de Desarrollo de Aplicaciones Web como práctica de Laravel, MVC y gestión de estado en base de datos.
