

<?php

require_once('../master_validation.php');
require_once('../config/connection.php');
require_once('../lib/nangkoelib.php');
/*require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');*/

/*
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode
-- Twitter  : http://twitter.com/mynotescode
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php


if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  // Load librari PHPExcel nya
  require_once 'PHPExcel/PHPExcel.php';

  $inputFileType = 'CSV';
  $inputFileName = 'tmp/data.csv';

  $reader = PHPExcel_IOFactory::createReader($inputFileType);
  $excel = $reader->load($inputFileName);

  $numrow = 1;
  $worksheet = $excel->getActiveSheet();
  foreach ($worksheet->getRowIterator() as $row) {
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
       if($faktur == "" && $cabang == "" && $supplier == "" && $tanggal_beli == "" && $tanggal_tiba == ""  && $kode_barang == ""  && $qty_pcs == "" && $qty_pack == "" && $harga_jual == ""  && $harga_beli == "" && $harga_rupiah == "")
                      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

      // Proses simpan ke Database
      // Buat query Insert
     /* $sql = $pdo->prepare("INSERT INTO siswa VALUES(:nis,:nama,:jk,:telp,:alamat)");
      $sql->bindParam(':nis', $nis);
      $sql->bindParam(':nama', $nama);
      $sql->bindParam(':jk', $jenis_kelamin);
      $sql->bindParam(':telp', $telp);
      $sql->bindParam(':alamat', $alamat);
      $sql->execute(); // Eksekusi query insert*/

       
      
      $str="INSERT INTO trx_beli (faktur,cabang,supplier,tanggal_beli,tanggal_tiba,kode_barang,rec_conv1,rec_conv2,cost_buy,cost_sell,tot_qty,createtime,updatetime,flag,tipetransaksi,hargarupiah) VALUES ('$faktur','$cabang','$supplier','$tanggal_beli','$tanggal_tiba','$kode_barang','$qty_pcs','$qty_pack','$harga_beli','$harga_jual','','$time','$time','0','0','$harga_rupiah')";

 
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

    }

    $numrow++; // Tambah 1 setiap kali looping
  }
}

header('location: ../jr_trx_beli.php'); // Redirect ke halaman awal
?>