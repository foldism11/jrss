<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$brg=checkPostGet('brg','');
$cabang=checkPostGet('cabang','');
$faktur=checkPostGet('faktur','');
$harga=checkPostGet('harga','');
$qty=checkPostGet('qty','');
$tgl=checkPostGet('tgl','');
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

             $str = "select * from " . $dbname . ".mst_barang where kode_barang='".$brg."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

               $satuan=$d['satuan'];  

                }  

    

        echo @$harga.'##'.@$satuan;


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

         

             $str = "select * from " . $dbname . ".trx_atk  group by faktur order by faktur ";

            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                @$totfak+=$d['qty'];
               @$totrp+=$d['totalrp'];

              
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
              
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['faktur']. "</td>";                  
                $tab.="<td align=left>" . $optcabang[$d['cabang']]. "</td>";
                $tab.="<td align=right>" . number_format($totfak). "</td>";                                
                $tab.="<td align=right>" . number_format($totrp). "</td>";                                
                $tab.="<td align=left>" . $d['createtime']. "</td>";                 
                $tab.="<td align=left>" . $d['createdby']. "</td>";                        

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['faktur']."','".$d['cabang']."','".$d['createtime']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>
                <td align=left ><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapus('".$d['faktur']."',);\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

                

                 }
        
        echo $tab;
    break;

     case'loadDatadetail':

            $str = "select * from " . $dbname . ".trx_atk where faktur='".$faktur."' ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {

              
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['barang']. "</td>";                                                
                $tab.="<td align=right>" . number_format($d['harga']). "</td>";                                               
                $tab.="<td align=right>" . number_format($d['qty']). "</td>";                 
                $tab.="<td align=right>" . number_format($d['totalrp']). "</td>";                 
                 $disabled='';
                $flag=$d['flag'];
                $hidden='';
                if ($flag==1) {
                $disabled='disabled';
                            }                        

                $tab.="<td align=left ><a style='color:white'; class='btn btn-info btn-sm ".$disabled."' onclick=\"editdetail('".$d['barang']."','".$d['harga']."','".$d['qty']."','".$d['totalrp']."');\"><i class='fas fa-pencil-alt' ></i>Edit
                </a></td>
                <td align=left ".$hidden."><a style='color:white'; class='btn btn-danger btn-sm ".$disabled."' onclick=\"hapus('".$d['faktur']."','".$d['nourut']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

                 }

                /* $tab.="<br><button  ".$hidden." style='width:100px;' type='button' class='btn btn-block btn-success ".$disabled."' onclick=saveall('".$faktur."') >Selesai</button>";*/
        
        echo $tab;
    break;


        case 'insert':

    
        if ($brg=='') {
            exit('Warning : Nama Barang Tidak Boleh Kosong');
        }
        if ($harga=='') {
            exit('Warning : Harga Tidak Boleh Kosong');
        }
        if ($qty=='') {
            exit('Warning : Qty Tidak Boleh Kosong');
        }
         if ($cabang=='') {
            exit('Warning : Cabang Tidak Boleh Kosong');
        }
        if ($tgl=='') {
            exit('Warning : Tanggal Tidak Boleh Kosong');
        }
     

        $date=date('Y-m-d h:m:s');


        $str="insert into ".$dbname.".trx_atk (faktur,cabang,barang,qty,harga,totalrp,createtime,createdby,updatetime,updateby)
        values ('" . $faktur . "','" . $cabang . "','" . $brg . "','" . $qty . "','" . $harga . "','" . $jum . "','".$date."','".$_SESSION['standard']['username']."','".$date."','".$_SESSION['standard']['username']."')";


        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }
        

        break;


        case'update':
     
        if ($brg=='') {
            exit('Warning : Barang Kosong');
        }
        $supdt="update ".$dbname.".trx_jual set kode_barang='".$brg."',harga='".$harga."',qty='".$qty."',cabang='".$cabang."' where faktur = '".$faktur."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;

    case'updatedetail':
     

        $supdt="update ".$dbname.".trx_atk set qty='".$qty."',harga='".$harga."',totalrp='".$jum."' where faktur = '".$faktur."' and barang='".$brg."' and cabang='".$cabang."'";
    

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;


       case'delete': 
        $sIns="delete from ".$dbname.".trx_atk where faktur = '".$faktur."' and nourut='".$nourut."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;

 case'deletehead': 
        $sIns="delete from ".$dbname.".trx_atk where faktur = '".$faktur."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
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
                             exit('Warning : Barang Tidak ada di Stock');
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


                          
                          $kurangdus=0;
                          $totpcs=$pcs-$bar->rec_conv1;
    
                          if ($totpcs<=0) {
                               $kurangdus=1;
                               $sisapcs=$totpcs+$convdus;
                               $totdus=$kurangdus-$dus;
/*
                               if ($sisapcs>=$convdus) {
                                    $tambahdus=1;
                                    $sisapcs=$sisapcs-$convdus;
                                    $totdus=$tambahdus+$totdus;

                                    if ($sisapcs>=$convdus) {
                                        $tambahdus=1;
                                        $sisapcs=$sisapcs-$convdus;
                                        $totdus=$tambahdus+$totdus;
                                    }
                               }*/
                          }

                          else
                          {
                          
                            $totpcsx=($pcs-$bar->rec_conv1);
                          }

            
                            
                 
                             

                              $totqty=($totdus*$convdus)-$totpcsx;

                               $supdt="update ".$dbname.".mst_stock set rec_conv1='".$totpcsx."',tot_qty_conv1='".$totqty."',updatetime='".$date."'  where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                           

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
       

        

   }


  



?>