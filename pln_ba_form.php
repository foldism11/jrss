
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/pln_ba_form.js'></script>
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
            <h1>Input BA</h1>
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
                      $optba=$optsifatba=$optkontrak="<option value=''>Pilih Data</option>";
                                    
                       #data Kontrak
                      $strkontrak = "select no_kontrak,noba,noamandemen1 from " . $dbname . ".input_kontrak_pln order by no_kontrak";
                      $reskontrak=$owlPDO->query($strkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $reskontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barkontrak = $reskontrak->fetch()) {
                        $amd=substr($barkontrak->noamandemen1,2,1);
                        if ($amd=='') {
                            $amd='Baru';
                        }
                        else
                        {
                           $amd='AMD '.$amd;
                        }
                        @$optkontrak.="<option value='" . $barkontrak->no_kontrak . "'>" . $barkontrak->no_kontrak. " (".$amd.")</option>";
                      }

                       #get data jenis ba
                      $strba = "select kode_ba,nama_ba,nourut from " . $dbname . ".mst_jnsba_pln where status='1' order by nourut";
                      $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
                      $resba->setFetchMode(PDO::FETCH_OBJ);
                      while ($barba = $resba->fetch()) {
                         @$optba.="<option value='" . $barba->kode_ba . "'>" . $barba->nourut. ". " . $barba->nama_ba. "</option>";
                      }

                     
                     

                      $sft= array('0' =>'Amandemen', '1' =>'Baru');
                      foreach ($sft as $key => $value) {
                         $optsifatba.="<option value='" . $key . "'>" . $value. "</option>";
                      }

                      $hidden='';
                      $hidden='hidden';
                      echo"<table>";
                        echo"<tr>";
                          echo"<td valign=top>";
                                echo"<table style='font-size:12px; width: 370px;'>";
                                  echo"<tr>
                                  <th><u><span style='color: black'>HEADER BA</span></u></th>
                                  </tr>";
                                  echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                                  echo"<tr>
                                  <th><span style='color: black'>No Kontrak</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"nokontrak\" name=\"nokontrak\" style='height:25px; width:300px;'>".@$optkontrak."</select></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                        <th ><span style='color: black'>Tanggal BA</span></th>
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
                                  <th><span style='color: black'>Jenis BA</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"jenisba\" name=\"jenisba\" style='height:25px; width:300px;' onchange=\"getnoba()\">".@$optba."</select></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr >
                                  
                                  <th><span style='color: black'>Sifat Berita Acara</span></th>
                                  <th></th>
                                  <td><select  id=\"sifatba\" name=\"sifatba\" style='height:25px; width:300px;' onchange=\"getnoba()\"  >".$optsifatba."</select></td>
                                  </tr>";

                                

                                  echo"<tr>
                                  <th><span style='color: black'>No BA</span></th>
                                  <th></th>
                                  <th align='left'><input class='form-control filter' type=text class=myinputtext id=noba name=noba onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' / disabled></th>
                                  <td></td>
                                  </tr>";
                                echo"</table>";
                          echo"</td>";
                          echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          </td>";

                          echo"<td valign=top>";

                                // 1. BASTAP
                                echo"<table style='font-size:12px; width: 370px;' id='bastap' ".$hidden.">";
                                  echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BASTAP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                                                                                         
                                echo"</table>";

                                 // 2. BAPP
                                echo"<table style='font-size:12px; width: 370px;' id='bapp' ".$hidden.">";
                                  echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAPP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                                                                                         
                                echo"</table>";

                                // 3. BAKP
                                echo"<table style='font-size:12px; width: 370px;' id='bakp' ".$hidden.">";
                                 echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAKP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                                 echo"<tr>
                                        <th ><span style='color: black'>Tanggal LKP</span></th>
                                        <td></td><td>";
                                        ?>
                                          <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" id="tanggallkp" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                        <?php
                                echo"</td>
                                     </tr>";

                                echo"<tr>
                                  <th><span style='color: black'>Persentase (%) Pekerjaan</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=persenbakp name=persenbakp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                echo"<tr>
                                  <th><span style='color: black'>Point pada Kontrak</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=refkontrakbakp name=refkontrakbakp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";                             
                                echo"</table>";

                                //4. BASP
                                $optdenda=$optwktbasp="<option value=''>Pilih Data</option>";
                                $arrwktu=array('0' => 'Sesuai','1' => 'Tidak Sesuai' );
                                foreach ($arrwktu as $k => $v) {
                                     @$optwktbasp.="<option value='" . $k . "'>" . $v. "</option>";
                                }


                                $arrdenda=array('0' => 'Dikenakan','1' => 'Tidak Dikenakan' );
                                foreach ($arrdenda as $k => $v) {
                                     @$optdenda.="<option value='" . $k . "'>" . $v. "</option>";
                                }

                                @$opttermin.="<option value=''>Pilih Data</option>";
                                $arrtermin=array('1' => 'Pertama','2' => 'Kedua','3' => 'Ketiga','4' => 'Keempat','5' => 'Kelima' );
                                foreach ($arrtermin as $k => $v) {
                                     @$opttermin.="<option value='" . $k . "'>" . $v. "</option>";
                                }
                                echo"<table style='font-size:12px; width: 370px;' id='basp' ".$hidden.">";
                                 echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BASP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                              
                                echo"<tr>
                                  <th><span style='color: black'>Pasal Surat Perjanjian</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=pasalbasp name=pasalbasp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>"; 

                                echo"<tr>
                                  <th><span style='color: black'>Tahap Ke</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"tahapbasp\" name=\"tahapbasp\" style='height:25px; width:300px;'>".@$opttermin."</select></td>
                                  <td></td>
                                  </tr>";
                               echo"<tr>
                                  <th><span style='color: black'>Sampai Tahap Ke</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"sampaibasp\" name=\"sampaibasp\" style='height:25px; width:300px;'>".@$opttermin."</select></td>
                                  <td></td>
                                  </tr>";
                                echo"<tr>
                                  <th><span style='color: black'>Nominal Terbayar</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nominalbasp name=nominalbasp onkeypress=\"return tanpa_kutip(event);\" onkeyup=\"z.numberFormat('nominalbasp',2);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                   //list (sesuai/tidak sesuai)
                                echo"<tr>
                                  <th><span style='color: black'>Waktu Pekerjaan</span></th>
                                  <th></th>
                                   <td align='left'><select id=\"waktubasp\" name=\"waktubasp\" style='height:25px; width:300px;'>".@$optwktbasp."</select></td>
                                  <td></td>
                                  </tr>"; 
                               //list (dikenakan/tidak dikenakan)
                               echo"<tr>
                                  <th><span style='color: black'>Denda</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"dendabasp\" name=\"dendabasp\" style='height:25px; width:300px;'>".@$optdenda."</select></td>
                                  <td></td>
                                  </tr>";

                               echo"<tr>
                                  <th><span style='color: black'>Keterlambatan</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=waktuterlambatbasp name=waktuterlambatbasp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                               echo"<tr>
                                  <th><span style='color: black'>Persentase Denda</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=persenbasp name=persenbasp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>"; 

                              
                                echo"</table>";

                                //5a. BAST
                                echo"<table style='font-size:12px; width: 370px;' id='bast' ".$hidden.">";
                                echo"<tr>
                                <th colspan=3><u><span style='color: black'>Detail BAST</span></u></th>
                                </tr>";
                                echo"<tr>
                                <th>&nbsp;</th>
                                </tr>";

                                echo"<tr>
                                <th><span style='color: black'>Keterangan PBJ</span></th>
                                <th></th>
                                <td><textarea name=prk id=ketpbjbast  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>

                               
                                <td></td>
                                </tr>";

                                echo"<tr>
                                <th><span style='color: black'>No BASP</span></th>
                                <th></th>
                                <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobaspbast name=nobaspbast onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                <td></td>
                                </tr>";

                                echo"<tr>
                                        <th ><span style='color: black'>Tanggal BASP</span></th>
                                        <td></td><td>";
                                        ?>
                                          <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                            <input type="text" id="tanggalbaspbast" class="form-control datetimepicker-input" data-target="#reservationdate3"/>
                                            <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                        <?php
                                echo"</td>
                                     </tr>";

                            //5b. BASTB
                                echo"<table style='font-size:12px; width: 370px;' id='bastb' ".$hidden.">";
                                echo"<tr>
                                <th colspan=3><u><span style='color: black'>Detail BASTB</span></u></th>
                                </tr>";
                                echo"<tr>
                                <th>&nbsp;</th>
                                </tr>";

                                echo"<tr>
                                <th><span style='color: black'>Keterangan PBJ</span></th>
                                <th></th>
                                <td><textarea name=prk id=ketpbjbastb  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>

                               
                                <td></td>
                                </tr>";

                                echo"<tr>
                                <th><span style='color: black'>No BASP</span></th>
                                <th></th>
                                <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobaspbastb name=nobaspbast onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                <td></td>
                                </tr>";

                                echo"<tr>
                                        <th ><span style='color: black'>Tanggal BASP-B</span></th>
                                        <td></td><td>";
                                        ?>
                                          <div class="input-group date" id="reservationdate11" data-target-input="nearest">
                                            <input type="text" id="tanggalbaspbastb" class="form-control datetimepicker-input" data-target="#reservationdate11"/>
                                            <div class="input-group-append" data-target="#reservationdate11" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                        <?php
                                echo"</td>
                                     </tr>";

                            
                                echo"</table>";

                              //6. BAK
                                echo"<table style='font-size:12px; width: 370px;' id='bak' ".$hidden.">";
                                 echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAK</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>No BAPP</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobappbak name=nobappbak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                        <th ><span style='color: black'>Tanggal BAPP</span></th>
                                        <td></td><td>";
                                        ?>
                                          <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                            <input type="text" id="tanggalbappbak" class="form-control datetimepicker-input" data-target="#reservationdate4"/>
                                            <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                        <?php
                                echo"</td>
                                     </tr>";

                                echo"<tr>
                                  <th><span style='color: black'>Keterlambatan</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=terlambatbak name=terlambatbak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";


                                echo"<tr>
                                  <th><span style='color: black'>Persentasi (%)Denda</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=persenbak name=persenbak onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                echo"</table>";


                              //7. BAP
                                
                                echo"<table style='font-size:12px; width: 550px;' id='bap' ".$hidden.">";
                                 echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";


                                  echo"<tr>
                                  <th><span style='color: black'>No BAKP</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobakpbap name=nobakpbap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>No BAPP</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobappbap name=nobappbap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>No BAK</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobakbap name=nobakbap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Persentase (%) Pekerjaan</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=persenbap name=persenbap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Termin</span></th>
                                  <th></th>
                                   <td align='left'><select id=\"terminbap\" name=\"terminbap\" style='height:25px; width:300px;'>".@$opttermin."</select></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Persentase (%) Termin</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=persen2bap name=persen2bap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Nominal Termin</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nominalbap name=nominalbap onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                echo"</table>";
                            
                            //8. basmp
                                echo"<table style='font-size:12px; width: 450px;' id='basmp' ".$hidden.">";
                                 echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BASMP</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Lama Masa Pemeliharaan</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=lamamasabasmp name=lamamasabasmp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Pasal</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=pasalbasmp name=pasalbasmp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                 echo"<tr>
                                  <th><span style='color: black'>Tahap Ke</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=tahapbasmp name=tahapbasmp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                echo"<tr>
                                  <th><span style='color: black'>Nominal Terbayar</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=terbayarbasmp name=terbayarbasmp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                echo"</table>";


                          // 9. bast_2
                              echo"<table style='font-size:12px; width: 450px;' id='bast_2' ".$hidden.">";
                               echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAST_2</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>Keterangan PBJ</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=ketpbjbast2 name=ketpbjbast2 onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th><span style='color: black'>No BASP</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=nobaspbast2 name=nobaspbast2 onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th ><span style='color: black'>Tanggal BASP</span></th>
                                  <td></td><td>";
                                  ?>
                                  <div class="input-group date" id="reservationdate5" data-target-input="nearest">
                                    <input type="text" id="tanggalbaspbast5" class="form-control datetimepicker-input" data-target="#reservationdate3"/>
                                    <div class="input-group-append" data-target="#reservationdate5" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                  <?php
                                  echo"</td>
                                  </tr>";

                                echo"</table>";

                              //baepw
                                echo"<table style='font-size:12px; width: 450px;' id='baepw' ".$hidden.">";
                                  echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAEPW</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Sebab Amandemen</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=sebabbaepw name=sebabbaepw onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                                  echo"<tr>
                                  <th ><span style='color: black'>Tanggal Evaluasi</span></th>
                                  <td></td><td>";
                                  ?>


                                  <div class="input-group date" id="reservationdate6" data-target-input="nearest">
                                    <input type="text" id="tglevaluasibaepw" class="form-control datetimepicker-input" data-target="#reservationdate6"/>
                                    <div class="input-group-append" data-target="#reservationdate6" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>


                                  <?php
                                  echo"</td>
                                  </tr>";

                            echo"<tr>
                                  <th><span style='color: black'>Waktu Perpanjang</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=wktperpanjangbaepw name=wktperpanjangbaepw onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                            echo"<tr>
                                  <th><span style='color: black'>Mulai Perpanjang</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=mulaibaepw name=mulaibaepw onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                            echo"<tr>
                                        <th ><span style='color: black'>Batas Pekerjaan</span></th>
                                        <td></td><td>";
                                        ?>

                           
                                          <div class="input-group date" id="reservationdate7" data-target-input="nearest">
                                            <input type="text" id="batasbaepw" class="form-control datetimepicker-input" data-target="#reservationdate7"/>
                                            <div class="input-group-append" data-target="#reservationdate7" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                     

                                        <?php
                                echo"</td>
                                     </tr>";
                            echo"<tr>
                                        <th ><span style='color: black'>Tanggal Jaminan Pelaksanaan</span></th>
                                        <td></td><td>";
                                        ?>

                                     
                                          <div class="input-group date" id="reservationdate8" data-target-input="nearest">
                                            <input type="text" id="tanggaljaminanbaepw" class="form-control datetimepicker-input" data-target="#reservationdate8"/>
                                            <div class="input-group-append" data-target="#reservationdate8" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                               

                                        <?php
                                echo"</td>
                                     </tr>";
                               echo"<tr>
                                  <th><span style='color: black'>Jenis Denda</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"dendabaepw\" name=\"tahapdendabaepwbasp\" style='height:25px; width:300px;'>".@$optdenda."</select></td>
                                  <td></td>
                                  </tr>";
                               echo"<tr>
                                  <th><span style='color: black'>Urutan Amandemen</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"urutbaepw\" name=\"urutbaepw\" style='height:25px; width:300px;'>".@$opttermin."</select></td>
                                  <td></td>
                                  </tr>";
                                 echo"</table>";

                               //baetk
                                echo"<table style='font-size:12px; width: 450px;' id='baetk' ".$hidden.">";
                                  echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAETK</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                               echo"<tr>
                                  <th><span style='color: black'>Surat</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=suratbaetk name=suratbaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                               echo"<tr>
                                  <th><span style='color: black'>Resume Rapat</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=resumebaetk name=resumebaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>FCR</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=fcrbaetk name=fcrbaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                             echo"<tr>
                                  <th><span style='color: black'>Perhitungan Tambah/Kurang</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=perhitunganbaetk name=perhitunganbaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Evaluasi Tambah/Kurang</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=evaluasibaetk name=evaluasibaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Semula PPN 10%</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=ppnbaetk name=ppnbaetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Menjadi PPN 10%</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=ppn2baetk name=ppn2baetk onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Urutan Amandemen</span></th>
                                  <th></th>
                                  <td align='left'><select id=\"urutbaetk\" name=\"urutbaetk\" style='height:25px; width:300px;'>".@$opttermin."</select></td>
                                  <td></td>
                                  </tr>";
                              echo"</table>";
                          //bapjd
                              echo"<table style='font-size:12px; width: 450px;' id='bapjd' ".$hidden.">";
                                  echo"<tr>
                                  <th colspan=3><u><span style='color: black'>Detail BAPJD</span></u></th>
                                  </tr>";
                                   echo"<tr>
                                  <th>&nbsp;</th>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Surat</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=suratbapjd name=suratbapjd onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Resume Rapat</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=resumebapjd name=resumebapjd onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                              echo"<tr>
                                  <th><span style='color: black'>Perubahan Judul</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=judulbapjd name=judulbapjd onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";

                             
                                echo"</table>";

                           /*//bapdb
                              echo"<table style='font-size:12px; width: 450px;' id='bapdb' ".$hidden.">";
                                  echo"<tr>
                                  <th><span style='color: black'>Dokumen yg Diterima</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=dokumentreimabapdb name=dokumentreimabapdb onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                 
                                echo"</table>";

                          //bapd
                              echo"<table style='font-size:12px; width: 450px;' id='bapd' ".$hidden.">";
                                  echo"<tr>
                                  <th><span style='color: black'>sama dengan BAPP pekerjaan di ganti barang</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=dokumentreimabapdb name=dokumentreimabapdb onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                 
                                echo"</table>";
                          //bastdb
                              echo"<table style='font-size:12px; width: 450px;' id='bastdb' ".$hidden.">";
                                  echo"<tr>
                                  <th><span style='color: black'>Dokumen yg Diterima</span></th>
                                  <th></th>
                                  <td align='left'><input class='form-control filter' type=text class=myinputtext id=dokumentreimabastdb name=dokumentreimabastdb onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></td>
                                  <td></td>
                                  </tr>";
                                 
                                echo"</table>";*/


                          echo"</td>";
                        echo"<tr>"; 
                     echo" </table><br><br>";
                      
                      echo"<table align=center>";
                      echo"<tr>
                         <input type=hidden value=insert id=methodba>
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
              <div class="card-body">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                      <thead>
                      <tr class=rowheader>
                      <td>No</td>
                      <td>No Kontrak</td>
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

            
         
          
        </div>
        <!-- /.card -->


        <div class="card" id="listdatadetail" style="display:none;">
              <div class="card-header">
                <h3 class="card-title">List Data Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                      <thead>
                      <tr class=rowheader>
                      <td>No</td>
                      <td>No Kontrak</td>
                      <td>No BA</td>
                      <td>Jenis BA</td>   
                      <td>Edit</td>
                      <td>Delete</td>

                      </tr>
                      </thead>
                      <tbody id=containerx>";
                    /*  echo"<script>loadDatadetail(0)</script>";*/
                      echo"</tbody>
                      <tfoot id='footData'>
                      </tfoot>
                      </table>";

                      ?>                     


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

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
    $('#reservationdate2').datetimepicker({
        format: 'L'
    });
    $('#reservationdate3').datetimepicker({
        format: 'L'
    });
     $('#reservationdate4').datetimepicker({
        format: 'L'
    });
      $('#reservationdate5').datetimepicker({
        format: 'L'
    });
      $('#reservationdate6').datetimepicker({
        format: 'L'
    });
      $('#reservationdate7').datetimepicker({
        format: 'L'
    });
      $('#reservationdate8').datetimepicker({
        format: 'L'
    });
      $('#reservationdate9').datetimepicker({
        format: 'L'
    });
      $('#reservationdate10').datetimepicker({
        format: 'L'
    });
       $('#reservationdate11').datetimepicker({
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





