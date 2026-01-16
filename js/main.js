// js/main.js

console.log("--> Intentando cargar main.js <--");

// 1. Lógica del Gráfico KPI
const kpiCanvas = document.getElementById('kpiChart');

if (kpiCanvas) {
    console.log("Canvas encontrado. Iniciando gráfico...");

    // Obtener valor
    const kpiInput = document.getElementById('kpiValue');
    let kpiValue = 0;

    if (kpiInput) {
        kpiValue = parseFloat(kpiInput.value);
        console.log("Valor encontrado en input:", kpiValue);
    } else {
        console.warn("No se encontró el input hidden 'kpiValue', usando 0.");
    }

    const remaining = 100 - kpiValue;

    // Colores
    let chartColor = '#dc3545'; // Rojo
    if (kpiValue >= 90) chartColor = '#198754'; // Verde
    else if (kpiValue >= 80) chartColor = '#ffc107'; // Amarillo

    // Crear Gráfico
    try {
        new Chart(kpiCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Disponible', 'Detenido'],
                datasets: [{
                    data: [kpiValue, remaining],
                    backgroundColor: [chartColor, '#e9ecef'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                }
            }
        });
        console.log("Gráfico creado exitosamente.");
    } catch (e) {
        console.error("Error al crear Chart:", e);
    }

} else {
    // Es normal si no estamos en la página de detalle
    console.log("No estamos en una vista con gráfico (kpiChart no existe).");
}
