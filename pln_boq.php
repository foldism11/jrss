
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/pln_boq.js'></script>
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
            <h1>Bill Of Quantity</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="card" id="listmenu" style="display:block;">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive">
                <?php
                  echo "<table id='listmenu' align=center>
                  <tr>
                  <td  style='cursor:pointer;'> <img src=images/adddata.png width='130px' height='100px'  caption='Buat Baru' onclick=buatbaru()></td>
                  <td  style='cursor:pointer;'> <img src=images/listdata.png width='130px' height='100px'  caption='List Data' onclick=listdata()></td>
                  </tr>
                  <tr>
                  <td align=center>Buat Baru</td>
                  <td align=center>List Data</td>
                  </tr>
                  </table>";

                      ?>             


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card" id="headerlist" style="display:none;">
              <div class="card-header">
                <h3 class="card-title">Header</h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive">
                <?php

                $optnokontrak=$optsifatba=$optadm=$optpengk3=$optmgepbj=$optpenye=$optupt=$optdirpekerjaan=$optdirlap=$optpenglap=$optjenkontrak=$optsp=$opdirven="<option value=''>Pilih Data</option>";
                      $strpenye = "select kode_vendor,nama_vendor from " . $dbname . ".mst_vendor_pbj where status='1'";
                      $respenye=$owlPDO->query($strpenye) or die(print " Gagal: ".PDOException::getMessage());
                      $respenye->setFetchMode(PDO::FETCH_OBJ);
                      while ($barpenye = $respenye->fetch()) {
                        $optpenye.="<option value='" . $barpenye->kode_vendor . "'>" . $barpenye->nama_vendor. "</option>";
                      }

                 
                  echo"<table style='font-size:12px; width: 450px;'>";
                               

                                echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>No Transaksi</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=notrans name=notrans onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                        <th ></th>
                                    </tr>";

                               echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>Penyedia Barang Jasa (PBJ)</span></th>
                                        <th></th>
                                        <td align='left'><select  id=\"pbj\" name=\"pbj\" style='height:25px; width:300px;' onchange=\"getdatakontrak()\">".$optpenye."</select></td>
                                        <th ></th>
                                    </tr>";


                                 echo"<tr>
                                     <th width=4%></th>
                                    <th><span style='color: black'>No Kontrak</span></th>
                                    <th></th>
                                    <td><select  id=\"nokontrak\" name=\"nokontrak\" style='height:25px; width:300px;' onchange=\"getnilai()\">".$optnokontrak."</select></td>

                                   

                                  </tr>";

                                   echo"<tr id='amandemen' hidden>
                                     <th width=4%></th>
                                    <th><span style='color: black'>No Amandemen</span></th>
                                    <th></th>
                                     <td align='left'><input class='form-control filter' type=text class=myinputtext id=amd name=amd onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                  </tr>";




                                echo"<tr>
                                       <th width=4%></th>
                                      <th><span style='color: black'>Nilai Kontrak</span></th>
                                      <th></th>
                                      <td align='left'><input disabled class='form-control filter' type=text class=myinputtext id=nilai name=nilai onkeyup=\"z.numberFormat('nilai',2);\" style='height:25px; width:300px;' /></td>
                                     </tr>";

                                 echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>Lokasi Pekerjaan</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=lokasi name=lokasi onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                        <th ></th>
                                    </tr>";

                                    echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>Judul Pekerjaan</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                        <th ></th>
                                    </tr>";

                                    echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>Periode Kontrak 1</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=per1 name=per1 onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                        <th ></th>
                                    </tr>";

                                    echo"<tr>
                                        <th width=4%></th>
                                        <th><span style='color: black'>Periode Kontrak 2</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=per2 name=per2 onkeypress=\"return tanpa_kutip(event);\" disabled style='height:25px; width:300px;' /></td>
                                        <th ></th>
                                    </tr>";

                          


                                echo"</table><br>";

                                echo"<table>";
                                echo"<tr>
                                 <th width=4%></th>
                                <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpanheader() >Next</button></td>
                               
                                </tr>
                                </table><br>";

                ?>             


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          

          <!-- /.card-header -->
          <div class="card-body" id="header" style="display:none;">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                
                  <?php

                      $optjns=$optsatuan="<option value=''>Pilih Data</option>";
                   

                      $arrjns = array('1' =>'Barang' ,'2' =>'Jasa' );
                      foreach ($arrjns as $arr => $v) {
                        $optjns.="<option value='" . $arr . "'>" . $v. "</option>";
                      }

                      $arrsatuan = array('BH' =>'Buah' ,'KG' =>'KG','SAK' =>'SAK' );
                      foreach ($arrsatuan as $arr => $v) {
                        $optsatuan.="<option value='" . $arr . "'>" . $v. "</option>";
                      }


                 
               
                                echo"<table style='font-size:12px; width: 450px;'>";
                                
                                 echo"<tr>
                                       
                                        <th><span style='color: black'>Jenis Pekerjaan</span></th>
                                        <th></th>
                                        <td align='left'><select  id=\"jnspek\" name=\"jnspek\" style='height:25px; width:300px;'>".$optjns."</select></td>
                                        <th ></th>
                                    </tr>";
                                 echo"<tr>
                                      
                                      <th><span style='color: black'>Nama Barang/Jasa</span></th>
                                      <th></th>
                                      <td align='left' hidden><input class='form-control filter' type=text class=myinputtext id=kdbrg name=kdbrg  style='height:25px; width:300px;' /></td>

                                      <td align='left'><input class='form-control filter' type=text class=myinputtext id=brg name=brg  style='height:25px; width:300px;' /></td>

                                     </tr>";
                                 echo"<tr>
                                       
                                      <th><span style='color: black'>Volume</span></th>
                                      <th></th>
                                      <td align='left'><input class='form-control filter' type=text class=myinputtext id=volume name=volume  onchange=\"getjum();\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                                 echo"<tr>
                                       
                                        <th><span style='color: black'>Satuan</span></th>
                                        <th></th>
                                        <td align='left'><select  id=\"satuan\" name=\"satuan\" style='height:25px; width:300px;'>".$optsatuan."</select></td>
                                        <th ></th>
                                    </tr>";

                                  echo"<tr>
                                      <th><span style='color: black'>Harga Satuan</span></th>
                                      <th></th>
                                      <td align='left'><input  class='form-control filter' type=text class=myinputtext id=harsat name=harsat onkeyup=\"z.numberFormat('harsat',2);\" onchange=\"getjum();\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                                echo"<tr>
                                      <th><span style='color: black'>Jumlah</span></th>
                                      <th></th>
                                      <td align='left'><input disabled class='form-control filter' type=text class=myinputtext id=jumlah name=jumlah onkeyup=\"z.numberFormat('jumlah',2);\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                                echo"<tr>
                                      <th><span style='color: black'>Presentase/Item</span></th>
                                      <th></th>
                                      <td align='left'><input disabled class='form-control filter' type=text class=myinputtext id=peritem name=peritem onkeyup=\"z.numberFormat('peritem',2);\" onchange=\"getjum();\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                                 echo"<tr>
                                      <th><span style='color: black'>Presentase Pekerjaan</span></th>
                                      <th></th>
                                      <td align='left'><input disabled class='form-control filter' type=text class=myinputtext id=persen name=persen onkeyup=\"z.numberFormat('persen',2);\" onchange=\"getjum();\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                          

                                echo"</table>";
                        
                     echo" <br><br>";
                      
                      echo"<table>";
                      echo"<tr>
                         <input type=hidden value=insertdet id=method>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpandet() >Simpan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelIsidet()>Batal</button></td>
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

          <div class="cardx" id="listdatadetail" style="display:none;">
              <div class="card-headerx">
                <h3 class="card-titlex">List Data Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive">
                <?php
                      echo"<table border=1 style='background-color: #007bff;'>
                      <br>
         
                      <tr class=rowheader>
                      <td>No</td>
                      <td>Jenis Pekerjaan</td>
                      <td>Nama Barang/Jasa</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Harga Satuan</td>
                      <td>Jumlah</td>
                      <td>Presentase/Item</td>
                      <td>Presentase Pekerjaan</td>
                  
                      <td colspan=2>Aksi</td>
                    

                      </tr>
              
                      <tbody id=containerdetail>";
                      echo"</tbody>
                      <tfoot id='footData'>
                      </tfoot>
                      </table>";

                      ?>             


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          <div class="card" id="listdata" style="display:block;">
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
                      <td>No Transaksi</td>
                      <td>No Kontrak</td>
                      <td>Nilai Kontrak</td>
                      <td>PBJ</td>
                     
                  
                      <td>Edit</td>
                      <td>Delete</td>

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
      $('#reservationdate1').datetimepicker({
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





