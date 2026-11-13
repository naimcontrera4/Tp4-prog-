<?php
// 1. Predefinir Escala de Sueldos Básicos por Categoría
$escalaSueldos = [
    'A' => 4050.55,
    'B' => 3209.20,
    'C' => 2575.73,
    'D' => 1812.28
];

$resultado = null;
$error = null;

// 2. Procesar los datos cuando el formulario se envía por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = $_POST['categoria'] ?? '';
    $antiguedad = isset($_POST['antiguedad']) ? (int)$_POST['antiguedad'] : 0;

    // Validar que la categoría exista y la antigüedad esté entre 1 y 30
    if (array_key_exists($categoria, $escalaSueldos) && $antiguedad >= 1 && $antiguedad <= 30) {
        
        // Sueldo Básico según categoría seleccionada
        $sueldoBasico = $escalaSueldos[$categoria];

        // 3. Cálculo de Haberes (Desde el Sueldo Básico)
        $importeAntiguedad = ($sueldoBasico * 0.10) * $antiguedad; // 10% x cant. años
        $presentismo = $sueldoBasico * 0.15;                       // 15%
        $dedicacionEspecial = $sueldoBasico * 0.50;                // 50%

        $totalHaberes = $sueldoBasico + $importeAntiguedad + $presentismo + $dedicacionEspecial;

        // 4. Cálculo de Descuentos (Desde el Total Haberes)
        $obraSocial = $totalHaberes * 0.05;        // 5%
        $aporteJubilatorio = $totalHaberes * 0.11; // 11%

        $totalDescuentos = $obraSocial + $aporteJubilatorio;

        // 5. Cálculo del Total Neto
        $totalNeto = $totalHaberes - $totalDescuentos;

        // Guardar el detalle con códigos para mostrar en la vista
        $resultado = [
            'categoria' => $categoria,
            'antiguedad' => $antiguedad,
            'sueldo_basico' => $sueldoBasico,
            'conceptos' => [
                ['codigo' => '101', 'concepto' => 'Sueldo Básico', 'haberes' => $sueldoBasico, 'descuentos' => 0],
                ['codigo' => '102', 'concepto' => "Antigüedad (10% x {$antiguedad} años)", 'haberes' => $importeAntiguedad, 'descuentos' => 0],
                ['codigo' => '103', 'concepto' => 'Presentismo (15%)', 'haberes' => $presentismo, 'descuentos' => 0],
                ['codigo' => '104', 'concepto' => 'Dedicación Especial (50%)', 'haberes' => $dedicacionEspecial, 'descuentos' => 0],
                ['codigo' => '201', 'concepto' => 'Obra Social (5% s/ Total Haberes)', 'haberes' => 0, 'descuentos' => $obraSocial],
                ['codigo' => '202', 'concepto' => 'Aporte Jubilatorio (11% s/ Total Haberes)', 'haberes' => 0, 'descuentos' => $aporteJubilatorio],
            ],
            'total_haberes' => $totalHaberes,
            'total_descuentos' => $totalDescuentos,
            'total_neto' => $totalNeto
        ];
    } else {
        $error = "Por favor, seleccione una categoría válida e ingrese una antigüedad entre 1 y 30 años.";
    }
}

// Función auxiliar para dar formato de moneda ($ 0.000,00)
function formatoMoneda($valor) {
    return '$ ' . number_format($valor, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP N°1 - Liquidación de Sueldo | Programación III</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }
        .recibo-box {
            border-top: 4px solid #1e3c72;
        }
        .neto-box {
            background-color: #e8f5e9;
            border: 2px solid #2e7d32;
            color: #1b5e20;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Encabezado -->
    <div class="card header-card shadow-sm mb-4">
        <div class="card-body text-center py-4">
            <h2 class="fw-bold mb-1">Micro Sistema de Liquidación de Sueldo</h2>
            <p class="mb-0 opacity-75">Programación III - Trabajo Práctico N° 1</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Columna izquierda: Formulario y Escala -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white fw-semibold">
                    Ingresar Datos del Empleado
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="categoria" class="form-label fw-semibold">Categoría</label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="" disabled <?= !isset($_POST['categoria']) ? 'selected' : '' ?>>Seleccione una categoría...</option>
                                <?php foreach ($escalaSueldos as $cat => $basico): ?>
                                    <option value="<?= $cat ?>" <?= (isset($_POST['categoria']) && $_POST['categoria'] === $cat) ? 'selected' : '' ?>>
                                        Categoría <?= $cat ?> (Básico: <?= formatoMoneda($basico) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="antiguedad" class="form-label fw-semibold">Antigüedad (1 a 30 años)</label>
                            <input type="number" name="antiguedad" id="antiguedad" class="form-control" 
                                   min="1" max="30" required 
                                   value="<?= isset($_POST['antiguedad']) ? htmlspecialchars($_POST['antiguedad']) : '1' ?>">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-semibold">Calcular Liquidación</button>
                            <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="btn btn-outline-secondary btn-sm">Limpiar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla informativa con la escala predefinida -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white fw-semibold">
                    Escala de Sueldos Predefinida
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($escalaSueldos as $cat => $basico): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Categoría <strong><?= $cat ?></strong></span>
                            <span class="badge bg-light text-dark border fs-6"><?= formatoMoneda($basico) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Columna derecha: Recibo de Sueldo -->
        <div class="col-lg-8">
            <?php if ($resultado): ?>
                <div class="card shadow-sm recibo-box">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">Detalle de Liquidación</h5>
                        <div>
                            <span class="badge bg-primary fs-6 me-1">Categoría: <?= $resultado['categoria'] ?></span>
                            <span class="badge bg-info text-dark fs-6">Antigüedad: <?= $resultado['antiguedad'] ?> año(s)</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 12%;">Código</th>
                                        <th style="width: 44%;">Detalle / Concepto</th>
                                        <th style="width: 22%;">Haberes</th>
                                        <th style="width: 22%;">Descuentos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultado['conceptos'] as $item): ?>
                                        <tr>
                                            <td class="text-center fw-semibold text-secondary"><?= $item['codigo'] ?></td>
                                            <td><?= $item['concepto'] ?></td>
                                            <td class="text-end text-success fw-medium">
                                                <?= $item['haberes'] > 0 ? formatoMoneda($item['haberes']) : '-' ?>
                                            </td>
                                            <td class="text-end text-danger fw-medium">
                                                <?= $item['descuentos'] > 0 ? formatoMoneda($item['descuentos']) : '-' ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-group-divider fw-bold">
                                    <tr class="table-light">
                                        <td colspan="2" class="text-end">SUBTOTALES:</td>
                                        <td class="text-end text-success"><?= formatoMoneda($resultado['total_haberes']) ?></td>
                                        <td class="text-end text-danger"><?= formatoMoneda($resultado['total_descuentos']) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Resumen de Totales -->
                        <div class="row mt-4 g-3">
                            <div class="col-md-4">
                                <div class="p-3 border rounded bg-light text-center">
                                    <small class="text-muted d-block text-uppercase fw-semibold">Total Haberes</small>
                                    <span class="fs-5 fw-bold text-success"><?= formatoMoneda($resultado['total_haberes']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded bg-light text-center">
                                    <small class="text-muted d-block text-uppercase fw-semibold">Total Descuentos</small>
                                    <span class="fs-5 fw-bold text-danger"><?= formatoMoneda($resultado['total_descuentos']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded neto-box text-center">
                                    <small class="d-block text-uppercase fw-bold">Total Neto a Cobrar</small>
                                    <span class="fs-4 fw-bold"><?= formatoMoneda($resultado['total_neto']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card shadow-sm h-100 d-flex align-items-center justify-content-center p-5 text-center text-muted">
                    <div>
                        <h5>Esperando datos de liquidación</h5>
                        <p class="mb-0">Seleccione una categoría y los años de antigüedad en el panel izquierdo para generar el recibo.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>