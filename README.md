# Proyecto Landes - MVP

Sistema de visualización de fichas técnicas de motores vía QR.

## Estructura del Proyecto

El proyecto sigue una estructura simple tipo MVC (Modelo-Vista-Controlador) adaptada a PHP plano para facilitar el mantenimiento.

```text
PROYECTO-LANDES/
├── css/            # Estilos (Bootstrap + Personalizados)
│   └── style.css   # Tu hoja de estilos principal
├── js/             # Lógica Frontend
│   └── main.js     # Scripts para gráficos o interacciones
├── includes/       # Fragmentos de código reutilizables (Backend)
│   ├── db.php      # Archivo ÚNICO de conexión a la base de datos
│   └── header.php  # Barra de navegación (se incluye en todas las páginas)
├── views/          # Las "Páginas" que ve el usuario
│   └── detalle.php # La ficha técnica del motor (lo que abre el QR)
├── assets/         # Imágenes estáticas (logos, iconos)
└── docs/           # Documentación del proyecto (Planificación, ERD)
```

## Flujo de Trabajo Sugerido

1.  **Conexión (`includes/db.php`):** Configuras aquí tu usuario y clave de MySQL una sola vez.
2.  **Lógica (`includes/functions.php` - *A crear*):** Escribes funciones PHP aquí para obtener datos (ej. `obtenerMotor($id)`).
3.  **Vistas (`views/`):**
    *   Creas un archivo `.php` (ej. `detalle.php`).
    *   Al inicio, importas la conexión: `require '../includes/db.php';`.
    *   Llamas a tus funciones para obtener los datos en variables.
    *   Escribes el HTML mezclado con PHP (`echo $variable`) para mostrar la info.
4.  **Estilos:** Si necesitas ajustar el diseño, editas `css/style.css`.