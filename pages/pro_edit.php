<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$categoryOptions = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Select Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $categoryOptions .= "<option value='" . $row['CATEGORY_ID'] . "'>" . $row['CNAME'] . "</option>";
}

$categoryOptions .= "</select>";

  $query = 'SELECT c.CONTRAC_ID, ca.CNAME, cu.FIRST_NAME, c.CANT_LOTES, c.DESCRIPTION, c.DATE_STOCK_IN, c.DATE_STOCK_OUT, c.PRICE FROM contrac c JOIN category ca ON c.CATEGORY_ID = ca.CATEGORY_ID JOIN customer cu ON c.CUST_ID = cu.CUST_ID WHERE c.CONTRAC_ID ='.$_GET['id'];

  /* $query = 'SELECT PRODUCT_ID,PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE PRODUCT_ID ='.$_GET['id']; */
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $contrato = $row['CONTRAC_ID'];
      $cliente = $row['FIRST_NAME'];
      $fecha = $row['DATE_STOCK_OUT'];
      $descrip = $row['DESCRIPTION'];
      $price = $row['PRICE'];
      $currentCategory  = $row['CNAME'];
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Editar Contrato</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">

            <form role="form" method="post" action="pro_edit1.php">
              <input type="hidden" name="id" value="<?php echo $contrato; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Código de contrato:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Code" name="prodcode" value="<?php echo $contrato; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Nombre del cliente:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Name" name="cliente" value="<?php echo $cliente; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Descripción:
                </div>
                <div class="col-sm-9">
                   <textarea class="form-control" placeholder="Description" name="description"><?php echo $descrip; ?></textarea>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Fecha fin:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type= "date" placeholder="Fecha fin" name="fecha" value="<?php echo $fecha; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Precio:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Price" name="price" value="<?php echo $price; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Categoría:
                </div>
                <div class="col-sm-9">
                   <?php
                    echo $categoryOptions;
                   ?>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Actualizar</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>