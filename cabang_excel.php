<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');




$method=checkPostGet('method','');
switch ($method) {


        case'excel':

            $tab.="<table border=1>
                
                      <tr class=rowheader >
                      <td>No</td>
                      <td>Kode Cabang</td>
                      <td>Nama Cabang</td>
                      <td>Status</td>
                  
                      </tr>";
            $str = "select * from " . $dbname . ".mst_cabang order by kode_cabang ";
            
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                //$nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['kode_cabang']. "</td>";          
                $tab.="<td align=left>" . $d['nama_cabang']. "</td>";
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          
                $tab.="</tr>"; 

                 }
        
                $tglSkrg=date("Ymd");
                    $nop_="Master_Cabang";
                    if(strlen($tab)>0)
                    {
                        if ($handle = opendir('tempExcel')) {
                            while (false !== ($file = readdir($handle))) {
                                if ($file != "." && $file != ".." && $file != "index.html") {
                                    @unlink('tempExcel/'.$file);
                                }
                            }   
                            closedir($handle);
                        }
                        $handle=fopen("tempExcel/".$nop_.".xls",'w');
                        if(!fwrite($handle,$tab))
                        {
                            echo "<script language=javascript1.2>
                            parent.window.alert('Can't convert to excel format');
                            </script>";
                            exit;
                        }
                        else
                        {
                            echo "<script language=javascript1.2>
                            window.location='tempExcel/".$nop_.".xls';
                            </script>";
                        }
                        fclose($handle);
                    }     
    break;


    case'excelsupplier':

            $tab.="<table border=1>
                
                      <tr class=rowheader >
                      <td>No</td>
                      <td>Kode Supplier</td>
                      <td>Nama Supplier</td>
                      <td>Status</td>
                  
                      </tr>";
            $str = "select * from " . $dbname . ".mst_supplier order by kode_supplier ";
            
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                //$nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['kode_supplier']. "</td>";          
                $tab.="<td align=left>" . $d['nama_supplier']. "</td>";
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          
                $tab.="</tr>"; 

                 }
        
                $tglSkrg=date("Ymd");
                    $nop_="Master_Supplier";
                    if(strlen($tab)>0)
                    {
                        if ($handle = opendir('tempExcel')) {
                            while (false !== ($file = readdir($handle))) {
                                if ($file != "." && $file != ".." && $file != "index.html") {
                                    @unlink('tempExcel/'.$file);
                                }
                            }   
                            closedir($handle);
                        }
                        $handle=fopen("tempExcel/".$nop_.".xls",'w');
                        if(!fwrite($handle,$tab))
                        {
                            echo "<script language=javascript1.2>
                            parent.window.alert('Can't convert to excel format');
                            </script>";
                            exit;
                        }
                        else
                        {
                            echo "<script language=javascript1.2>
                            window.location='tempExcel/".$nop_.".xls';
                            </script>";
                        }
                        fclose($handle);
                    }     
    break;


    case'excelbarang':

            $tab.="<table border=1>
                
                      <tr class=rowheader >
                      <td>No</td>
                      <td>Kode Barang</td>
                      <td>Nama Barang</td>
                      <td>Cabang</td>
                      <td>Status</td>
                  
                      </tr>";
            $str = "select * from " . $dbname . ".mst_barang order by kode_barang ";
            
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmcabang = makeOption($dbname, 'mst_cabang', 'kode_cabang,nama_cabang');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['kode_barang']. "</td>";          
                $tab.="<td align=left>" . $d['nama_barang']. "</td>";
                $tab.="<td align=left>" . $nmcabang[$d['cabang']]. "</td>";
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          
                $tab.="</tr>"; 

                 }
        
                $tglSkrg=date("Ymd");
                    $nop_="Master_Cabang";
                    if(strlen($tab)>0)
                    {
                        if ($handle = opendir('tempExcel')) {
                            while (false !== ($file = readdir($handle))) {
                                if ($file != "." && $file != ".." && $file != "index.html") {
                                    @unlink('tempExcel/'.$file);
                                }
                            }   
                            closedir($handle);
                        }
                        $handle=fopen("tempExcel/".$nop_.".xls",'w');
                        if(!fwrite($handle,$tab))
                        {
                            echo "<script language=javascript1.2>
                            parent.window.alert('Can't convert to excel format');
                            </script>";
                            exit;
                        }
                        else
                        {
                            echo "<script language=javascript1.2>
                            window.location='tempExcel/".$nop_.".xls';
                            </script>";
                        }
                        fclose($handle);
                    }     
    break;
}


?>