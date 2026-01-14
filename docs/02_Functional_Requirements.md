# 2) What users must be able to do with the project

## 2.1 User roles (implícitos, sin hablar de auth aún)

Desde el punto de vista funcional, el sistema distingue dos tipos de usuarios:

* **Usuario estándar (técnico en terreno)**:
    * → Solo lectura
* **Personal autorizado**:
    * → Registro de eventos (preventivos y detenciones)

> [!WARNING]
> Aún no hablamos de login, roles técnicos ni permisos: solo qué puede hacer cada tipo de usuario.

## 2.2 Features — Usuario estándar (técnico en terreno)

Cuando el técnico escanea el QR, el sistema debe permitirle:

### Feature 1 — Identificación inmediata del equipo
📍 (definido por ti)
Mostrar de forma inmediata:
* Nombre del equipo
* Marca
* Número de serie

_El usuario no puede editar esta información._

### Feature 2 — Consulta de información técnica
* Ver ficha técnica del motor
* Acceder a información relevante para identificación y contexto
* **Solo lectura**

### Feature 3 — Consulta de historial
* Ver últimos mantenimientos preventivos
* Ver últimas detenciones
* **No puede modificar ni registrar información**

### Feature 4 — Visualización de indicador básico
* Ver un indicador simple del porcentaje de tiempo detenido
* **Uso informativo, no operativo**

## 2.3 Features — Personal autorizado

El sistema debe permitir que personal autorizado pueda:

### Feature 5 — Registrar mantenimiento preventivo
* Registrar un nuevo mantenimiento preventivo
* Asociarlo a un motor específico
* Dejar trazabilidad del evento

### Feature 6 — Registrar detención del motor
* Registrar inicio y fin de una detención
* Indicar motivo
* Diferenciar detención programada o por falla

## 2.4 Guardrails (muy importantes)

El sistema debe garantizar que:

**El usuario estándar no pueda:**
* Editar información del motor
* Registrar mantenimientos
* Registrar detenciones
* Eliminar información histórica

**Solo personal autorizado pueda:**
* Registrar eventos
* Acceder a formularios de ingreso

## 2.5 User-centric validation rules

* El técnico debe poder ver información clave sin tomar decisiones
* El sistema debe minimizar el riesgo de errores humanos
* La trazabilidad debe mantenerse intacta
