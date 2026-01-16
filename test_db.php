<?php
// test_db.php
require 'includes/db.php';
require 'includes/functions.php';

echo "<h1>Prueba de Lógica Backend (Fase 2)</h1>";

// ID de prueba 
$motorId = 1;

// 1. Probar getMotorById
echo "<h2>1. Detalles del Motor (ID: $motorId)</h2>";
$motor = getMotorById($pdo, $motorId);

if ($motor) {
    echo "<ul>";
    echo "<li><strong>Nombre:</strong> " . $motor['name'] . "</li>";
    echo "<li><strong>Modelo:</strong> " . $motor['brand_model'] . "</li>";
    echo "<li><strong>Ubicacion:</strong> " . $motor['location'] . "</li>";
    echo "<li><strong>Estado:</strong> " . $motor['status'] . "</li>";
    echo "</ul>";
} else {
    echo "<p style='color: red;'>Motor no encontrado.</p>";
}

// 2. Probar Componentes
echo "<h2>2. Componentes</h2>";
$components = getComponentsByMotorId($pdo, $motorId);
if (count($components) > 0) {
    echo "<ul>";
    foreach ($components as $comp) {
        echo "<li>" . $comp['name'] . " (SKU: " . $comp['sku'] . ")</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay componentes registrados.</p>";
}

// 3. Probar Mantenimientos
echo "<h2>3. Historial Mantenimiento</h2>";
$maintenance = getMaintenanceHistory($pdo, $motorId);
echo "<p>Registros encontrados: " . count($maintenance) . "</p>";

// 4. Probar Detenciones
echo "<h2>4. Historial Detenciones</h2>";
$downtime = getDowntimeHistory($pdo, $motorId);
echo "<p>Registros encontrados: " . count($downtime) . "</p>";

?>