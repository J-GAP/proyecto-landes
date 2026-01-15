# 6. Propuestas de Stack Tecnológico

Basado en los requerimientos del MVP (Solo Lectura, Acceso vía QR, Optimización Móvil) y la documentación de modelos de datos, se presentan tres propuestas de arquitectura y tecnología.

## Introducción: Criterios de Selección
Para este proyecto, los criterios clave son:
1.  **Velocidad de Carga:** Crítico para acceso móvil en terreno (posible baja señal).
2.  **Responsive Design:** Debe sentirse como una App nativa en el móvil.
3.  **Facilidad de Conexión a BD:** Capacidad de consumir la base de datos existente.
4.  **Escalabilidad:** Posibilidad de pasar de "Solo Lectura" a "Gestión" en el futuro.

---

## Propuesta 1: El Estándar Moderno (Recomendada)
**Enfoque:** Agilidad, Performance y Unificación.

*   **Frontend & Backend (BFF):** [Next.js](https://nextjs.org/) (React Framework).
*   **Lenguaje:** TypeScript.
*   **Estilos:** Tailwind CSS (para diseño rápido y mobile-first).
*   **Base de Datos (ORM):** Prisma (para conectar tipadamente a la BD existente).
*   **Infraestructura:** Vercel (o contenedor Docker estándar).

**Justificación:**
*   **Todo en uno:** Next.js permite crear el frontend y las API Routes en el mismo proyecto, simplificando el despliegue y mantenimiento.
*   **Server-Side Rendering (SSR):** Ideal para cargar la data del motor *antes* de enviar la página al celular, mejorando la velocidad percibida y el SEO (si fuera público).
*   **Futuro:** Soporta perfectamente autenticación compleja y formularios para la Fase 2.

---

## Propuesta 2: Arquitectura Orientada a Datos
**Enfoque:** Preparado para Inteligencia de Negocios y Ciencia de Datos futura.

*   **Frontend:** [Vite](https://vitejs.dev/) + React.
*   **Backend:** [FastAPI](https://fastapi.tiangolo.com/) (Python).
*   **Lenguaje:** TypeScript (Front) / Python (Back).
*   **Estilos:** Bootstrap o Material UI.
*   **Base de Datos (Driver):** SQLAlchemy / Pandas (para cálculos de KPIs).

**Justificación:**
*   **Potencia de Python:** Si a futuro se desea implementar mantenimiento predictivo o cálculos estadísticos complejos (KPIs avanzados), Python es el líder indiscutible.
*   **Desacople:** Frontend y Backend están totalmente separados, lo que permite que equipos distintos trabajen en cada uno.
*   **FastAPI:** Es extremadamente rápido y genera documentación automática (Swagger) para las APIs.

---

## Propuesta 3: La Opción Ligera (Lightweight)
**Enfoque:** Simplicidad máxima y curva de aprendizaje baja.

*   **Frontend:** [Vue.js](https://vuejs.org/) (Nuxt opcional).
*   **Backend:** [Node.js](https://nodejs.org/) con Express.
*   **Estilos:** CSS Vainilla o Bulma.
*   **Base de Datos:** Driver nativo SQL (pg, mysql2, mssql).

**Justificación:**
*   **Sencillez:** Vue.js separa claramente HTML, JS y CSS, lo que muchas veces es más intuitivo para comenzar que React interconectado.
*   **Flexibilidad:** Node+Express es la arquitectura de backend más documentada y flexible para microservicios simples.
*   **Ideal para MVP:** Si el objetivo es prototipar en días, esta combinación tiene muy poca "burocracia" de configuración.

---

## Propuesta 4: El Estándar Corporativo (Legacy/Estable)
**Enfoque:** Continuidad operativa y alineación con el equipo actual.

*   **Frontend:** HTML5 + JavaScript (Vanilla o framework ligero) + Bootstrap.
*   **Backend:** [PHP 8+](https://www.php.net/) (Laravel o CodeIgniter sugeridos para orden, o PHP Puro para simplicidad extrema).
*   **Base de Datos:** MySQL (Driver nativo `mysqli` o PDO).
*   **Infraestructura:** Servidor Linux estándar (LAMP Stack) o Hosting compartido existente.

**Justificación:**
*   **Curva de Aprendizaje Cero:** Si el equipo ya mantiene soluciones así, no hay tiempo perdido en aprender nuevas herramientas (React/Node).
*   **Reutilización:** Se puede hostear en la misma infraestructura que las soluciones actuales sin costo extra.
*   **Estabilidad:** PHP es robusto, "aburrido" (en el buen sentido) y maneja conexiones a MySQL de forma nativa y eficiente.

---

## Resumen Comparativo

| Característica | Propuesta 1 (Next.js) | Propuesta 2 (Python/React) | Propuesta 3 (Vue/Node) | Propuesta 4 (PHP/Legacy) |
| :--- | :--- | :--- | :--- | :--- |
| **Performance Móvil** | ⭐⭐⭐⭐⭐ (Excelente) | ⭐⭐⭐⭐ (Muy Buena) | ⭐⭐⭐⭐ (Muy Buena) | ⭐⭐⭐ (Buena) |
| **Complejidad Dev** | Media (Un solo repo) | Alta (Dos repos) | Baja | Baja (Conocido) |
| **Capacidad Analítica** | Media | ⭐⭐⭐⭐⭐ (Alta) | Media | Baja |
| **Velocidad Desarrollo** | ⭐⭐⭐⭐⭐ (Muy Rápida) | Media | ⭐⭐⭐⭐ (Rápida) | ⭐⭐⭐⭐⭐ (Muy Rápida) |
| **Mantención Equipo** | ⭐⭐⭐ (Requiere Capacitación) | ⭐⭐ (Complejo) | ⭐⭐⭐ (Js Estándar) | ⭐⭐⭐⭐⭐ (Nativa) |

### Recomendación Sugerida
### Recomendación Final

La decisión depende de la prioridad estratégica:

1.  **Si se prioriza la MODERNIZACIÓN:** Elegir **Propuesta 1 (Next.js)**. Permite dar un salto de calidad en UX móvil y performance, preparando el terreno para el futuro.
2.  **Si se prioriza la MANTENIBILIDAD INTERNA:** Elegir **Propuesta 4 (PHP)**. Es la opción más segura si el equipo de soporte, que tomará el proyecto después de la práctica, solo maneja PHP.

