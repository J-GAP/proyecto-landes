# 7. Planificación del Proyecto (Stack PHP/MySQL)

Esta planificación está diseñada para organizar el desarrollo del MVP utilizando la **Propuesta 4 (Estándar Corporativo)**. El objetivo es entregar un producto robusto paso a paso.

## Objetivos Generales
*   **Principal:** Completar el MVP funcional para visualización de datos de motores vía QR.
*   **Técnico:** Implementar una arquitectura limpia en PHP nativo (o framework ligero) que sea mantenible por la empresa.
*   **Plazo:** [Definir fecha según duración de práctica].

---

## Fase 1: Configuración y Cimientos (Semana 1)
**Objetivo:** Tener un "Hola Mundo" conectado a la base de datos real.

*   [ ] **1.1 Ambiente de Desarrollo:**
    *   Instalar XAMPP/WAMP o configurar servidor Linux local.
    *   Verificar funcionamiento de PHP 8+ y MySQL.
*   [ ] **1.2 Base de Datos:**
    *   Crear el esquema (tablas) basándose en `05_Especificacion_ERD.md`.
    *   Cargar datos de prueba (Manuales o Script) para `motors`, `components`, etc.
*   [ ] **1.3 Estructura del Proyecto:**
    *   Definir carpetas: `/css`, `/js`, `/includes` (header, footer, db_connection), `/views`.
    *   Crear archivo de conexión a BD (`db.php`) y probar conexión exitosa.

## Fase 2: Backend Core - Lógica de Datos (Semana 2)
**Objetivo:** Ser capaz de extraer toda la información necesaria de la BD mediante PHP.

*   [ ] **2.1 Consultas SQL (Queries):**
    *   Escribir y probar las queries para obtener: Detalles del motor por ID, Lista de Componentes, últimos 5 Mantenimientos, últimas 5 Detenciones.
*   [ ] **2.2 Funciones PHP:**
    *   Crear funciones reutilizables (ej. `getMotorById($id)`, `getMaintenanceHistory($motor_id)`).
    *   Validar que los datos lleguen correctamente (manejo de IDs inexistentes).

## Fase 3: Frontend Base & UI (Semana 3)
**Objetivo:** Crear la "cáscara" visual de la aplicación web responsive.

*   [ ] **3.1 Diseño Base (HTML/CSS):**
    *   Implementar layout principal con **Bootstrap 5** (Navbar, Contenedor principal, Footer).
    *   Asegurar que sea *Mobile-First* (se vea perfecto en celular).
*   [ ] **3.2 Vistas Estáticas:**
    *   Maquetar la ficha del motor "hardcodeada" (con datos falsos) para validar el diseño.
    *   Diseñar las tarjetas para los mantenimientos y la tabla para las detenciones.

## Fase 4: Integración & Funcionalidades MVP (Semana 4)
**Objetivo:** Unir Backend y Frontend. "Que los datos reales aparezcan en pantalla".

*   [ ] **4.1 Vista de Detalles del Motor:**
    *   Conectar la página `detalle.php?id=X` con `getMotorById`.
    *   Mostrar datos reales del encabezado (Nombre, Marca, Estado).
*   [ ] **4.2 Listados Históricos:**
    *   Integrar el loop (`foreach`) de PHP para renderizar la lista de mantenimientos y detenciones reales.
*   [ ] **4.3 Componentes y KPIs:**
    *   Mostrar la lista de componentes.
    *   Implementar cálculo simple de Disponibilidad en PHP y mostrarlo.

## Fase 5: Gráficos y Extras (Semana 5)
**Objetivo:** Agregar el valor visual y las interacciones finales.

*   [ ] **5.1 Gráficos de KPIs:**
    *   Integrar **Chart.js**.
    *   Crear un endpoint o script que pase los datos de PHP a formato JSON para el gráfico.
*   [ ] **5.2 Descarga y Contacto:**
    *   Implementar botón que linkeu al PDF (si existe).
    *   Programar botón "Reportar" (`mailto:`).
*   [ ] **5.3 Página de Error/404:**
    *   Diseñar pantalla amigable para cuando un QR no sea válido.

## Fase 6: Pruebas y Despliegue (Semana 6)
**Objetivo:** Puesta en marcha.

*   [ ] **6.1 QA (Aseguramiento de Calidad):**
    *   Prueba de usabilidad en terreno (o simulada) con celular real.
    *   Verificar velocidad de carga.
*   [ ] **6.2 Generación de QRs:**
    *   Generar los códigos QR con las URLs finales (ej. `midominio.com/motor.php?id=123`).
*   [ ] **6.3 Despliegue:**
    *   Subir archivos al servidor de la empresa.
    *   Configurar conexión a BD de producción.

---

## Hitos de Revisión (Checkpoints)
1.  **Fin Fase 1:** Conexión a BD exitosa.
2.  **Fin Fase 3:** Maqueta visual aprobada en celular.
3.  **Fin Fase 4:** Datos reales visibles en pantalla.
4.  **Fin Fase 6:** Demo final con QR funcional.
