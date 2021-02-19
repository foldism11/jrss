
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/tampil.js'></script>
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
            <h1>Input Kontrak</h1>
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

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          

          <!-- /.card-header -->
          <div class="card-body" id="header" style="display:none;">
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
                      $optnokontrak=$optsifatba=$optadm=$optpengk3=$optmgepbj=$optpenye=$optupt=$optdirpekerjaan=$optdirlap=$optpenglap=$optjenkontrak=$optsp=$opdirven="<option value=''>Pilih Data</option>";
                      $strpenye = "select kode_vendor,nama_vendor from " . $dbname . ".mst_vendor_pbj where status='1'";
                      $respenye=$owlPDO->query($strpenye) or die(print " Gagal: ".PDOException::getMessage());
                      $respenye->setFetchMode(PDO::FETCH_OBJ);
                      while ($barpenye = $respenye->fetch()) {
                        $optpenye.="<option value='" . $barpenye->kode_vendor . "'>" . $barpenye->nama_vendor. "</option>";
                      }

                      #data UPT
                      $strupt = "select kode_upt,nama_upt from " . $dbname . ".mst_upt_pln where status='1'";
                      $resupt=$owlPDO->query($strupt) or die(print " Gagal: ".PDOException::getMessage());
                      $resupt->setFetchMode(PDO::FETCH_OBJ);
                      while ($barupt = $resupt->fetch()) {
                        $optupt.="<option value='" . $barupt->kode_upt . "'>" . $barupt->nama_upt. "</option>";
                      }

                      #data Dir Pekerjaan
                      $strdirpekerjaan = "select nik_dp,nama_dp from " . $dbname . ".mst_direksi_pekerjaan_pln where status='1'";
                      $resdirpekerjaan=$owlPDO->query($strdirpekerjaan) or die(print " Gagal: ".PDOException::getMessage());
                      $resdirpekerjaan->setFetchMode(PDO::FETCH_OBJ);
                      while ($bardirpekerjaan = $resdirpekerjaan->fetch()) {
                        $optdirpekerjaan.="<option value='" . $bardirpekerjaan->nik_dp . "'>" . $bardirpekerjaan->nama_dp. "</option>";
                      }

                      #data Dir Lapangan
                      $strdirlap = "select nik_dl,nama_dl from " . $dbname . ".mst_direksi_lapangan_pln where status='1'";
                      $resdirlap=$owlPDO->query($strdirlap) or die(print " Gagal: ".PDOException::getMessage());
                      $resdirlap->setFetchMode(PDO::FETCH_OBJ);
                      while ($bardirlap = $resdirlap->fetch()) {
                        $optdirlap.="<option value='" . $bardirlap->nik_dl . "'>" . $bardirlap->nama_dl. "</option>";
                      }

                      #data Jenis KOntrak
                      $strjenkontrak = "select kode_kontrak,nama_kontrak from " . $dbname . ".mst_jenis_kontrak_pln where status='1'";
                      $resjenkontrak=$owlPDO->query($strjenkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $resjenkontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barjenkontrak = $resjenkontrak->fetch()) {
                        $optjenkontrak.="<option value='" . $barjenkontrak->kode_kontrak . "'>" . $barjenkontrak->nama_kontrak. "</option>";
                      }


                      #data Sifat Pekerjaan
                      $strsp = "select kode_sp,nama_sp from " . $dbname . ".mst_sifat_pekerjaan_pln where status='1'";
                      $ressp=$owlPDO->query($strsp) or die(print " Gagal: ".PDOException::getMessage());
                      $ressp->setFetchMode(PDO::FETCH_OBJ);
                      while ($barsp = $ressp->fetch()) {
                        $optsp.="<option value='" . $barsp->kode_sp . "'>" . $barsp->nama_sp. "</option>";
                      }

                      #data Pengawas Lapangan
                      $strpenglap = "select nik_pl,nama_pl from " . $dbname . ".mst_pengawas_lapangan_pln where status='1'";
                      $respenglap=$owlPDO->query($strpenglap) or die(print " Gagal: ".PDOException::getMessage());
                      $respenglap->setFetchMode(PDO::FETCH_OBJ);
                      while ($barpenglap = $respenglap->fetch()) {
                        $optpenglap.="<option value='" . $barpenglap->nik_pl . "'>" . $barpenglap->nama_pl. "</option>";
                      }

                      #data Direktur Vendor
                      $str = "select kode_dirven,nama_dirven from " . $dbname . ".mst_dirven_pbj where status='1'";

                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $opdirven.="<option value='" . $bar->kode_dirven . "'>" . $bar->nama_dirven. "</option>";
                      }

                        #data Manager Project Vendor
                      $str = "select kode_mgr,nama_mgr from " . $dbname . ".mst_mgr_project_pbj where status='1'";

                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $optmgepbj.="<option value='" . $bar->kode_mgr . "'>" . $bar->nama_mgr. "</option>";
                      }

                       #data Pengawas K3
                      $str = "select kode_pengawas_k3,nama_pengawas_k3 from " . $dbname . ".mst_pengawas_k3_pbj where status='1'";

                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $optpengk3.="<option value='" . $bar->kode_pengawas_k3 . "'>" . $bar->nama_pengawas_k3. "</option>";
                      }

                      #data Bag.Adminstrator
                      $str = "select kode_administrasi,nama_administrasi from " . $dbname . ".mst_administrasi_pbj where status='1'";

                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $optadm.="<option value='" . $bar->kode_administrasi . "'>" . $bar->nama_administrasi. "</option>";
                      }

                      $sft= array('0' =>'Amandemen', '1' =>'Baru');
                      foreach ($sft as $key => $value) {
                         $optsifatba.="<option value='" . $key . "'>" . $value. "</option>";
                      }

                      #data kontrak
                      $str = "select no_kontrak from " . $dbname . ".input_kontrak_pln order by no_kontrak";

                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $optnokontrak.="<option value='" . $bar->no_kontrak . "'>" . $bar->no_kontrak. "</option>";
                      }





                 
                  echo "<table style='font-size:12px; width: 450px;'>";
                       echo " <tr>";
                        echo"<td>";
                                echo"<table style='font-size:12px; width: 450px;'>";
                                echo"<tr hidden>
                                      <th><span style='color: black'>No BA</span></th>
                                      <th></th>
                                      <th align='left'><input class='form-control filter' type=text class=myinputtext id=noba name=noba onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                      <td></td>
                                     </tr>";

                                echo"<tr>
                                      <th><span style='color: black'>No Kontrak</span></th>
                                      <th></th>
                                      <th align='left'><input maxlength='4' class='form-control filter' type=text class=myinputtext id=nokontrak name=nokontrak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                      <td></td>
                                     </tr>";

                                echo"<tr>
                                        <th ><span style='color: black'>Judul Kontrak</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                        <td></td>
                                      </tr>";


                                 echo"<tr>
                                
                                    <th><span style='color: black'>Sifat Berita Acara</span></th>
                                    <th></th>
                                    <td><select  id=\"sifatba\" name=\"sifatba\" style='height:25px; width:300px;' onchange=\"disnoref()\">".$optsifatba."</select></td>
                                  </tr>";

                                echo"<tr id='ref' hidden>
                                        <th ><span style='color: black'>No Kontrak Referensi</span></th>
                                        <th></th>
                                        <th align='left'><select  id=\"noreferensi\" name=\"sifatba\" style='height:25px; width:300px;' onchange=\"getdatakontrak()\">".$optnokontrak."</select></th>
                                        <td></td>
                                      </tr>";

                                 echo"<tr id='ref2' hidden>
                                        <th ><span style='color: black'>No Kontrak Referensi</span></th>
                                        <th></th>
                                        <th align='left'><select  id=\"noreferensi2\" name=\"sifatba\" style='height:25px; width:300px;'>".$optnokontrak."</select></th>
                                        <td></td>
                                      </tr>";


                                 echo"<tr id='amandemen' hidden>
                                      <th><span style='color: black'>No Amandemen</span></th>
                                      <th></th>
                                      <th align='left'><input maxlength='4' class='form-control filter' type=text class=myinputtext id=noamandemen name=noamandemen onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' placeholder='Otomatis Saat Simpan' disabled></th>
                                      <td></td>
                                     </tr>";

                                echo"<tr id='nilaiaman' hidden>
                                      <th><span style='color: black'>Nilai Amandemen</span></th>
                                      <th></th>
                                      <th align='left'><input  class='form-control filter' type=text class=myinputtext id=nilaiamandemen name=nilaiamandemen onkeyup=\"z.numberFormat('nilaiamandemen',2);\" style='height:25px; width:300px;'></th>
                                      <td></td>
                                     </tr>";

                                echo"<tr id='tglamandemen' hidden>
                                        <th ><span style='color: black'>Tanggal Amandemen</span></th>
                                        <td></td><td>";
                                        ?>

                                       
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                            <input type="text" id="tanggalamandemen" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                       

                                        <?php
                                echo"</td>
                                     </tr>";

                                echo"<tr>
                                        <th><span style='color: black'>UPT</span></th>
                                        <th></th>
                                        <td align='left'><select id=\"upt\" name=\"upt\" style='height:25px; width:300px;' onchange=\"getdataupt()\">".$optupt."</select></td>
                                        <td></td>
                                     </tr>";

                                echo"<tr>
                                        <th><span style='color: black'>Penyedia Barang Jasa (PBJ)</span></th>
                                        <th></th>
                                        <td align='left'><select  id=\"penyedia\" name=\"penyedia\" style='height:25px; width:300px;' onchange=\"getdatapbj()\">".$optpenye."</select></td>
                                        <th ></th>
                                      </tr>";

                                echo"<tr>
                                        <th ><span style='color: black'>Tanggal Kontrak</span></th>
                                        <td></td><td>";
                                        ?>

                                       
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                       

                                        <?php
                                echo"</td>
                                     </tr>";
                                     
                                echo"<tr>
                                        <th><span style='color: black'>Periode Kontrak</span></th>
                                        <th></th>
                                        <td>";
                                             ?>

                                      
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation">
                                        </div>
                                        <!-- /.input group -->
                                       
                                         

                               <?php
                               echo"</td>";
                               echo"</tr> ";  

                                echo"<tr>
                                        <th><span style='color: black'>Masa Pemeliharaan</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=masa name=masa onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                        <td></td>
                                     </tr>";

                                echo"<tr>
                                      <th><span style='color: black'>Nilai Kontrak</span></th>
                                      <th></th>
                                      <td align='left'><input class='form-control filter' type=text class=myinputtext id=nilai name=nilai onkeyup=\"z.numberFormat('nilai',2);\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                          

                                echo"<tr>
                                        <th><span style='color: black'>Direksi Pekerjaan</span></th>
                                        <th></th>
                                        <td align='left'><select id=\"dirpekrjaan\" name=\"dirpekrjaan\" style='height:25px; width:300px;' disabled>".$optdirpekerjaan."</select></td>  
                                      </tr>";
                                      

                                echo"<tr>
                                        <th><span style='color: black'>Direksi Lapangan</span></th>
                                        <th></th>
                                        <td align='left'><select  id=\"dirlap\" name=\"dirlap\" style='height:25px; width:300px;' disabled>".$optdirlap."</select></td>                               
                                     </tr>";

                                echo"<tr>
                                        <th><span style='color: black'>Pengawas Lapangan</span></th>
                                        <th></th>
                                        <td align='left'><select id=\"penglap\" name=\"penglap\" style='height:25px; width:300px;' disabled>".$optpenglap."</select></td>
                                    </tr>";

                                echo"<tr>
                                        <th><span style='color: black'>Man UPT</span></th>
                                        <th></th>
                                        <td align='left'><input class='form-control filter' type=text class=myinputtext id=manupt name=manupt onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                     </tr>";
                                     

                                echo"<tr>
                                        <th></th>
                                        <th></th>
                                        <td></td>
                                     </tr>";

                                echo"</table>";
                          echo"</td>";

                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;</td>";
                          }


                          echo"<td valign=top>";
                                echo"<table style='font-size:12px; width: 450px;'>";
                                echo"<tr>                           
                                      <th><span style='color: black'>Direksi PBJ</span></th>
                                      <th></th>
                                      <td><select  id=\"dirven\" name=\"dirven\" style='height:25px; width:300px;' disabled>".$opdirven."</select></td>
                                    </tr>"; 
                                echo"<tr>
                                      <th><span style='color: black'>Jenis Kontrak</span></th>
                                      <th></th>
                                      <td><select id=\"jeniskontrak\" name=\"jeniskontrak\" style='height:25px; width:300px;'>".$optjenkontrak."</select></td>
                                      </tr>";

                                echo"<tr>
                                      <th><span style='color: black'>Sifat Pekerjaan</span></th>
                                      <th></th>
                                      <td><select id=\"sifatkerja\" name=\"sifatkerja\" style='height:25px; width:300px;'>".$optsp."</select></td>
                                    </tr>";

                                echo"<tr>                          
                                      <th valign=top><span style='color: black'>Program Rencana Kerja (PRK)</span></th>
                                      <th></th>
                                      <td><textarea name=prk id=prk  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>
                                     </tr>";

                                echo"<tr>
                                <th><span style='color: black'>Lokasi Pekerjaan</span></th>
                                <th></th>
                                <td><input class='form-control filter' type=text class=myinputtext id=lokasi name=lokasi onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                </tr>";
                                
                                echo"<tr>
                                
                                    <th><span style='color: black'>Project Manager (PBJ)</span></th>
                                    <th></th>
                                    <td><select  id=\"proman\" name=\"proman\" style='height:25px; width:300px;' disabled>".$optmgepbj."</select></td>
                                </tr>";

                                
                                echo"<tr>
                                
                                    <th><span style='color: black'>Pengawas K3 (PBJ)</span></th>
                                    <th></th>
                                    <td><select  id=\"pengk3\" name=\"pengk3\" style='height:25px; width:300px;' disabled>".$optpengk3."</select></td>
                                  </tr>";

                                 echo"<tr>
                                
                                    <th><span style='color: black'>Bag.Administrator (PBJ)</span></th>
                                    <th></th>
                                    <td><select  id=\"adm\" name=\"adm\" style='height:25px; width:300px;' disabled>".$optadm."</select></td>
                                  </tr>";


                                echo"<th valign=top><span style='color: black'>List Tenaga Kerja</span></th>
                                <th></th>
                                  <td><textarea name=tengker id=tengker  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>
                                
                                </tr>";

                                
                               
                                echo"<tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td></td>
                                </tr>";

                                echo"</table>";
                          echo"</td>";
                        echo"</tr>";
                     echo" </table><br><br>";
                      
                      echo"<table>";
                      echo"<tr>
                         <input type=hidden value=insert id=method>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpan() >Simpan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelIsi()>Batal</button></td>
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
                      <td>No Kontrak</td>
                      <td>Judul Kontrak</td>
                      <td>Tanggal Kontrak</td>
                      <td>Nama Vendor</td>
                      <td>Nilai Kontrak</td>
                      <td>Jenis Kontrak</td>
                      <td>Sifat Pekerjaan</td>
                      <td>Sifat BA</td>
                  
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





