<?php
include('../includes/connection.php');

$contrato = $_POST['id'];
$fecha = $_POST['fecha'];
$cliente = $_POST['cliente'];
$descrip = $_POST['description'];
$price = $_POST['price'];
$categoryOptions = $_POST['category'];

$query = 'UPDATE contrac AS ct
          JOIN customer AS c ON ct.CUST_ID = c.CUST_ID
          SET ct.DESCRIPTION="' . $descrip . '",
              ct.DATE_STOCK_OUT="' . $fecha . '",
              ct.PRICE=' . $price . ',
              c.FIRST_NAME="' . $cliente . '"
          WHERE
              ct.CONTRAC_ID =' . $contrato;

$result = mysqli_query($db, $query) or die(mysqli_error($db));

?>
<script type="text/javascript">
    alert("Has actualizado el contrato exitosamente.");
    window.location = "product.php";
</script>