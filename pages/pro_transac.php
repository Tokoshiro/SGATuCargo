<?php
// Punto 1: Muestra errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/connection.php';
?>
<!-- Page Content -->
<div class="col-lg-12">
    <?php
    // Punto 2: Agregar registro a tu archivo PHP
    error_log("Accediendo a pro_transac.php");

    $desc = $_POST['description'];
    //$pr = $_POST['price'];
    $cat = $_POST['category'];
    $cli = $_POST['customer'];
    $dats_in = $_POST['datestock_in'];
    $dats_out = $_POST['datestock_out'];
    $cant = $_POST['cant_lotes'];
    $pr = $cant * 1000;

    switch ($_GET['action']) {
        case 'add':
            // Punto 3: Imprimir consulta SQL
            $query = "INSERT INTO contrac (CUST_ID, CATEGORY_ID, DESCRIPTION, DATE_STOCK_IN, DATE_STOCK_OUT, CANT_LOTES, PRICE )
                      VALUES ({$cli},{$cat},'{$desc}','{$dats_in}','{$dats_out}',{$cant}, {$pr})";
            error_log("Query: " . $query);

            // Ejecutar la consulta
            mysqli_query($db, $query) or die('Error in updating product in Database ' . $query);

            break;
    }
    ?>
    <script type="text/javascript">window.location = "product.php";</script>
</div>

<?php
include '../includes/footer.php';
?>