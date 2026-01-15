# 5. Especificación para Diagrama ERD

Este documento detalla la estructura de tablas, atributos y relaciones para la creación del diagrama Entidad-Relación (ERD) del sistema.

## 1. Entidad: Motor (Activo Principal)
**Descripción:** Representa el objeto físico central (System of Record).

**Nombre de Tabla:** `motors`
**Atributos:**
*   **ID Interno (PK):** `id` (INT/UUID) - Identificador único del sistema.
*   **Nombre Operativo:** `name` (VARCHAR) - Denominación común del equipo (Ej. "Bomba de Agua N°2").
*   **Marca y Modelo:** `brand_model` (VARCHAR) - Información del fabricante.
*   **Número de Serie:** `serial_number` (VARCHAR) - Identificador único de fábrica.
*   **Ubicación Física:** `location` (VARCHAR) - Área o planta de instalación (Ej. "Zona de Sellado").
*   **Estado Actual:** `status` (VARCHAR) - Estado operativo (Ej. "En Operación", "Detenido").

## 2. Entidad: Componente
**Descripción:** Elementos reemplazables asociados al motor.

**Nombre de Tabla:** `components`
**Atributos:**
*   **ID (PK):** `id` (INT/UUID) - Identificador único del componente.
*   **Motor_ID (FK):** `motor_id` (INT/UUID) - Referencia al Motor al que pertenece.
*   **Nombre:** `name` (VARCHAR) - Descripción común (Ej. "Rodamiento Lado Acople").
*   **Código de Parte (SKU):** `sku` (VARCHAR) - Identificador del fabricante (Ej. "6308-ZZ").
*   **Cantidad:** `quantity` (INT) - Número de unidades instaladas.
*   **Marca Recomendada:** `recommended_brand` (VARCHAR) - Fabricante sugerido (Opcional).

## 3. Entidad: Mantenimiento Preventivo
**Descripción:** Eventos históricos de servicio (Solo Lectura).

**Nombre de Tabla:** `maintenance_events`
**Atributos:**
*   **ID (PK):** `id` (INT/UUID) - Identificador único del evento.
*   **Motor_ID (FK):** `motor_id` (INT/UUID) - Referencia al Motor asociado.
*   **Fecha del Evento:** `event_date` (DATETIME) - Cuándo ocurrió el mantenimiento.
*   **Tipo:** `type` (VARCHAR) - Clasificación del mantenimiento.
*   **Descripción:** `description` (TEXT) - Detalles técnicos del trabajo realizado.

## 4. Entidad: Detención
**Descripción:** Registros de paradas operativas (Solo Lectura).

**Nombre de Tabla:** `downtime_events`
**Atributos:**
*   **ID (PK):** `id` (INT/UUID) - Identificador único del evento.
*   **Motor_ID (FK):** `motor_id` (INT/UUID) - Referencia al Motor asociado.
*   **Inicio:** `start_time` (DATETIME) - Fecha/Hora de inicio.
*   **Fin:** `end_time` (DATETIME) - Fecha/Hora de término.
*   **Motivo:** `reason` (VARCHAR) - Causa raíz (Falla, Operacional, etc.).
*   **Clasificación:** `classification` (VARCHAR) - Tipo de detención.
*   **Horas de Producción:** `production_hours` (DECIMAL/FLOAT) - Total horas producción.
*   **Horas de Detención:** `downtime_hours` (DECIMAL/FLOAT) - Total horas detención.
*   **Horas de Operación:** `operation_hours` (DECIMAL/FLOAT) - Total horas operación.
*   **Porcentaje de Detención:** `downtime_percentage` (DECIMAL/FLOAT) - % sobre horas de operación.

## Relaciones (Cardinalidad)

1.  **Motor** `1` a `Varios (N)` **Componentes**
    *   *Un motor tiene instalados muchos componentes.*
2.  **Motor** `1` a `Varios (N)` **Mantenimientos Preventivos**
    *   *Un motor tiene un historial de muchos mantenimientos.*
3.  **Motor** `1` a `Varios (N)` **Detenciones**
    *   *Un motor registra muchas detenciones a lo largo del tiempo.*
