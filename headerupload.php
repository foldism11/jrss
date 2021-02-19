<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="../images/jrss.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><? $nmcabang = makeOption($dbname, 'mst_cabang', 'kode_cabang,nama_cabang'); echo $_SESSION['standard']['username'].' <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cabang ('.$nmcabang[$_SESSION['standard']['cabang']].')' ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <?

   /*    $str=$owlPDO->query("select * from ".$dbname.".mst_hak_akses where namauser='".$_SESSION['standard']['username']."'");
               $str->setFetchMode(PDO::FETCH_OBJ);
               while($bar=$str->fetch())
               { 

                $header=$bar->header;
                $detail=$bar->detail;
                

               }*/

      if ($_SESSION['standard']['tipeuser']!=1) {
        $whr=" and find_in_set (a.id, (select header from  mst_hak_akses where namauser='".$_SESSION['standard']['username']."')) and 
        find_in_set (b.id, (select detail from  mst_hak_akses where namauser='".$_SESSION['standard']['username']."'))";
      }
        
        

        $str=$owlPDO->query("select a.source,a.nama,a.id,b.id as idx,b.subid,b.nama as subnama,b.konten,b.nourut,a.nourut from ".$dbname.".master_admin a left join ".$dbname.".menu_detail b on a.id=b.subid  where 1=1 ".$whr."  order by a.nourut,b.nourut asc");

               $str->setFetchMode(PDO::FETCH_OBJ);
               while($bar=$str->fetch())
               { 


                $nama[$bar->nama]=$bar->nama;
                $subnamax[$bar->subnama]=$bar->subnama;
                $nm[$bar->nama][$bar->subnama]=$bar->subnama;
                $source[$bar->nama][$bar->subnama]=$bar->konten;

                ?>

                   
              <?

               }

               if (count(@$nama)>0) {
                    foreach ($nama as $nma) {
                    ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            <? echo $nma; ?>
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>

                        <?
                          foreach ($subnamax as $subnma) {
                           if (@$nm[$nma][$subnma]!='') {
                                ?>
                               <ul class="nav nav-treeview">
                               <li class="nav-item">
                               <a href="../<? echo @$source[$nma][$subnma]; ?>" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p> <? echo @$nm[$nma][$subnma]; ?></p>
                               </a>
                               </li>
                               </ul>
                               <?
                           }

                            
                          }
                            ?>

                       
                      </li>

                 <?
                 }
               }



               
               ?>
    
          
          
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside> 