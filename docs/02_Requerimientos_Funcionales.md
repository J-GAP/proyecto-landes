# 2. Requerimientos Funcionales

## 2.1 Roles de Usuario

El sistema contempla dos niveles de acceso funcional:

- **Usuario Técnico (Visualizador)**: Acceso público o básico vía QR. Su función es estrictamente de consulta.
- **Usuario Administrador (Personal Autorizado)**: Acceso con privilegios (futura implementación) para gestión.

> [!NOTE] > **Alcance MVP**: Foco exclusivo en el **Usuario Técnico** y funcionalidad de **Solo Lectura**.

## 2.2 Funcionalidades - Fase 1: MVP (Solo Lectura)

Al escanear el código QR, el sistema debe proveer las siguientes capacidades al técnico, extrayendo datos de la **base de datos existente**:

### Feature 1: Identificación Inmediata del Activo

Despliegue instantáneo de los datos críticos para confirmar que es el equipo correcto.

- **Datos Clave**:
  - Nombre Operativo (Ej. _Motor Cinta Transportadora 1_)
  - Marca y Modelo
  - Número de Serie
  - **Ubicación Física** (Ej. _Planta A - Sección Molienda_)
  - **Estado Operativo Actual** (Ej. _🟢 En Operación_ | _🔴 Detenido_)

### Feature 2: Consulta de Ficha Técnica Detallada

Acceso a especificaciones eléctricas y mecánicas para validaciones en terreno sin recurrir a papel.

- **Datos Clave**: Potencia (Hp/kW), Voltaje, Amperaje, RPM, Rodamientos.
- **Documentación**: Botón explícito **"Ver PDF Original"** para descargar la ficha técnica completa si está disponible.

### Feature 3: Historial de Operaciones (Visualización de BD Existente)

El sistema consultará los registros históricos de la base de datos y mostrará los eventos más recientes.

- **Mantenimientos Preventivos**: Lista de las últimas 5 intervenciones (Fecha `DD/MM/YYYY`, Tipo, Ejecutor).
- **Detenciones**: Lista de las últimas 5 paradas (Fecha Inicio, Duración, Motivo).
- _Comportamiento_: Si no hay registros recientes, mostrar mensaje amigable ("Sin mantenimientos registrados en últimos 6 meses").

### Feature 4: Indicadores de Estado (KPIs)

Cálculo y visualización de métricas básicas basadas en los datos históricos de detenciones.

- **Disponibilidad Reciente**: Gráfico o porcentaje calculado como:
  `% = (Tiempo Total - Tiempo Detenido) / Tiempo Total`
- _Nota_: Este indicador se procesa en tiempo real con la data existente al momento de la consulta.

### Feature 5: Reporte Rápido (Nuevo en MVP)

Facilitador de comunicación ante anomalías detectadas en terreno.

- **Botón "Reportar Problema"**: Acción directa (enlace `mailto:` o `tel:`) para contactar al supervisor o central de mantenimiento. No requiere formulario complejo en el MVP.

### Feature 6: Estado de Sincronización

Elemento de confianza para el usuario.

- Visualización discreta de **"Datos actualizados al: [Fecha/Hora]"** para transparentar la frescura de la información mostrada.

## 2.3 Funcionalidades - Fase 2: Futuro (Gestión y Escritura)

Funcionalidades **excluidas del MVP** (Solo para referencia de arquitectura futura):

- **Registro de Mantenimiento**: Ingreso de nuevos reportes.
- **Gestión de Detenciones**: Inicio/Fin de paradas.
- **Gestión de Inventario**: Asignación de repuestos.

## 2.4 Restricciones y Reglas de Negocio (Guardrails)

1.  **Fuente de Verdad Externa**: El sistema **NO** tiene base de datos propia para eventos; **visualiza** lo que ya existe en los sistemas de la empresa.
2.  **Integridad de Lectura**: Interfaz 100% "Read-Only". Sin botones de edición, borrado o creación de registros.
3.  **Privacidad por Oscuridad (MVP)**: El acceso es vía QR físico. No hay login complejo, por lo que no se muestran datos sensibles financieros o estratégicos, solo técnicos.
