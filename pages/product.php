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
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$category = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $category .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$category .= "</select>";

$sql2 = "SELECT DISTINCT CUST_ID, FIRST_NAME, RUC FROM customer order by FIRST_NAME asc";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");

$cli = "<select class='form-control' name='customer' required>
        <option disabled selected hidden>Seleccionar Cliente</option>";
  while ($row = mysqli_fetch_assoc($result2)) {
    $cli .= "<option value='" . $row['CUST_ID'] . "'>" . $row['FIRST_NAME'] . " - " . $row['RUC'] . "</option>";
  }

$cli .= "</select>";


?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Contratos&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                    <!--<th>Id Contrato</th>-->
                     <th>Cliente</th>
                     <th>Categoría</th>
                     <th>Cantidad de Lotes</th>
                     <th>Día de Ingreso</th>
                     <th>Precio</th>
                     <th>Acción</th>
                   </tr>
               </thead>
          <tbody>

               
<?php                  
    $query = 'SELECT c.CONTRAC_ID, ca.CNAME, cu.FIRST_NAME, c.CANT_LOTES, c.DATE_STOCK_IN, c.PRICE FROM contrac c JOIN category ca ON c.CATEGORY_ID = ca.CATEGORY_ID JOIN customer cu ON c.CUST_ID = cu.CUST_ID GROUP BY c.CONTRAC_ID;';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                //echo '<td>'. $row['CONTRAC_ID'].'</td>';
                echo '<td>'. $row['FIRST_NAME'].'</td>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['CANT_LOTES'].'</td>';
                echo '<td>'. $row['DATE_STOCK_IN'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="pro_searchfrm.php?action=edit & id='.$row['CONTRAC_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Detalles</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pro_edit.php?action=edit & id='.$row['CONTRAC_ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
                echo '</tr> ';
                        }
?>                 

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

<?php
include'../includes/footer.php';
?>

  <!-- Product Modal-->
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir Contrato</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="pro_transac.php?action=add">
          <div class="form-group">
             <?php
               echo $category;
             ?>
           </div>
           <div class="form-group">
             <?php
               echo $cli;
             ?>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" texarea class="form-control" placeholder="Description" name="description" required></textarea>
           </div>
           <div class="form-group">
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Ingreso de Lote" name="datestock_in" required>
           </div>
           <div class="form-group">
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Salida de Lote" name="datestock_out" required>
           </div>
           <!-- <div class="form-group">
             <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="price" required>
           </div> -->
           <div class="form-group">
             <input type="number"  min="1" max="10" class="form-control" placeholder="Cantidad de Lotes" name="cant_lotes" required>
           </div>
           
           
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Guardar</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i></button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>