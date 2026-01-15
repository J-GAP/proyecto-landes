# 3. Modelos de Datos

## 3.1 Enfoque Conceptual

En esta etapa de diseño, es crucial entender que el sistema MVP no actúa como propietario primario de toda la información (System of Record), sino como un consumidor de datos existentes.

> [!TIP] > **Principio de Diseño:** El sistema consume y presenta información de fuentes externas; no duplica ni es dueño de la verdad de los datos históricos en esta fase.

## 3.2 Entidades del Dominio

### Entidad: Motor (Activo)

Representa el objeto físico central del sistema.
**Datos Críticos (Identificación):**

- **ID Interno**: Identificador único del sistema.
- **Nombre Operativo**: Denominación común del equipo (Ej. _Bomba de Agua N°2_).
- **Marca y Modelo**: Datos de fabricante.
- **Número de Serie**: Identificador único de fábrica.
- **Ubicación Física**: Área o planta donde está instalado (Ej. _Zona de Sellado_).
- **Estado Actual**: Estado operativo derivado (ej. _En Operación_, _Detenido_).

### Entidad: Componente (Piezas Críticas)

Elementos reemplazables asociados al motor. Facilita la gestión de repuestos sin despiece físico.
**Datos de Visualización:**

- **Nombre**: Descripción común (Ej. _Rodamiento Lado Acople_).
- **Código de Parte (SKU)**: Identificador del fabricante para repuestos (Ej. _6308-ZZ_).
- **Cantidad**: Número de unidades instaladas en este motor.
- **(Opcional) Marca Recomendada**: Fabricante sugerido (Ej. _SKF_).

### Entidad: Mantenimiento Preventivo (Fuente Externa)

Eventos históricos de servicio. En el MVP, esta entidad es de **Solo Lectura**.
**Datos de Visualización:**

- **Fecha del Evento**: Cuándo ocurrió.
- **Tipo**: Clasificación del mantenimiento.
- **Descripción**: Detalles técnicos del trabajo realizado.

### Entidad: Detención (Fuente Externa)

Registros de paradas operativas. En el MVP, esta entidad es de **Solo Lectura**.
**Datos de Visualización:**

- **Inicio y Fin**: Duración del evento.
- **Motivo**: Causa raíz (Falla, Operacional, etc.).
- **Clasificación**: Tipo de detención.
- **Horas de Producción**: Cantidad de horas de producción totales.
- **Horas de Detención**: Cantidad de horas de detención totales.
- **Horas de Operación**: Cantidad de horas de operación totales.
- **Porcentaje de Detención**: Porcentaje de horas de detención sobre las horas de operación.   

## 3.3 Tratamiento de Datos en el MVP

### Filtrado y Presentación

Dado que el historial puede ser extenso, el sistema debe implementar reglas de visualización:

- **Límite de Registros**: Mostrar solo los últimos 5 eventos (Mantenimientos/Detenciones).
- **Ordenamiento**: Estrictamente cronológico descendente.

### Restricciones de Integridad

- **Inmutabilidad**: El sistema no permite modificar ni eliminar registros.
- **Seguridad de Datos**: Se reduce el riesgo al no exponer funciones de escritura.

## 3.4 Relaciones Conceptuales

- **Un Motor** tiene **Muchos** Componentes (Relacion 1:N). _Propósito: Gestión de repuestos._
- **Un Motor** tiene **Muchos** Mantenimientos Preventivos.
- **Un Motor** tiene **Muchas** Detenciones.
- La relación es de consulta unidireccional y de lectura para el MVP.
