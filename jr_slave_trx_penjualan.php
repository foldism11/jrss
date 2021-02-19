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

      

             $str = "select * from " . $dbname . ".trx_beli where tipetransaksi=1 group by faktur order by faktur ";

            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                @$totfak+=$d['rec_conv1'];
               @$totrp+=$d['hargarupiah'];

              
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
                $optbarang=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".$d['kode_barang']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['faktur']. "</td>";                  
                $tab.="<td align=left>" . $optcabang[$d['cabang']]. "</td>";
                $tab.="<td align=right>" . number_format($totfak). "</td>";                                
                $tab.="<td align=right>" . number_format($totrp). "</td>";                                
                $tab.="<td align=left>" . $d['createtime']. "</td>";                 
                $tab.="<td align=left>" . $d['createdby']. "</td>";                        

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['faktur']."','".$d['cabang']."','".$d['createtime']."');\"><i class='fas fa-zoom-alt'></i>Detail
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
                $optsatuan=makeOption($dbname,'mst_barang','kode_barang,satuan',"kode_barang='".$d['kode_barang']."'");
                $optharsat=makeOption($dbname,'mst_stock','kode_barang,cost_sell',"kode_barang='".$d['kode_barang']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $optbarang[$d['kode_barang']]. "</td>";                                                
                $tab.="<td align=left>" . $optsatuan[$d['kode_barang']]. "</td>";  
                $tab.="<td align=left>" .  number_format($optharsat[$d['kode_barang']]). "</td>";
                $tab.="<td align=right>" . number_format($d['rec_conv1']). "</td>";                                               
                $tab.="<td align=right>" . number_format($d['hargarupiah']). "</td>";                 
                 $disabled='';
                $flag=$d['flag'];
                $hidden='';
                if ($flag==1) {
                $disabled='disabled';
                 $hidden='hidden';
                            }                        

                $tab.="<td align=left ><a style='color:white'; class='btn btn-info btn-sm ".$disabled."' onclick=\"editdetail('".$d['kode_barang']."','".$optsatuan[$d['kode_barang']]."','".$optharsat[$d['kode_barang']]."','".$d['rec_conv1']."','".$d['hargarupiah']."');\"><i class='fas fa-pencil-alt' ></i>Edit
                </a></td>
                <td align=left ><a style='color:white'; class='btn btn-danger btn-sm ".$disabled."' onclick=\"hapus('".$d['faktur']."','".$d['nourut']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

                 }

                 $tab.="<br><button  ".$hidden." style='width:100px;' type='button' class='btn btn-block btn-success ".$disabled."' onclick=saveall('".$faktur."') >Selesai</button>";
        
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
     

        #cek stok
        $str1 = "select tot_qty_conv1 from  " . $dbname . ".mst_stock where kode_barang = '".$brg."' and cabang='".$cabang."'";
        $res1=$owlPDO->query($str1) or die(print " Gagal: ".PDOException::getMessage());
        $res1->setFetchMode(PDO::FETCH_OBJ);
        while ($bar1 = $res1->fetch()) {
          $cekstock=$bar1->tot_qty_conv1;

      }

      if ($qty>$cekstock) {
        exit('Warning : Jumlah Qty Melebih Jumlah Stock, Silahkan Kurangi Jumlah Qty');
      }

        $date=date('Y-m-d h:m:s');


        $str="insert into ".$dbname.".trx_beli (faktur,cabang,kode_barang,rec_conv1,createtime,createdby,updatetime,updateby,hargarupiah,tipetransaksi)
        values ('" . $faktur . "','" . $cabang . "','" . $brg . "','" . $qty . "','".$date."','".$_SESSION['standard']['username']."','".$date."','".$_SESSION['standard']['username']."','" . $harga . "','1')";


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
     

        $supdt="update ".$dbname.".trx_beli set rec_conv1='".$qty."',hargarupiah='".$jum."' where faktur = '".$faktur."' and kode_barang='".$brg."' and cabang='".$cabang."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;


       case'delete':
        $sIns="delete from ".$dbname.".trx_jual where faktur = '".$faktur."'";
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
                           $str1 = "select rec_conv1,rec_conv2,tot_qty_conv1 from  " . $dbname . ".mst_stock where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                           $res1=$owlPDO->query($str1) or die(print " Gagal: ".PDOException::getMessage());
                           $res1->setFetchMode(PDO::FETCH_OBJ);
                           while ($bar1 = $res1->fetch()) {
                              $pcs=$bar1->rec_conv1;
                              $dus=$bar1->rec_conv2;
                              $qtypcs=$bar1->tot_qty_conv1;

                          }


                          
                          $kurangdus=0;
                          $totpcs=$pcs-$bar->rec_conv1;
                         if ($convdus==0) {
                             $sisapcs=$pcs-$bar->rec_conv1;
                             $totdus=0;
                             $totqty=$sisapcs;
                         }

                         else
                         {
                                        #level 1
                                  if ($totpcs<0) {
                                       $kurangdus=1;
                                       $sisapcs=$totpcs+$convdus;
                                       $totdus=$dus-$kurangdus;
                                       $totqty=($totdus*$convdus)+$sisapcs;

                                       #level 2
                                       if ($sisapcs<0) {
                                            $kurangdus=1;
                                            $sisapcs=$sisapcs+$convdus;
                                            $totdus=$totdus-$kurangdus;
                                            $totqty=($totdus*$convdus)+$sisapcs;

                                            #level 3
                                            if ($sisapcs<0) {
                                                $kurangdus=1;
                                                $sisapcs=$sisapcs+$convdus;
                                                $totdus=$totdus-$kurangdus;
                                                $totqty=($totdus*$convdus)+$sisapcs;

                                                #level 4
                                                if ($sisapcs<0) {
                                                    $kurangdus=1;
                                                    $sisapcs=$sisapcs+$convdus;
                                                    $totdus=$totdus-$kurangdus;
                                                    $totqty=($totdus*$convdus)+$sisapcs;

                                                        #level 5
                                                    if ($sisapcs<0) {
                                                        $kurangdus=1;
                                                        $sisapcs=$sisapcs+$convdus;
                                                        $totdus=$totdus-$kurangdus;
                                                        $totqty=($totdus*$convdus)+$sisapcs;

                                                       
                                                    }

                                                   
                                                }

                                               
                                            }

                                        }
                                        
                                  }

                                  else
                                  {
                                 
                                    $sisapcs=($pcs-$bar->rec_conv1);
                                    $totdus=$dus-$kurangdus;
                                    $totqty=($totdus*$convdus)+$sisapcs;
                                  }
                         }
                 
                          

                        
                 
                             

                             // $totqty=($totdus*$convdus)-$totpcsx;
                            

                               $supdt="update ".$dbname.".mst_stock set rec_conv1='".$sisapcs."',rec_conv2='".$totdus."',tot_qty_conv1='".$totqty."',updatetime='".$date."'  where kode_barang = '".$bar->kode_barang."' and cabang='".$bar->cabang."'";
                        

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