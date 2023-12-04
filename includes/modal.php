<!-- Employee select and script -->
<?php
$sqlforjob = "SELECT DISTINCT JOB_TITLE, JOB_ID FROM job order by JOB_ID asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$job = "<select class='form-control' name='jobs' required>
        <option value='' disabled selected hidden>Select Job</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $job .= "<option value='".$row['JOB_ID']."'>".$row['JOB_TITLE']."</option>";
  }

$job .= "</select>";
?>
<script>  
window.onload = function() {  

  // ---------------
  // basic usage
  // ---------------
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  // ------------------
  // additional methods 
  // -------------------

  // will return all provinces 
  console.log($.getProvinces());
  
  // will return all cities 
  console.log($.getAllCities());
  
  // will return all cities under specific province (e.g Batangas)
  console.log($.getCities("Batangas")); 
  
}
</script>
<!-- end of Employee select and script -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo  $_SESSION['FIRST_NAME']; ?> ¿Estás seguro de que quieres cerrar sesión?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="logout.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Customer Modal-->
  <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="cust_transac.php?action=add">
          <div class="form-group">
              <input class="form-control" placeholder="RUC" name="ruc" required>
            </div>  
          <div class="form-group">
              <input class="form-control" placeholder="Razón Social" name="firstname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Nombre Comercial" name="lastname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
            </div>
            
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>
            Guardar</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Resetear</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  <!-- Customer Modal-->
  <div class="modal fade" id="poscustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="cust_pos_trans.php?action=add">
          <div class="form-group">
              <input class="form-control" placeholder="RUC" name="ruc" required>
            </div>  
          <div class="form-group">
              <input class="form-control" placeholder="Razón Social" name="firstname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Nombre Comercial" name="lastname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Guardar</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Resetear</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  <!-- Employee Modal-->
  <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar empleado</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="emp_transac.php?action=add">          
              <div class="form-group">
                <input class="form-control" placeholder="First Name" name="firstname" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" name="lastname" required>
              </div>
              <div class="form-group">
                  <select class='form-control' name='gender' required>
                    <option value="" disabled selected hidden>Seleccione género</option>
                    <option value="Male">Masculino</option>
                    <option value="Female">Mujer</option>
                  </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" name="email" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
              </div>
              <div class="form-group">
                <?php
                  echo $job;
                ?>
              </div>
              <div class="form-group">
                <input placeholder="Hired Date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="FromDate" name="hireddate" class="form-control" />
              </div>
              <div class="form-group">
                <select class="form-control" id="province" placeholder="Province" name="province" required></select>
              </div>
              <div class="form-group">
                <select class="form-control" id="city" placeholder="City" name="city" required></select>
              </div>
              <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Guardar</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Resetear</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>



  <!-- Delete Modal-->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">¿Estás seguro de que quieres eliminar?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-ok">Eliminar</a>
        </div>
      </div>
    </div>
  </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>