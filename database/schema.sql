-- Script de Creación de Base de Datos para Proyecto Landes MVP

CREATE DATABASE IF NOT EXISTS landes_db;
USE landes_db;

-- 1. Tabla: Motores (motors)
CREATE TABLE IF NOT EXISTS motors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL COMMENT 'Nombre Operativo',
    brand_model VARCHAR(100) COMMENT 'Marca y Modelo',
    serial_number VARCHAR(100) UNIQUE COMMENT 'Número de Serie',
    location VARCHAR(100) COMMENT 'Ubicación Física',
    status VARCHAR(50) DEFAULT 'Detenido' COMMENT 'Estado Actual (En Operación, Detenido)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabla: Componentes (components)
CREATE TABLE IF NOT EXISTS components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motor_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    sku VARCHAR(50) COMMENT 'Código de Parte',
    quantity INT DEFAULT 1,
    recommended_brand VARCHAR(100),
    FOREIGN KEY (motor_id) REFERENCES motors(id) ON DELETE CASCADE
);

-- 3. Tabla: Mantenimientos (maintenance_events)
CREATE TABLE IF NOT EXISTS maintenance_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motor_id INT NOT NULL,
    event_date DATETIME NOT NULL,
    type VARCHAR(50) COMMENT 'Tipo de Mantenimiento',
    description TEXT,
    FOREIGN KEY (motor_id) REFERENCES motors(id) ON DELETE CASCADE
);

-- 4. Tabla: Detenciones (downtime_events)
CREATE TABLE IF NOT EXISTS downtime_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motor_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    reason VARCHAR(255) COMMENT 'Motivo de la detención',
    classification VARCHAR(100),
    production_hours DECIMAL(10, 2) DEFAULT 0,
    downtime_hours DECIMAL(10, 2) DEFAULT 0,
    operation_hours DECIMAL(10, 2) DEFAULT 0,
    downtime_percentage DECIMAL(5, 2) GENERATED ALWAYS AS ((downtime_hours / NULLIF(operation_hours, 0)) * 100) VIRTUAL COMMENT 'Calculado: % de Detención',
    FOREIGN KEY (motor_id) REFERENCES motors(id) ON DELETE CASCADE
);

-- Insertar Datos de Prueba (Dummy Data)

-- Motor de Prueba 1
INSERT INTO motors (name, brand_model, serial_number, location, status) VALUES 
('Bomba Alimentación N°1', 'Siemens 1LE1', 'S-2023-001', 'Planta Procesos - Zona A', 'En Operación');

SET @motor1_id = LAST_INSERT_ID();

INSERT INTO components (motor_id, name, sku, quantity, recommended_brand) VALUES 
(@motor1_id, 'Rodamiento Delantero', '6205-ZZ', 1, 'SKF'),
(@motor1_id, 'Sello Mecánico', 'MG1-25', 1, 'Burgmann');

INSERT INTO maintenance_events (motor_id, event_date, type, description) VALUES 
(@motor1_id, DATE_SUB(NOW(), INTERVAL 10 DAY), 'Preventivo', 'Lubricación de rodamientos y limpieza general.'),
(@motor1_id, DATE_SUB(NOW(), INTERVAL 45 DAY), 'Correctivo', 'Cambio de sello mecánico por fuga.');

INSERT INTO downtime_events (motor_id, start_time, end_time, reason, classification, downtime_hours, operation_hours) VALUES 
(@motor1_id, DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), 'Falla Eléctrica', 'No Programada', 24.0, 120.0),
(@motor1_id, DATE_SUB(NOW(), INTERVAL 30 DAY), DATE_SUB(NOW(), INTERVAL 29 DAY), 'Mantención Programada', 'Programada', 8.0, 160.0);
