<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$cabang=checkPostGet('cabang','');
$faktur=checkPostGet('faktur','');
$supp=checkPostGet('supp','');
$tgl=checkPostGet('tgl','');
$tgl2=checkPostGet('tgl2','');

$brg=checkPostGet('brg','');
$qtypcs=checkPostGet('qtypcs','');
$qtypack=checkPostGet('qtypack','');
$hargabeli=checkPostGet('hargabeli','');
$hargajual=checkPostGet('hargajual','');
$jum=checkPostGet('jum','');
$nourut=checkPostGet('nourut','');





$method=checkPostGet('method','');
switch ($method) {

     case'getdata':

     $str = "select * from " . $dbname . ".mst_stock where cabang='".$cabang."' and kode_barang='".$brg."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

               $harga=$d['cost_sell'];  

                }    
        echo @$harga.'##'.'x';  


     break;


     case'getjum':

     $str = "select * from " . $dbname . ".mst_barang where cabang='".$cabang."' and kode_barang='".$brg."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

               @$conv=$d['conv1'];  

                } 
        @$jum=(($qtypack*$conv)+$qtypcs)*$hargabeli;
   
        echo @$jum;  


     break;


    case'getnofak':

        $strfaktur = "select max(faktur) as faktur from " . $dbname . ".trx_beli limit 1";
        $resfaktur=$owlPDO->query($strfaktur) or die(print " Gagal: ".PDOException::getMessage());
        $resfaktur->setFetchMode(PDO::FETCH_OBJ);
        while ($barfaktur = $resfaktur->fetch()) {
           $faktur=$barfaktur->faktur;

           if ($faktur=='') {
             $faktur=$faktur+1;
         }
         else
         {
            $faktur+=1;
        }

        $faktur = str_pad($faktur, 10, "0", STR_PAD_LEFT);

        }

        echo $faktur;

     break;

        case'loadData':

            $str = "select faktur,cabang,supplier,tanggal_beli,tanggal_tiba,sum(hargarupiah) as totfak,createdby,createtime from " . $dbname . ".trx_beli where tipetransaksi=0 group by faktur order by faktur ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

              
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
                $optsupplier=makeOption($dbname,'mst_supplier','kode_supplier,nama_supplier',"kode_supplier='".$d['supplier']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['faktur']. "</td>";                  
                $tab.="<td align=left>" . $optcabang[$d['cabang']]. "</td>";                                
                $tab.="<td align=left>" . $optsupplier[$d['supplier']]. "</td>";                                
                $tab.="<td align=left>" . $d['tanggal_beli']. "</td>";                 
                $tab.="<td align=left>" . $d['tanggal_tiba']. "</td>";                 
                $tab.="<td align=right>" . number_format($d['totfak']). "</td>";                 
                $tab.="<td align=left>" . $d['createdby']. "</td>";                        
                $tab.="<td align=left>" . $d['createtime']. "</td>";                 

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['faktur']."','".$d['cabang']."','".$d['supplier']."','".$d['tanggal_beli']."','".$d['tanggal_tiba']."');\"><i class='fas fa-zoom-alt'></i>Detail
                </a></td>
                <td hidden align=left ><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapus('".$d['faktur']."',);\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

                

                 }
        
        echo $tab;
    break;


     case'loadDatadetail':

            $str = "select * from " . $dbname . ".trx_beli where faktur='".$faktur."' ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

              
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
                $optbarang=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".$d['kode_barang']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $optbarang[$d['kode_barang']]. "</td>";                                                
                $tab.="<td align=right>" . number_format($d['rec_conv1']). "</td>";                 
                $tab.="<td align=right>" . number_format($d['rec_conv2']). "</td>";                        
                $tab.="<td align=right>" . number_format($d['cost_buy']). "</td>";                        
                $tab.="<td align=right>" . number_format($d['cost_sell']). "</td>";                        
                $tab.="<td align=right>" . number_format($d['hargarupiah']). "</td>";

                $flag=$d['flag'];
                $hidden='';
                $disabled='';
                if ($flag==1) {
                $disabled='disabled';
                            }                        

                $tab.="<td align=left ><a style='color:white'; class='btn btn-info btn-sm ".$disabled."' onclick=\"editdetail('".$d['faktur']."','".$d['kode_barang']."','".$d['rec_conv1']."','".$d['rec_conv2']."','".$d['cost_buy']."','".$d['cost_sell']."','".$d['hargarupiah']."');\"><i class='fas fa-pencil-alt' ></i>Edit
                </a></td>
                <td align=left ".$hidden."><a style='color:white'; class='btn btn-danger btn-sm ".$disabled."' onclick=\"hapus('".$d['faktur']."','".$d['nourut']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

                

                

                 }

                 $tab.="<br><button  ".$hidden." style='width:100px;' type='button' class='btn btn-block btn-success ".$disabled."' onclick=saveall('".$faktur."') >Selesai</button>";
        
        echo $tab;
    break;

        case 'insert':

        if ($brg=='') {
            exit('Warning : Nama Barang Tidak Boleh Kosong');
        }
        if ($qtypcs=='') {
            exit('Warning : Qty PCS Tidak Boleh Kosong');
        }
        if ($qtypack=='') {
            exit('Warning : Qty PACK Tidak Boleh Kosong');
        }
        if ($hargabeli=='') {
            exit('Warning : Harga Beli Boleh Kosong');
        }
         if ($hargajual=='') {
            exit('Warning : Harga Jual Boleh Kosong');
        }
         


        $date=date('Y-m-d h:m:s');


        $str="insert into ".$dbname.".trx_beli (faktur,cabang,supplier,tanggal_beli,tanggal_tiba,kode_barang,rec_conv1,rec_conv2,cost_buy,cost_sell,createtime,createdby,updatetime,updateby,hargarupiah)
        values ('" . $faktur . "','" . $cabang . "','" . $supp . "','" . $tgl . "','" . $tgl2 . "','" . $brg . "','" . $qtypcs . "','" . $qtypack . "','" . $hargabeli . "','" . $hargajual . "','".$date."','".$_SESSION['standard']['username']."','".$date."','".$_SESSION['standard']['username']."','" . $jum . "')";


        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }



        /*$str = "select * from  " . $dbname . ".mst_barang where kode_barang = '".$brg."' and cabang='".$cabang."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
          $convdus=$bar->conv1;

        }

        $str = "select count(*) as cekjum from  " . $dbname . ".mst_stock where kode_barang = '".$brg."' and cabang='".$cabang."' and kode_supplier='".$supp."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
          $cekjum=$bar->cekjum;

        }

        $totqty=($qtypack*$convdus)+$qtypcs;


    



        if ($cekjum==0) {
             $str="insert into ".$dbname.".mst_stock (cabang,kode_supplier,faktur,tanggal_tiba,nilai_faktur,kode_barang,rec_conv1,rec_conv2,tot_qty_conv1,cost_sell,cost_buy,createtime,updatetime)
                    values ('" . $cabang . "','" . $supp . "','','" . $tgl2 . "','','" . $brg . "','" . $qtypcs . "','" . $qtypack . "','".$totqty."','" . $hargabeli . "','" . $hargajual . "','" . $date . "','" . $date . "')";

                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }
        }*/
  

        break;


         case 'saveall':

         $date=date('Y-m-d h:m:s');
         $str = "select * from  " . $dbname . ".trx_beli where faktur = '".$faktur."' and flag=0";
         $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
         $res->setFetchMode(PDO::FETCH_OBJ);
         while ($bar = $res->fetch()) {

         // $convdus=$bar->conv1;


                        $strx = "select * from  " . $dbname . ".mst_barang where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                        $resx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
                        $resx->setFetchMode(PDO::FETCH_OBJ);
                        while ($barx = $resx->fetch()) {
                          $convdus=$barx->conv1;

                        }

                        $str1 = "select count(*) as cekjum from  " . $dbname . ".mst_stock where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                        $res1=$owlPDO->query($str1) or die(print " Gagal: ".PDOException::getMessage());
                        $res1->setFetchMode(PDO::FETCH_OBJ);
                        while ($bar1 = $res1->fetch()) {
                          $cekjum=$bar1->cekjum;

                        }

                       $totqty=($bar->rec_conv2*$convdus)+$bar->rec_conv1;


                    
 
                   
                        if ($cekjum==0) {
                             $str="insert into ".$dbname.".mst_stock (cabang,faktur,tanggal_tiba,nilai_faktur,kode_barang,rec_conv1,rec_conv2,tot_qty_conv1,cost_sell,cost_buy,createtime,updatetime)
                                    values ('" . $bar->cabang . "','','" . $bar->tanggal_tiba . "','','" . $bar->kode_barang . "','" . $bar->rec_conv1 . "','" . $bar->rec_conv2 . "','".$totqty."','" . $bar->cost_sell . "','" . $bar->cost_buy . "','" . $date . "','" . $date . "')";
                  


                                    try{
                                        $owlPDO->exec($str); 

                                                $supdt="update ".$dbname.".trx_beli set flag='1' where faktur = '".$faktur."' and nourut='".$bar->nourut."'";


                                                try{
                                                    $owlPDO->exec($supdt); 
                                                }
                                                catch (PDOException $e){
                                                    echo"Gagal".$e->getMessage();
                                                    die();
                                                }
                                    }catch(PDOException $e){
                                        echo " Gagal," . addslashes($e->getMessage());
                                    }
                        }

                        else
                        {   


                           $str1 = "select rec_conv1,rec_conv2 from  " . $dbname . ".mst_stock where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                           $res1=$owlPDO->query($str1) or die(print " Gagal: ".PDOException::getMessage());
                           $res1->setFetchMode(PDO::FETCH_OBJ);
                           while ($bar1 = $res1->fetch()) {
                              $pcs=$bar1->rec_conv1;
                              $dus=$bar1->rec_conv2;

                          }


                               $tambahdus=0;

                               $totpcs=$pcs+$bar->rec_conv1;
                               #jika conversi dus nya 0
                               if ($convdus==0) {
                                   $sisapcs=$pcs+$bar->rec_conv1;
                                   $totdus=0;
                                   $totpcsx=$sisapcs;
                               }

                               else
                               {

                                                  #level 1
                                       if ($totpcs>=$convdus) {
                                           $tambahdus=1;
                                           $sisapcs=$totpcs-$convdus;
                                           $totdus=$tambahdus+$dus;
                                           $totpcsx=$sisapcs+$pcs;
                                                #level 2
                                               if ($sisapcs>=$convdus) {
                                                 $tambahdus=1;
                                                 $sisapcs=$sisapcs-$convdus;
                                                 $totdus=$tambahdus+$totdus;
                                                 $totpcsx=$sisapcs+$pcs;
                                                     #level 3
                                                     if ($sisapcs>=$convdus) {
                                                       $tambahdus=1;
                                                       $sisapcs=$sisapcs-$convdus;
                                                       $totdus=$tambahdus+$totdus;
                                                       $totpcsx=$sisapcs+$pcs;

                                                        #level 4
                                                       if ($sisapcs>=$convdus) {
                                                         $tambahdus=1;
                                                         $sisapcs=$sisapcs-$convdus;
                                                         $totdus=$tambahdus+$totdus;
                                                         $totpcsx=$sisapcs+$pcs;

                                                              #level 5
                                                             if ($sisapcs>=$convdus) {
                                                               $tambahdus=1;
                                                               $sisapcs=$sisapcs-$convdus;
                                                               $totdus=$tambahdus+$totdus;
                                                               $totpcsx=$sisapcs+$pcs;
                                                           }
                                                        }

                                                     }
                                                }
                                       }
                                       else
                                       {
                                             $totdus=($tambahdus+$bar->rec_conv2)+$dus;
                                             $totpcsx=($bar->rec_conv1+$pcs);
                                       }

                               }
                            
                               

                              $totqty=($totdus*$convdus)+$totpcsx;

                          


                               $supdt="update ".$dbname.".mst_stock set tanggal_tiba='".$bar->tanggal_tiba."',rec_conv1='".$totpcsx."',rec_conv2='".$totdus."',tot_qty_conv1='".$totqty."',cost_buy='".$bar->cost_buy."',cost_sell='".$bar->cost_sell."',updatetime='".$date."'  where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                           

                               try{
                                $owlPDO->exec($supdt); 

                                $supdt="update ".$dbname.".trx_beli set flag='1' where faktur = '".$faktur."' and nourut='".$bar->nourut."'";


                                                try{
                                                    $owlPDO->exec($supdt); 
                                                }
                                                catch (PDOException $e){
                                                    echo"Gagal".$e->getMessage();
                                                    die();
                                                }

                            }
                            catch (PDOException $e){
                                echo"Gagal".$e->getMessage();
                                die();
                            }
                        }



         }

         break;


        case'updatedetail':
     

        $supdt="update ".$dbname.".trx_beli set rec_conv1='".$qtypcs."',rec_conv2='".$qtypack."',cost_buy='".$hargabeli."',cost_sell='".$hargajual."',hargarupiah='".$jum."' where faktur = '".$faktur."' and kode_barang='".$brg."' and cabang='".$cabang."' and supplier='".$supp."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;


       case'delete':
        $sIns="delete from ".$dbname.".trx_beli where faktur = '".$faktur."' and nourut='".$nourut."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        

   }  



?>