<?php
// includes/functions.php

/**
 * Obtener detalles de un motor por su ID.
 * @param PDO $pdo Conexión a la base de datos
 * @param int $id ID del motor
 * @return array|false Datos del motor o false si no existe
 */
function getMotorById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM motors WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

/**
 * Obtener componentes asociados a un motor.
 * @param PDO $pdo Conexión a la base de datos
 * @param int $motorId ID del motor
 * @return array Lista de componentes
 */
function getComponentsByMotorId($pdo, $motorId)
{
    $stmt = $pdo->prepare("SELECT * FROM components WHERE motor_id = :motor_id");
    $stmt->execute(['motor_id' => $motorId]);
    return $stmt->fetchAll();
}

/**
 * Obtener historial de mantenimientos (últimos 5).
 * @param PDO $pdo Conexión a la base de datos
 * @param int $motorId ID del motor
 * @return array Lista de mantenimientos
 */
function getMaintenanceHistory($pdo, $motorId)
{
    $stmt = $pdo->prepare("SELECT * FROM maintenance_events WHERE motor_id = :motor_id ORDER BY event_date DESC LIMIT 5");
    $stmt->execute(['motor_id' => $motorId]);
    return $stmt->fetchAll();
}

/**
 * Obtener historial de detenciones (últimas 5).
 * @param PDO $pdo Conexión a la base de datos
 * @param int $motorId ID del motor
 * @return array Lista de detenciones
 */
function getDowntimeHistory($pdo, $motorId)
{
    $stmt = $pdo->prepare("SELECT * FROM downtime_events WHERE motor_id = :motor_id ORDER BY start_time DESC LIMIT 5");
    $stmt->execute(['motor_id' => $motorId]);
    return $stmt->fetchAll();
}
?>