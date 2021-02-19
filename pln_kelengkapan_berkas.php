
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/pln_kelengkapan_berkas.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<script language=javascript1.2 src='js/calendar.js'></script>
<link rel="stylesheet" href="style/generic.css" />
<script language=JavaScript1.2 src='js/drag.js'></script>


<!DOCTYPE html>
<html>
  <?
include('headermenupln.html');
  ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kelengkapan Berkas Kontrak</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <!--  <label>Minimal</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select> -->
                  <?php
                     $optjenkontrak="<option value=''>Seluruhnya</option>";
                       #data Jenis KOntrak
                      $strjenkontrak = "select kode_kontrak,nama_kontrak from " . $dbname . ".mst_jenis_kontrak_pln where status='1'";
                      $resjenkontrak=$owlPDO->query($strjenkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $resjenkontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barjenkontrak = $resjenkontrak->fetch()) {
                        $optjenkontrak.="<option value='" . $barjenkontrak->kode_kontrak . "'>" . $barjenkontrak->nama_kontrak. "</option>";
                      }


                   
                  echo"
                      <table>
                      <tr>
                      <th>&nbsp;</th>
                      <th>No Kontrak</th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th><input type=text class='form-control filter' id=nokontrak name=nokontrak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></th>
                      <td>&nbsp;</td>

                    

                      </tr>
                      <tr>
                      <th>&nbsp;</th>
                      <th>Judul Kontrak</th>
                         <th>&nbsp;</th>
                      <td><input type=text class='form-control filter' id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
            
                      </tr>
                      <tr>
                      <th>&nbsp;</th>
                      <th>Tanggal Kontrak</th>
                         <th>&nbsp;</th><td><input type='text' class='form-control float-right' id='reservation' style='height:25px; width:200px;'></td>
                      </tr>

                       <tr>
                       <th>&nbsp;</th>
                       <th>Jenis Kontrak</th>
                      <th>&nbsp;</th>
                      <td><select id=\"jeniskontrak\" name=\"jeniskontrak\" style='height:25px; width:200px;'>".$optjenkontrak."</select></td>
                
                      </tr>
                     

                      </table><br>
          

                        <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=preview() >Tampilkan</button>";

                         ?>
                    
                     

                </div>
               
              </div>
              
              </div>
      
            </div>


            
            <!-- /.row -->
          </div>
 <!-- /.card-body -->


          <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                      <thead>
                      <tr class=rowheader>
                      <td>No</td>
                      <td>No Kontrak</td>
                      <td>Judul Kontrak</td>
                      <td>Tanggal Kontrak</td>
                      <td>Nama Vendor</td>
                      <td>Nilai Kontrak</td>
                      <td>Jenis Kontrak</td>
                      <td>Sifat Pekerjaan</td>
                      <td>Sifat BA</td>
                      <td>Aksi</td>

                      </tr>
                      </thead>
                      <tbody id=container>";
                      echo"<script>loadData(0)</script>";
                      echo"</tbody>
                      <tfoot id='footData'>
                      </tfoot>
                      </table>";

                      ?>                  


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
         
        <div class="card-footer">
            Visit <a href="index2.php">PLN</a> for more information.
          </div>
        </div>
        <!-- /.card -->

       

        

       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?
include('footer.html');
  ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
</body>
</html>





