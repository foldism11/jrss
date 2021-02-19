
<?php

  require_once('../master_validation.php');
  require_once('../config/connection.php');
  require_once('../lib/nangkoelib.php');
  require_once('../lib/zLib2.php');
  include('../master_mainMenu.php');

  
  ?>
<script language=javascript src=../js/zTools.js></script>
<script language=javascript1.2 src='../js/jr_trx_beli.js'></script>
<script language=javascript1.2 src='../js/generic.js'></script>
<script language=javascript1.2 src='../js/calendar.js'></script>
<link rel="stylesheet" href="../style/generic.css" />

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Advanced form elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <script type="text/javascript" src="../assets/js/jquery-1.10.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/highcharts.js"></script>
  <script type="text/javascript" src="../assets/js/exporting.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="../index1.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="../logout.php" class="nav-link">Logout</a>
      </li>
     
    </ul>



    <!-- Right navbar links -->
<!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
       
        <img src="../images/jrss2.jpeg" alt="AdminLTE Logo" style='width:250px;'>

        </a>
        
      </li>
      
      
    </ul>
    
  </nav>
  <!-- /.navbar -->

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <?php

  include('../headerupload.php');
  
  ?>

  <!-- Content Wrapper. Contains page content -->
<!--   <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
 <!-- /.card-body -->


          <div id="list" class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                 <?
                for ($i=0; $i < 260 ; $i++) { 
                   echo "&nbsp;";
                }
                ?>
                <a href="../jr_trx_beli.php" class="btn btn-danger pull-right">
                  <span class="glyphicon glyphicon-remove"></span> Cancel
                </a>

              <h3>Form Import Data</h3>
              <hr>

              <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
              <form method="post" action="" enctype="multipart/form-data">
                <a href="Format.csv" class="btn btn-default">
                  <span class="glyphicon glyphicon-download"></span>
                  Download Format
                </a>
                <a onclick=mstcabang(event) class="btn btn-default">
                  <span class="glyphicon glyphicon-download" ></span>
                  Download Master Cabang
                </a>
                <a onclick=mstsupplier(event) class="btn btn-default">
                  <span class="glyphicon glyphicon-download" ></span>
                  Download Master Supplier
                </a>
                <a onclick=mstbarang(event) class="btn btn-default">
                  <span class="glyphicon glyphicon-download" ></span>
                  Download Master Barang
                </a><br><br>

                <script>
                 function mstcabang(ev){
          
                  param='method=excel';
                  tujuan='../cabang_excel.php';
                  judul='Report Ms.Excel';        
                  printFile(param,tujuan,judul,ev)   

                  function printFile(param,tujuan,title,ev){
                   tujuan=tujuan+"?"+param;  
                   width='700';
                   height='400';
                   content="<iframe frameborder=0 width=100% height=100% src='"+tujuan+"'></iframe>"
                   showDialog2(title,content,width,height,ev);  
                 }
 
                }

                </script>


                <script>
                 function mstsupplier(ev){
          
                  param='method=excelsupplier';
                  tujuan='../cabang_excel.php';
                  judul='Report Ms.Excel';        
                  printFile(param,tujuan,judul,ev)   

                  function printFile(param,tujuan,title,ev){
                   tujuan=tujuan+"?"+param;  
                   width='700';
                   height='400';
                   content="<iframe frameborder=0 width=100% height=100% src='"+tujuan+"'></iframe>"
                   showDialog2(title,content,width,height,ev);  
                 }
 
                }

                </script>


                <script>
                 function mstbarang(ev){
          
                  param='method=excelbarang';
                  tujuan='../cabang_excel.php';
                  judul='Report Ms.Excel';        
                  printFile(param,tujuan,judul,ev)   

                  function printFile(param,tujuan,title,ev){
                   tujuan=tujuan+"?"+param;  
                   width='700';
                   height='400';
                   content="<iframe frameborder=0 width=100% height=100% src='"+tujuan+"'></iframe>"
                   showDialog2(title,content,width,height,ev);  
                 }
 
                }

                </script>
                <!--
                -- Buat sebuah input type file
                -- class pull-left berfungsi agar file input berada di sebelah kiri
                -->
                <input type="file" name="file" class="pull-left">

                <button type="submit" name="preview" class="btn btn-success btn-sm">
                  <span class="glyphicon glyphicon-eye-open"></span> Preview
                </button>
               
              </form>

              <hr>

              <!-- Buat Preview Data -->
              <?php
              // Jika user telah mengklik tombol Preview
              if(isset($_POST['preview'])){
                $nama_file_baru = 'data.csv';

                // Cek apakah terdapat file data.xlsx pada folder tmp
                if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
                  unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

                $nama_file = $_FILES['file']['name']; // Ambil nama file yang akan diupload
                $tmp_file = $_FILES['file']['tmp_name'];
                $ext = pathinfo($nama_file, PATHINFO_EXTENSION); // Ambil ekstensi file yang akan diupload

                // Cek apakah file yang diupload adalah file CSV
                if($ext == "csv"){
                  // Upload file yang dipilih ke folder tmp
                  move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

                  // Load librari PHPExcel nya
                  require_once 'PHPExcel/PHPExcel.php';

                  $inputFileType = 'CSV';
                  $inputFileName = 'tmp/data.csv';

                  $reader = PHPExcel_IOFactory::createReader($inputFileType);
                  $excel = $reader->load($inputFileName);

                  // Buat sebuah tag form untuk proses import data ke database
                  echo "<form method='post' action='import.php'>";

                  // Buat sebuah div untuk alert validasi kosong
                  

                  echo "<table class='table table-bordered table-responsive'>
                  <tr>
                    <th colspan='19' class='text-center'>Preview Data</th>
                  </tr>
                  <tr>
                    <th>Faktur</th>
                    <th>Cabang</th>
                    <th>Supplier</th>
                    <th>Tanggal Beli</th>
                    <th>Tanggal Tiba</th>
                    <th>Barang</th>
                    <th>Qty Pcs</th>
                    <th>Qty Pack</th>
                    <th>harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Harga Rupiah</th>
                  </tr>";

                  $numrow = 1;
                  $kosong = 0;
                  $worksheet = $excel->getActiveSheet();
                  foreach ($worksheet->getRowIterator() as $row) { // Lakukan perulangan dari data yang ada di csv
                    // Cek $numrow apakah lebih dari 1
                    // Artinya karena baris pertama adalah nama-nama kolom
                    // Jadi dilewat saja, tidak usah diimport
                    if($numrow > 1){
                      // START -->
                      // Skrip untuk mengambil value nya
                      $cellIterator = $row->getCellIterator();
                      $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

                      $get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
                      foreach ($cellIterator as $cell) {
                        array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
                      }
                      // <-- END

                      // Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
                      $faktur = $get[0]; // Ambil data NIS
                      $cabang = $get[1]; // Ambil data nama
                      $supplier = $get[2]; // Ambil data jenis kelamin
                      $tanggal_beli = $get[3]; // Ambil data telepon
                      $tanggal_tiba = $get[4]; // Ambil data telepon
                      $kode_barang = $get[5]; // Ambil data alamat
                      $qty_pcs = $get[6]; // Ambil data alamat
                      $qty_pack = $get[7]; // Ambil data alamat
                      $harga_jual = $get[8]; // Ambil data alamat
                      $harga_beli = $get[9]; // Ambil data alamat
                      $harga_rupiah = $get[10]; // Ambil data alamat
    
                      $time=date('y-m-d h:m:s');

                      // Cek jika semua data tidak diisi
                     if($faktur == "" && $cabang == "" && $supplier == "" && $tanggal_beli == "" && $tanggal_tiba == ""  && $kode_barang == ""  && $qty_pcs == ""/* && $qty_pack == ""*/ && $harga_jual == ""  && $harga_beli == "" && $harga_rupiah == "")
                      continue;  // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                      // Validasi apakah semua data telah diisi
                      $faktur_td = ($faktur == "")? " style='background: #E07171;'" : ""; // Jika NIS kosong, beri warna merah
                      $cabang_td = ($cabang == "" )? " style='background: #E07171;'" : ""; // Jika Nama kosong, beri warna merah
                      /*echo substr($tanggal_pelatihan,4,1);*/
                      $supplier_td = ($supplier == "")? " style='background: #E07171;'" : ""; // Jika Jenis Kelamin kosong, beri warna merah
                      $tanggal_beli_td = ($tanggal_beli == "")? " style='background: #E07171;'" : ""; // Jika Telepon kosong, beri warna merah
                      $tanggal_tiba_td = ($tanggal_tiba == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                      $kode_barang_td = ($kode_barang == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                      $qty_pcs_td = ($qty_pcs == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                   
                      $harga_jual_td = ($harga_jual == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                      $harga_beli_td = ($harga_beli == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                      $harga_rupiah_td = ($harga_rupiah == "")? " style='background: #E07171;'" : ""; // Jika Alamat kosong, beri warna merah
                     

                      // Jika salah satu data ada yang kosong
                      if($faktur == "" or $cabang == "" or $supplier == ""  or $tanggal_beli == "" or  $tanggal_tiba == "" or $kode_barang == ""  or  $qty_pcs == "" or $harga_jual == "" or $harga_beli == "" or $harga_rupiah == ""){
                        $kosong++; // Tambah 1 variabel $kosong
                      }
                      echo "<tr>";
                      echo "<td".$faktur_td.">".$faktur."</td>";
                      echo "<td".$cabang_td.">".$cabang."</td>";
                      echo "<td".$supplier_td.">".$supplier."</td>";
                      echo "<td".$tanggal_beli_td.">".$tanggal_beli."</td>";
                      echo "<td".$tanggal_tiba_td.">".$tanggal_tiba."</td>";
                      echo "<td".$kode_barang_td.">".$kode_barang."</td>";
                      echo "<td".$qty_pcs_td.">".$qty_pcs."</td>";
                      echo "<td>".$qty_pack."</td>";
                      echo "<td".$harga_jual_td.">".$harga_jual."</td>";
                      echo "<td".$harga_beli_td.">".$harga_beli."</td>";
                      echo "<td".$harga_rupiah_td.">".$harga_rupiah."</td>";
                      echo "</tr>";
                    }

                    $numrow++; // Tambah 1 setiap kali looping
                  }

                  echo "</table>";


                  // Cek apakah variabel kosong lebih dari 1
                  // Jika lebih dari 1, berarti ada data yang masih kosong

                  if($kosong >= 1){
   
                 echo "<div class='alert alert-danger' id='kosong'>
                  Anda Tidak Dapat Mengupload Data, Ada ".$kosong." data yang belum lengkap diisi Atau Dengan Format yg Salah.
                  </div>";

                  ?>
                    <script>
                    $(document).ready(function(){
                      // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                      $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                      $("#kosong").show(); // Munculkan alert validasi kosong
                    });
                    </script>
                  <?php
                  }else{ // Jika semua data sudah diisi
                    echo "<hr>";

                    // Buat sebuah tombol untuk mengimport data ke database
                    echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
                  }

                  echo "</form>";
                }else{ // Jika file yang diupload bukan File CSV
                  // Munculkan pesan validasi
                  echo "<div class='alert alert-danger'>
                  Hanya File CSV (.csv) yang diperbolehkan
                  </div>";
                }
              }
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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page script -->

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Page script -->
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
      format: 'YYYY-MM-DD hh:mm:ss'
    });
    $('#reservationdate1').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#reservationdate2').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    $('#reservation1').daterangepicker()
    $('#reservation2').daterangepicker()
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
