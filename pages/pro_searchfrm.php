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
            ?>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Detalle de contrato</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
            <div class="card-body">
          <?php 
            $query = 'SELECT CONTRAC_ID, ca.CNAME, cu.FIRST_NAME, DATE_STOCK_IN, DATE_STOCK_OUT,DESCRIPTION, PRICE, CANT_LOTES FROM contrac c JOIN category ca ON c.CATEGORY_ID = ca.CATEGORY_ID JOIN customer cu ON c.CUST_ID = cu.CUST_ID WHERE CONTRAC_ID ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
                $contrac= $row['CONTRAC_ID'];
                $category= $row['CNAME'];
                $cli= $row['FIRST_NAME'];
                $stock_in=$row['DATE_STOCK_IN'];
                $stock_out=$row['DATE_STOCK_OUT'];
                $des=$row['DESCRIPTION'];
                $cant=$row['CANT_LOTES'];
                $price=$row['PRICE'];
              }
              $id = $_GET['id'];
          ?>

                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Código de contrato<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $contrac; ?><br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Nombre de categoría<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $category; ?> <br>
                        </h5>
                      </div>
                    </div>
                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Nombre Cliente<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $cli; ?><br>
                        </h5>
                      </div>
                    </div>
                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Fecha de entrada<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $stock_in; ?><br>
                        </h5>
                      </div>
                    </div>
                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Fecha de salida<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $stock_out; ?><br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Descripción<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $des; ?><br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Cantidad de Lotes<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $cant; ?><br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Precio<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $price; ?><br>
                        </h5>
                      </div>
                    </div>
                </div>
          </div></center>
<!--
          <div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Inventario</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Código de producto</th>
                     <th>Nombre</th>
                     <th>Cantidad</th>
                     <th>En mano</th>
                     <th>Category</th>
                     <th>Proveedor</th>
                     <th>Fecha de stock en</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
   /* $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, COUNT("QTY_STOCK") AS QTY_STOCK, COUNT("ON_HAND") AS ON_HAND, CNAME, COMPANY_NAME, p.SUPPLIER_ID, DATE_STOCK_IN FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID JOIN supplier s ON p.SUPPLIER_ID=s.SUPPLIER_ID where PRODUCT_CODE ='.$zzz.' GROUP BY `SUPPLIER_ID`, `DATE_STOCK_IN`';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>'. $row['QTY_STOCK'].'</td>';
                echo '<td>'. $row['ON_HAND'].'</td>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['COMPANY_NAME'].'</td>';
                echo '<td>'. $row['DATE_STOCK_IN'].'</td>';
                echo '</tr> ';
                        }*/
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>-->


<?php
include'../includes/footer.php';
?>