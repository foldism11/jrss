
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/setup_jeniskontrak_pln.js'></script>
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
            <h1>Master Jenis Kontrak</h1>
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
                      #data nama penyedia barang dan jasa
                      $optstts="<option value=''>Pilih Data</option>";
                

                      $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                      foreach ($arr as $key => $value) {
                        $optstts.="<option value='" . $key . "'>" . $value. "</option>";
                      }



               
                                echo"<table style='font-size:12px; width: 450px;'>";
                              
                                 echo"<tr>
                                        <th>ID Kontrak</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=idkontrak name=idkontrak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' / disabled></th>
                                        <td></td>
                                     </tr>";
                                 echo"<tr>
                                        <th>Jenis Kontrak</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=jnskontrak name=jeniskontrak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";     
                                 echo"<tr>                          
                                      <th valign=top>Deskripsi</th>
                                      <th></th>
                                      <td><textarea name=ket id=ket  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>
                                     </tr>";

                                echo"<tr>
                                        <th>Status</th>
                                        <th></th>
                                        <td align='left'><select id=\"status\" name=\"status\" style='height:25px; width:300px;'>".$optstts."</select></td>
                                        <td></td>
                                     </tr>";

                                echo"</table>";
                          echo"</td>";
                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                          }

                     echo" </table><br><br>";
                      
                      echo"<table>";
                      echo"<tr>
                         <input type=hidden value=insert id=method>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-secondary' onclick=simpan() >Simpan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-secondary' onclick=cancelIsi()>Batal</button></td>
                      </tr>
                      </table>";

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
              <div class="card-body">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                      <thead>
                      <tr class=rowheader>
                      <td>No</td>
                      <td>ID Kontrak</td>
                      <td>Nama Kontrak</td>
                      <td>Deskripsi</td>
                      <td>Status</td>
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

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
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





