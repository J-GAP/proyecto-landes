# 3) Define the data models

## 3.1 Don’t think about databases

En este punto, el sistema no es dueño de toda la información.
Parte de los datos (mantenimientos y detenciones) ya existen en una base de datos externa.

> [!TIP]
> 👉 El sistema consume información, no la genera inicialmente.

## 3.2 What data is needed (conceptual)

### Entity: Motor
Datos mínimos necesarios para identificación y contexto:
* Motor ID (identificador interno)
* Nombre del equipo
* Marca
* Número de serie
* Información técnica básica
* Estado actual (informativo)

### Entity: Preventive Maintenance (external source)
Datos necesarios solo para visualización:
* ID del mantenimiento
* Motor ID
* Fecha
* Tipo de mantenimiento
* Descripción / observaciones

> [!CAUTION]
> ⚠️ No se modifican ni eliminan registros.

### Entity: Stoppage (external source)
Datos necesarios solo para visualización:
* ID de detención
* Motor ID
* Fecha inicio
* Fecha fin
* Motivo
* Tipo de detención

## 3.3 How data is handled

El sistema consulta la información histórica desde una base de datos existente.

Solo se muestran:
* Últimos 5 mantenimientos preventivos
* Últimas 5 detenciones

El historial completo **no es visible** para el usuario estándar.

👉 Esto reduce:
* Carga cognitiva
* Complejidad de interfaz
* Riesgo de mal uso de información antigua

## 3.4 Relationships (conceptual)

* A **Motor** has many **PreventiveMaintenances**
* A **Motor** has many **Stoppages**

**PreventiveMaintenances** and **Stoppages**:
* Are read-only
* Are time-ordered
* Are limited in presentation (last 5)

## 3.5 Design implications (important, still no tech)

El sistema debe:
* Filtrar
* Ordenar
* Limitar resultados

No debe permitir:
* Edición
* Eliminación
* Creación desde la vista estándar
