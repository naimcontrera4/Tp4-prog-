# Guion Completo de Grabación en OBS (4 Integrantes)
**Materia:** Programación III — Trabajo Práctico N° 1: Liquidación de Sueldo en PHP  
**Modalidad:** Cámara encendida + Diapositivas de fondo $\rightarrow$ Corte en OBS a VS Code / Navegador (`localhost`).

---

## Resumen de Asignación por Integrante

| Integrante | Diapositivas asignadas | Qué muestra en el corte de OBS | Líneas de `index.php` |
| :--- | :--- | :--- | :--- |
| **Integrante 1** | **Diapositivas 1 a 4** | Terminal en VS Code + Navegador en `http://localhost:8000` | Demostración funcional en vivo |
| **Integrante 2** | **Diapositivas 5 a 7** | Editor VS Code: Escala, validación `POST` y Haberes | **Líneas 1 a 30** |
| **Integrante 3** | **Diapositivas 8 y 9** | Editor VS Code: Descuentos, Neto, Códigos y Moneda | **Líneas 31 a 63** |
| **Integrante 4** | **Diapositivas 10 a 12** | Editor VS Code: HTML5, Bootstrap 5, Formulario y Tabla | **Líneas 65 a 224 (final)** |

---

## 👤 INTEGRANTE 1: Presentación, IA Elegida, Prompt y Demo en `localhost`

### Parte A: En OBS con las Diapositivas de fondo (Hojas 1 a 4)

* **Diapositiva 1 (Portada):**
  > *"Hola, ¿qué tal? Buenas a todos. Nosotros somos el grupo conformado por [Nombre 1], [Nombre 2], [Nombre 3] y [Nombre 4]. En este video vamos a presentar la resolución del Trabajo Práctico Número 1 de la cátedra Programación III, el cual consiste en el análisis, generación mediante Inteligencia Artificial y puesta en marcha de un Micro Sistema de Liquidación de Sueldos desarrollado en PHP y maquetado con Bootstrap 5."*

* **Diapositiva 2 (Elección de IA: Google Gemini):**
  > *"Siguiendo las pautas del trabajo práctico, luego de analizar el comportamiento del sistema de referencia de la cátedra, seleccionamos la inteligencia artificial Google Gemini para la generación del código. Fundamentamos nuestra predilección por esta herramienta en tres ventajas concretas que obtuvimos durante las pruebas:*  
  > *En primer lugar, nos permitió estructurar un archivo único `index.php` donde conviven de forma limpia y ordenada la lógica de negocio del servidor y la interfaz gráfica. En segundo lugar, implementó validaciones estrictas del lado del servidor para evitar que se procesen categorías inexistentes o años de antigüedad fuera del rango de $1$ a $30$. Y en tercer lugar, resolvió toda la estética responsiva con Bootstrap 5 y el formateo de moneda local sin necesidad de instalar librerías externas."*

* **Diapositiva 3 (Estructura del Prompt Utilizado):**
  > *"En esta diapositiva mostramos el prompt exacto que diseñamos para darle instrucciones precisas a la IA. Le asignamos el rol de un desarrollador experto en PHP y diseño web, y le detallamos todas las reglas de negocio: primero, predefinir en un arreglo asociativo las cuatro categorías salariales ($A, B, C$ y $D$) con sus respectivos sueldos básicos; segundo, recibir por el método `POST` la categoría y la antigüedad para calcular los Haberes tomando como base el Sueldo Básico; tercero, calcular los Descuentos tomando como base el Total de Haberes; y finalmente, renderizar un recibo de sueldo completo con códigos identificadores, subtotales y el sueldo neto a cobrar."*

* **Diapositiva 4 (Funcionamiento en Localhost):**
  > *"Antes de pasar a la demostración práctica, resumimos aquí el flujo de ejecución en cuatro pasos: levantamos el servidor local integrado de PHP en el puerto $8000$, ingresamos la categoría y los años de antigüedad en el formulario cliente, enviamos la petición mediante `POST` para que el servidor procese las fórmulas instantáneamente, y recibimos en pantalla el desglose completo del recibo. Ahora pasamos a nuestra pantalla de trabajo para verlo funcionando en vivo desde nuestro propio `localhost`."*

---

### Parte B: 🎬 CORTE EN OBS $\rightarrow$ Pasar a VS Code (Terminal) y Navegador (`localhost`)

1. **Mostrar brevemente la terminal de VS Code:**
   * Señala con el mouse la consola inferior donde se ejecutó `php -S localhost:8000`.
   * **Decir:** *"Aquí en Visual Studio Code ya tenemos levantado nuestro servidor local de PHP escuchando en `localhost:8000`."*
2. **Pasar a la ventana del navegador (`http://localhost:8000`):**
   * Señala el panel izquierdo del sistema.
   * **Decir:** *"Al abrir el sistema en el navegador, vemos a la izquierda el formulario de carga junto con el cuadro informativo de la escala de sueldos predefinida para las categorías $A, B, C$ y $D$. A la derecha, el sistema nos muestra un aviso indicando que está esperando los datos para generar el recibo."*
3. **Hacer una prueba real (Categoría A con 10 años):**
   * Despliega el selector, elige **Categoría A (Básico: $\$4.050,55$)**, escribe **`10`** en el campo de antigüedad y haz clic en **"Calcular Liquidación"**.
   * **Decir:** *"Vamos a hacer una prueba seleccionando la Categoría A y cargando $10$ años de antigüedad. Al presionar 'Calcular Liquidación', vemos cómo el sistema procesa los datos sin recargar otra página externa y nos genera a la derecha el Detalle de Liquidación. Nos indica arriba mediante etiquetas que corresponde a la Categoría A con $10$ años, nos lista en la tabla los códigos del $101$ al $104$ con los haberes en color verde, los códigos $201$ y $202$ con los descuentos de Obra Social y Jubilación en color rojo, los subtotales y abajo los tres recuadros destacados con el Total Haberes de $\$10.733,96$, el Total Descuentos de $\$1.717,43$ y el Total Neto a cobrar de $\$9.016,53$."*
4. **Probar otra categoría o el botón Limpiar:**
   * Haz clic en el botón **"Limpiar"** (o cambia a Categoría C con 5 años y calcula).
   * **Decir:** *"Si presionamos el botón 'Limpiar', el sistema restablece el formulario a su estado inicial para realizar una nueva consulta. A continuación, mi compañero va a explicar la primera parte del código PHP."*

---

## 👤 INTEGRANTE 2: Escala Salarial, Recepción POST y Cálculo de Haberes

### Parte A: En OBS con las Diapositivas de fondo (Hojas 5 a 7)

* **Diapositiva 5 (Escala de Sueldos Predefinida):**
  > *"Hola, buenas. Yo voy a explicar el primer bloque lógico de nuestro script `index.php`, que abarca desde la línea $1$ hasta la línea $30$. Lo primero que hacemos al iniciar el archivo es predefinir la escala salarial dentro de una estructura de datos en memoria. Para esto utilizamos un array asociativo llamado `$escalaSueldos`, donde cada letra de categoría ($A, B, C$ y $D$) funciona como clave única y almacena como valor numérico flotante el sueldo básico que exige la consigna: $\$4.050,55$ para la categoría $A$, $\$3.209,20$ para la $B$, $\$2.575,73$ para la $C$ y $\$1.812,28$ para la $D$. Este valor constituye el $100\%$ de la base sobre la cual se van a calcular los adicionales remunerativos."*

* **Diapositiva 6 (Recepción POST y Validación de Datos):**
  > *"En la siguiente sección programamos la recepción y validación de los datos enviados por el usuario. Primero verificamos mediante la variable superglobal `$_SERVER['REQUEST_METHOD']` que la petición haya ingresado estrictamente por el método `POST`. Luego capturamos la categoría seleccionada y convertimos el valor de la antigüedad a un número entero con `(int)` para evitar inyecciones de texto o valores decimales. Antes de ejecutar cualquier operación matemática, aplicamos una validación de seguridad: comprobamos con la función `array_key_exists()` que la categoría enviada realmente exista dentro de nuestro arreglo de sueldos y que la antigüedad sea mayor o igual a $1$ y menor o igual a $30$ años."*

* **Diapositiva 7 (Cálculo de Haberes sobre el Sueldo Básico):**
  > *"Una vez superada la validación, extraemos el sueldo básico correspondiente a la categoría elegida y calculamos los tres conceptos de Haberes tomando siempre como base ese Sueldo Básico:*  
  > *Para la **Antigüedad** (Código $102$), calculamos el $10\%$ del sueldo básico multiplicándolo por $0.10$ y a ese resultado lo multiplicamos por la cantidad de años de antigüedad ingresados. Para el **Presentismo** (Código $103$), calculamos el $15\%$ directo sobre el sueldo básico multiplicando por $0.15$. Y para la **Dedicación Especial** (Código $104$), calculamos el $50\%$ del sueldo básico multiplicando por $0.50$. Finalmente, sumamos el sueldo básico más estos tres adicionales en la variable `$totalHaberes`. Pasemos ahora a Visual Studio Code para observar cómo está codificado este bloque."*

---

### Parte B: 🎬 CORTE EN OBS $\rightarrow$ Pasar a VS Code (Líneas 1 a 30 de `index.php`)

1. **Señalar con el mouse las líneas 2 a 11:**
   * **Decir:** *"Aquí estamos en el archivo `index.php`. Entre las líneas $3$ y $8$ vemos declarado el arreglo asociativo `$escalaSueldos` con las cuatro categorías y sus montos separados por punto decimal, que es el formato con el que opera internamente PHP. En las líneas $10$ y $11$ inicializamos las variables `$resultado` y `$error` en `null` para controlar qué se muestra en la vista antes de enviar el formulario."*
2. **Señalar con el mouse las líneas 13 a 22:**
   * **Decir:** *"En la línea $14$ tenemos el condicional `if ($_SERVER['REQUEST_METHOD'] === 'POST')`. En las líneas $15$ y $16$ capturamos `$_POST['categoria']` usando el operador de fusión nula `??` por si llega vacío, y casteamos `$_POST['antiguedad']` a entero. En la línea $19$ vemos el `if` de validación que exige que se cumplan las tres condiciones al mismo tiempo mediante el operador lógico `&&`: que la clave exista en el arreglo y que la antigüedad esté entre $1$ y $30$. Si se cumple, en la línea $22$ obtenemos el `$sueldoBasico`."*
3. **Señalar con el mouse las líneas 24 a 29:**
   * **Decir:** *"Finalmente, entre las líneas $25$ y $27$ ejecutamos las fórmulas de los haberes sobre `$sueldoBasico`: en la $25$ calculamos `$importeAntiguedad` haciendo `($sueldoBasico * 0.10) * $antiguedad`, en la $26$ obtenemos `$presentismo` por `0.15`, en la $27$ `$dedicacionEspecial` por `0.50`, y en la línea $29$ consolidamos la suma de los cuatro conceptos en `$totalHaberes`. Ahora le doy el pase a mi compañero para que explique el cálculo de descuentos y la estructura de salida."*

---

## 👤 INTEGRANTE 3: Cálculo de Descuentos, Neto, Códigos y Moneda

### Parte A: En OBS con las Diapositivas de fondo (Hojas 8 y 9)

* **Diapositiva 8 (Cálculo de Descuentos sobre Total Haberes):**
  > *"Hola, ¿qué tal? Yo voy a continuar con la explicación de la segunda mitad de la lógica PHP, que va desde la línea $31$ hasta la línea $63$. Una vez que el sistema obtuvo el Total de Haberes, pasamos al cálculo de las retenciones o descuentos de ley. Es muy importante destacar que, tal como lo especifica la consigna del trabajo práctico, los descuentos no se calculan sobre el sueldo básico inicial, sino sobre el **Total de Haberes** acumulado.*  
  > *Aplicamos un $5\%$ correspondiente a la Obra Social y un $11\%$ correspondiente al Aporte Jubilatorio, lo que representa una retención total del $16\%$ sobre el bruto. Luego sumamos ambos conceptos en la variable `$totalDescuentos` y obtenemos el sueldo líquido o `$totalNeto` restándole al Total de Haberes el Total de Descuentos."*

* **Diapositiva 9 (Estructura de Códigos y Formato Moneda):**
  > *"Además de realizar los cálculos matemáticos, necesitábamos organizar la información para cumplir con el requisito de mostrar el detalle de códigos en el recibo. Para resolverlo de forma escalable, armamos un arreglo multidimensional llamado `$resultado` donde cada ítem del recibo tiene asignado su código identificador: del `101` al `104` para los conceptos de haberes y los códigos `201` y `202` para las retenciones de Obra Social y Jubilación.*  
  > *Por último, en este mismo bloque creamos una función auxiliar llamada `formatoMoneda()`, que utiliza la función nativa `number_format()` de PHP para transformar cualquier número decimal del servidor al formato monetario que usamos en Argentina, es decir, anteponiendo el signo pesos, utilizando la coma para los dos decimales y el punto como separador de miles. Vamos a pasar a Visual Studio Code para ver estas líneas en detalle."*

---

### Parte B: 🎬 CORTE EN OBS $\rightarrow$ Pasar a VS Code (Líneas 31 a 63 de `index.php`)

1. **Señalar con el mouse las líneas 31 a 38:**
   * **Decir:** *"Mirando el código en VS Code, en las líneas $32$ y $33$ vemos cómo calculamos `$obraSocial` multiplicando `$totalHaberes * 0.05` y `$aporteJubilatorio` multiplicando `$totalHaberes * 0.11`. En la línea $35$ sumamos ambas variables dentro de `$totalDescuentos`, y en la línea $38$ realizamos la resta final `$totalHaberes - $totalDescuentos` para guardar el importe de bolsillo en `$totalNeto`."*
2. **Señalar con el mouse las líneas 40 a 58:**
   * **Decir:** *"A partir de la línea $41$ construimos el array asociativo `$resultado`. Guardamos la categoría, la antigüedad, el básico y, dentro de la clave `'conceptos'`, definimos una lista de seis arreglos —uno por cada renglón del recibo— indicando su `'codigo'`, su descripción en `'concepto'` (donde incluso interpolamos la cantidad de años de antigüedad en el código $102$), el monto en `'haberes'` y el monto en `'descuentos'`. Al final del arreglo guardamos los tres totales generales. Y en la línea $56$ vemos el bloque `else` que asigna un mensaje de validación a la variable `$error` en caso de que el usuario intente enviar datos fuera de rango."*
3. **Señalar con el mouse las líneas 60 a 63:**
   * **Decir:** *"Por último, entre las líneas $61$ y $63$ tenemos declarada la función `formatoMoneda($valor)`, que retorna el símbolo `$` concatenado con `number_format($valor, 2, ',', '.')`, garantizando que todos los importes del recibo se impriman siempre con dos decimales exactos. Ahora mi compañero va a explicar la última parte del código correspondiente al HTML y Bootstrap."*

---

## 👤 INTEGRANTE 4: Maquetado con Bootstrap 5, Caso Práctico y Tabla Dinámica

### Parte A: En OBS con las Diapositivas de fondo (Hojas 10 a 12)

* **Diapositiva 10 (Maquetado Responsivo con Bootstrap 5):**
  > *"Hola a todos. Para finalizar, yo voy a explicar la capa de vista e interfaz de usuario del sistema, que abarca desde la línea $65$ hasta el final del script. Para lograr una presentación moderna y adaptable a cualquier pantalla, integramos el framework **Bootstrap 5** mediante su CDN oficial junto con reglas CSS personalizadas.*  
  > *Estructuramos la pantalla utilizando el sistema de grillas de Bootstrap (`row` y `col`), dividiendo el contenedor principal en dos paneles: una columna izquierda de $4$ unidades (`col-lg-4`) destinada al formulario de ingreso de datos y a la tabla informativa de categorías; y una columna derecha de $8$ unidades (`col-lg-8`) reservada para desplegar el recibo de sueldo. Además, implementamos generación dinámica con bucles `foreach` para que el desplegable de categorías tome sus valores directamente del array de PHP y conserve seleccionada la opción del usuario después de presionar calcular."*

* **Diapositiva 11 (Caso Práctico: Categoría A con 10 Años de Antigüedad):**
  > *"En esta gráfica resumimos visualmente cómo impactan los porcentajes en la interfaz tomando el caso práctico de un empleado de Categoría A con $10$ años de antigüedad. Vemos en la barra superior verde que el Sueldo Básico de $\$4.050,55$ sumado a los tres adicionales alcanza un Total de Haberes de $\$10.733,96$, que representa el $100\%$ del sueldo bruto. En la barra intermedia roja observamos cómo actúa el $16\%$ de retenciones ($\$536,70$ de Obra Social más $\$1.180,74$ de Jubilación), descontando $\$1.717,43$. Y en la barra inferior azul vemos el resultado final que destaca nuestro recibo: un Total Neto a cobrar de $\$9.016,53$, equivalente al $84\%$ del total de haberes."*

* **Diapositiva 12 (Cierre de Diapositivas):**
  > *"Vamos a pasar por última vez a Visual Studio Code para mostrar en el código cómo se conectan las variables de PHP con las etiquetas HTML y las clases de Bootstrap."*

---

### Parte B: 🎬 CORTE EN OBS $\rightarrow$ Pasar a VS Code (Líneas 65 al final de `index.php`)

1. **Señalar con el mouse las líneas 65 a 92 (`<head>` y `<style>`):**
   * **Decir:** *"Aquí en la línea $71$ de nuestro archivo `index.php` vemos la etiqueta `<link>` que carga Bootstrap $5.3$ desde el CDN, y entre las líneas $72$ y $90$ definimos nuestros estilos CSS propios: un degradado azul para el encabezado principal (`.header-card`), un borde superior para la caja del recibo (`.recibo-box`) y un fondo verde suave con borde destacado para el cuadro del sueldo neto (`.neto-box`)."*
2. **Señalar con el mouse las líneas 102 a 146 (Formulario y Escala):**
   * **Decir:** *"Más abajo, en la línea $103$, abrimos la columna izquierda `col-lg-4`. En la línea $108$ verificamos si existe algún `$error` para mostrar una alerta roja de Bootstrap. En la línea $112$ inicia el `<form method="POST">`, y entre las líneas $117$ y $121$ vemos el bucle `foreach ($escalaSueldos as $cat => $basico)` que genera cada etiqueta `<option>` de forma automática, incluyendo un operador ternario para dejar el atributo `selected` activo en la categoría que eligió el usuario. Debajo tenemos el `<input type="number">` validado con atributos `min="1"` y `max="30"`, los botones de envío y limpieza, y en las líneas $140$ a $147$ otro `foreach` que dibuja el cuadro de referencia con la escala salarial."*
3. **Señalar con el mouse las líneas 152 al final (Tabla del Recibo y Totales):**
   * **Decir:** *"Finalmente, en la línea $152$ comienza la columna derecha `col-lg-8`. Mediante el condicional `<?php if ($resultado): ?>` de la línea $153$, comprobamos si ya se procesó una liquidación. Si es verdadero, imprimimos las insignias con la categoría y antigüedad, y en la línea $173$ recorremos `$resultado['conceptos']` con un `foreach` para generar dinámicamente cada fila `<tr>` de la tabla: imprimimos el código, el nombre del concepto, en la columna de haberes mostramos el importe formateado en color verde (`text-success`) si es mayor a cero o un guion si no corresponde, y hacemos lo mismo en color rojo (`text-danger`) para la columna de descuentos.*  
   > *En el `<tfoot>` de la línea $187$ imprimimos los subtotales, y entre las líneas $196$ y $215$ maquetamos las tres tarjetas inferiores que muestran el Total Haberes, Total Descuentos y el Total Neto a Cobrar. Si aún no se enviaron datos, el bloque `else` de la línea $218$ muestra el recuadro pidiendo seleccionar una categoría. Con esto cumplimos todos los objetivos del Trabajo Práctico N° 1. ¡Muchas gracias!"*