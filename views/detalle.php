<?php
// views/detalle.php
require '../includes/db.php';
require '../includes/functions.php';

// Validar ID
$motorId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$motor = getMotorById($pdo, $motorId);

if (!$motor) {
    die("Error: Motor no encontrado.");
}

$componentes = getComponentsByMotorId($pdo, $motorId);
$mantenimientos = getMaintenanceHistory($pdo, $motorId);
$detenciones = getDowntimeHistory($pdo, $motorId);
?>

<?php include '../includes/header.php'; ?>

<!-- Encabezado del Motor -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="bg-primary text-white rounded-circle p-3 me-3">
                <i class="bi bi-hdd-rack-fill fs-3"></i>
            </div>
            <div>
                <h5 class="card-title fw-bold mb-0"><?php echo htmlspecialchars($motor['name']); ?></h5>
                <small class="text-muted"><?php echo htmlspecialchars($motor['serial_number']); ?></small>
            </div>
        </div>
        
        <div class="row g-2">
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <small class="d-block text-muted">Marca/Modelo</small>
                    <strong><?php echo htmlspecialchars($motor['brand_model']); ?></strong>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <small class="d-block text-muted">Ubicación</small>
                    <strong><?php echo htmlspecialchars($motor['location']); ?></strong>
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <div class="d-flex justify-content-between mb-2">
                <span class="badge <?php echo ($motor['status'] == 'En Operación') ? 'bg-success' : 'bg-danger'; ?> flex-grow-1 me-2 py-2">
                    <i class="bi bi-circle-fill me-1 small"></i> 
                    <?php echo htmlspecialchars($motor['status']); ?>
                </span>
                <?php 
                    $kpi = getAvailabilityKPI($pdo, $motorId); 
                    $kpiColor = ($kpi >= 90) ? 'text-success' : (($kpi >= 80) ? 'text-warning' : 'text-danger');
                ?>
                <span class="border rounded px-3 py-1 bg-light fw-bold <?php echo $kpiColor; ?>" title="Disponibilidad Histórica">
                    <i class="bi bi-activity"></i> <?php echo $kpi; ?>%
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Tabs de Navegación -->
<ul class="nav nav-tabs nav-fill mb-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#components" type="button" role="tab">Componentes</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">Historial</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    
    <!-- Tab Componentes -->
    <div class="tab-pane fade show active" id="components" role="tabpanel">
        <div class="list-group list-group-flush shadow-sm rounded">
            <?php if (count($componentes) > 0): ?>
                <?php foreach ($componentes as $comp): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold"><?php echo htmlspecialchars($comp['name']); ?></div>
                        <small class="text-muted">SKU: <?php echo htmlspecialchars($comp['sku']); ?></small>
                    </div>
                    <span class="badge bg-secondary rounded-pill"><?php echo $comp['quantity']; ?></span>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="list-group-item text-center text-muted">No hay componentes registrados.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tab Historial -->
    <div class="tab-pane fade" id="history" role="tabpanel">
        
        <!-- Mantenimientos -->
        <h6 class="text-uppercase text-muted fw-bold small mt-2 mb-2 ps-2">Últimos Mantenimientos</h6>
        <div class="list-group shadow-sm rounded mb-4">
            <?php if (count($mantenimientos) > 0): ?>
                <?php foreach ($mantenimientos as $mant): ?>
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <strong class="mb-1 text-primary"><?php echo htmlspecialchars($mant['type']); ?></strong>
                        <small class="text-muted"><?php echo date('d/m/Y', strtotime($mant['event_date'])); ?></small>
                    </div>
                    <p class="mb-1 small"><?php echo htmlspecialchars($mant['description']); ?></p>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="list-group-item text-center text-muted">Sin registros recientes.</div>
            <?php endif; ?>
        </div>

        <!-- Detenciones -->
        <h6 class="text-uppercase text-muted fw-bold small mb-2 ps-2">Últimas Detenciones</h6>
        <div class="table-responsive shadow-sm rounded border bg-white">
            <table class="table table-sm table-hover mb-0" style="font-size: 0.9rem;">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th class="text-end">Hrs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($detenciones) > 0): ?>
                        <?php foreach ($detenciones as $stop): ?>
                        <tr>
                            <td><?php echo date('d/m', strtotime($stop['start_time'])); ?></td>
                            <td><?php echo htmlspecialchars($stop['reason']); ?></td>
                            <td class="text-end fw-bold"><?php echo number_format($stop['downtime_hours'], 1); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center text-muted">Sin detenciones recientes.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>