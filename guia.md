# Trabajo Práctico N° 1: Liquidación de Sueldo en PHP

**Materia:** Programación III  
**Fecha de Presentación:** 15/11/26 a horas 23:55

---

## 1. Organización Grupal para el Video (4 Integrantes)

Como son **4 integrantes** y cada uno se grabará explicando su parte en **OBS Studio**, la mejor estructura es dividir el video en **4 bloques secuenciales** (de aproximadamente 1 a 1.5 minutos por persona). Luego, uno del grupo une los 4 videos en cualquier editor (CapCut, Canva, Clipchamp o Premiere).

> **Recordatorio del TP:** Todos deben mostrarse en cámara mientras hablan y compartir su pantalla.

### Distribución de Roles (4 Partes)

#### Integrante 1: Presentación, IA Elegida, Prompt y Demostración en `localhost`
* **En pantalla:** Cámara encendida + ventana con el prompt utilizado y luego el navegador abierto en `http://localhost:8000` (o `http://localhost/tp1/`).
* **Qué debe explicar:**
  1. **Presentación:** Saludar y presentar a los 4 integrantes del grupo.
  2. **IA y Fundamentación:** Mencionar que utilizaron **Gemini** y justificar la elección: *"Elegimos Gemini porque nos permitió estructurar toda la lógica de cálculo en PHP 8 y maquetar el diseño con Bootstrap 5 en un único archivo limpio, resolviendo tanto las validaciones del formulario como el formato de moneda sin usar librerías externas"*.
  3. **Prompt utilizado (mostrarlo en pantalla):**
     > *"Actúa como un desarrollador experto en PHP y diseño web. Crea un micro-sistema de Liquidación de Sueldos en un único archivo `index.php` utilizando PHP 8, HTML5, CSS personalizado y Bootstrap 5. El sistema debe tener un formulario para seleccionar la Categoría (A, B, C o D) e ingresar la Antigüedad (de 1 a 30 años). Predefine en un array asociativo los sueldos básicos: Categoría A (\$4050.55), Categoría B (\$3209.20), Categoría C (\$2575.73) y Categoría D (\$1812.28). Al enviar por POST, calcula los Haberes sobre el Sueldo Básico: Antigüedad (10% del básico multiplicado por los años de antigüedad), Presentismo (15% del básico) y Dedicación Especial (50% del básico). Luego, calcula los Descuentos sobre el Total de Haberes: Obra Social (5%) y Aporte Jubilatorio (11%). Muestra un recibo de sueldo detallado con el Tipo de Categoría, tabla con Detalle de Códigos, Conceptos, Haberes, Descuentos, Total Haberes, Total Descuentos y Total Neto a cobrar."*
  4. **Prueba en vivo (`localhost`):** Mostrar el sistema funcionando en el navegador, elegir una categoría (ej. Categoría A con 10 años de antigüedad), presionar **"Calcular Liquidación"**, mostrar cómo se completa el recibo y probar el botón **"Limpiar"**.

---

#### Integrante 2: Explicación del Código PHP (Escala, Recepción POST y Cálculo de Haberes)
* **En pantalla:** Editor VS Code mostrando desde la **línea 1 hasta la línea 30** de `index.php`.
* **Qué debe explicar:**
  1. **Escala predefinida (Líneas 2 a 8):** Explicar el arreglo asociativo `$escalaSueldos`, donde cada clave (`A`, `B`, `C`, `D`) almacena el sueldo básico correspondiente en formato decimal.
  2. **Recepción y Validación (Líneas 13 a 22):** Explicar cómo PHP detecta el envío del formulario con `$_SERVER['REQUEST_METHOD'] === 'POST'`, captura `$_POST['categoria']` y `$_POST['antiguedad']` (convirtiéndola a entero con `(int)`), y valida mediante `array_key_exists()` que la categoría exista y que la antigüedad esté en el rango de `1` a `30`.
  3. **Cálculo de Haberes (Líneas 24 a 29):** Explicar que se obtiene el `$sueldoBasico` según la categoría elegida y sobre ese valor se calculan los adicionales:
     * **Antigüedad:** $10\%$ del básico (`$sueldoBasico * 0.10`) multiplicado por los años de antigüedad.
     * **Presentismo:** $15\%$ del básico (`$sueldoBasico * 0.15`).
     * **Dedicación Especial:** $50\%$ del básico (`$sueldoBasico * 0.50`).
     * Finalmente, cómo se suman todos estos importes en la variable `$totalHaberes`.

---

#### Integrante 3: Explicación del Código PHP (Descuentos, Neto, Estructura de Códigos y Moneda)
* **En pantalla:** Editor VS Code mostrando desde la **línea 31 hasta la línea 63** de `index.php`.
* **Qué debe explicar:**
  1. **Cálculo de Descuentos (Líneas 31 a 35):** Destacar que, a diferencia de los haberes, los descuentos se calculan tomando como base el **`$totalHaberes`**:
     * **Obra Social:** $5\%$ del total de haberes (`$totalHaberes * 0.05`).
     * **Aporte Jubilatorio:** $11\%$ del total de haberes (`$totalHaberes * 0.11`).
     * Ambos se suman en `$totalDescuentos`.
  2. **Total Neto y Arreglo de Resultados (Líneas 37 a 55):** Mostrar cómo se obtiene `$totalNeto` restando `$totalDescuentos` a `$totalHaberes`, y explicar el armado del array `$resultado`, donde se estructuran los conceptos con sus **códigos** (`101` al `104` para haberes, y `201` y `202` para descuentos) para poder recorrerlos luego en la tabla.
  3. **Manejo de errores y Formato Moneda (Líneas 56 a 63):** Mencionar el mensaje `$error` si los datos no son válidos y explicar la función auxiliar `formatoMoneda($valor)`, que usa `number_format()` para mostrar 2 decimales con coma y separador de miles con punto.

---

#### Integrante 4: Explicación del Código HTML, Bootstrap 5 y Renderizado del Recibo
* **En pantalla:** Editor VS Code mostrando desde la **línea 65 hasta el final** de `index.php`.
* **Qué debe explicar:**
  1. **Diseño y Formulario (Líneas 65 a 138):** Mencionar la carga de **Bootstrap 5** por CDN y los estilos CSS propios. Explicar el formulario (`method="POST"`), destacando cómo el `<select>` de categorías se genera dinámicamente con un bucle `foreach` recorriendo `$escalaSueldos`, al igual que el cuadro informativo de abajo.
  2. **Tabla de Detalle de Códigos (Líneas 141 a 187):** Explicar que si la variable `$resultado` existe, se muestra la cabecera con la categoría y antigüedad seleccionadas, y un bucle `foreach` recorre `$resultado['conceptos']` para imprimir cada fila con su código, concepto, columna de haberes (en verde) y columna de descuentos (en rojo), seguido de la fila de subtotales.
  3. **Resumen Final y Cierre (Líneas 189 al final):** Mostrar los tres recuadros inferiores que destacan el **Total Haberes**, **Total Descuentos** y el **Total Neto a Cobrar**, más el bloque `else` que muestra un mensaje de espera cuando aún no se enviaron datos. Despedir y agradecer en nombre del grupo.

---

## 2. Código Fuente Completo (`index.php`)

```php
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
```