

function simpandet()
{
    notransaksi=document.getElementById('notrans').value;
    pbj=document.getElementById('pbj').value;
    nokontrak=document.getElementById('nokontrak').value;
    judul=document.getElementById('judul').value;
    nilai=document.getElementById('nilai').value;
    lokasi=document.getElementById('lokasi').value;
    per1=document.getElementById('per1').value;
    per2=document.getElementById('per2').value;
    jnspek=document.getElementById('jnspek').value;
    brg=document.getElementById('brg').value;
    kdbrg=document.getElementById('kdbrg').value;
    volume=document.getElementById('volume').value;
    satuan=document.getElementById('satuan').value;
    harsat=remove_comma_var(document.getElementById('harsat').value);
    jumlah=remove_comma_var(document.getElementById('jumlah').value);
    peritem=remove_comma_var(document.getElementById('peritem').value);
    persen=remove_comma_var(document.getElementById('persen').value);
    
    method=document.getElementById('method').value;
    param='method='+method+'&notransaksi='+notransaksi+'&pbj='+pbj+'&nokontrak='+nokontrak+'&judul='+judul+'&nilai='+nilai+'&lokasi='+lokasi+'&per1='+per1+'&per2='+per2+'&jnspek='+jnspek+'&brg='+brg+'&kode='+kdbrg;
    param+='&volume='+volume+'&satuan='+satuan+'&harsat='+harsat+'&jumlah='+jumlah+'&peritem='+peritem+'&persen='+persen;
  tujuan='pln_slave_boq.php';
  post_response_text(tujuan, param, respog);
  function respog(){
    if (con.readyState == 4) {
      if (con.status == 200) {
        busy_off();
        if (!isSaveResponse(con.responseText)) {
          alert('ERROR TRANSACTION,\n' + con.responseText);
        }
        else {
            isdt = con.responseText.split("##");
            nokontrak=isdt[0];
            if (method=='insertdet') {
              notransaksi=isdt[1];
            }
          
            
          document.getElementById('notrans').value = notransaksi=isdt[1];
          loadDatadetail(nokontrak,notransaksi);
                   cancelIsi();
                    alert('Done.');

                   
          //document.getElementById('container').innerHTML=con.responseText;
        }
      }
      else {
        busy_off();
        error_catch(con.status);
      }
    }
  }   

}


function loadDatadetail(nokontrak,notransaksi){

    param='method=loadDatadetail'+'&nokontrak='+nokontrak+'&notransaksi='+notransaksi;

    tujuan='pln_slave_boq.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerdetail').innerHTML = con.responseText;
                     getdatakontrak2(nokontrak,notransaksi);
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}

function loadData(){

    param='method=loadData';
    tujuan='pln_slave_boq.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('container').innerHTML = con.responseText;
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function hapus(notransaksi,nokontrak)
{
    fileTarget='pln_slave_boq';
    param='nokontrak='+nokontrak+'&notransaksi='+notransaksi+'&method=delete';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadData();
                   
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data BOQ dengan Kontrak '+nokontrak+'?'))post_response_text(fileTarget+'.php', param, respon);
}

function hapusdet(notransaksi,kode)
{
    fileTarget='pln_slave_boq';
    param='nokontrak='+nokontrak+'&kode='+kode+'&notransaksi='+notransaksi+'&method=deletedet';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetail(nokontrak,notransaksi);
                     cancelIsi();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus Item ?'))post_response_text(fileTarget+'.php', param, respon);
}




function edit(notransaksi,pbj,nokontrak,nilai,amandemen,lokasi,judul,per1,per2)
{
     document.getElementById('header').style.display="block";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="none";
     document.getElementById('headerlist').style.display="block";
     document.getElementById('listdatadetail').style.display="block";

     loadDatadetail(nokontrak,notransaksi);
      document.getElementById('notrans').value=notransaksi;
      document.getElementById('pbj').value=pbj;
      document.getElementById('nokontrak').value=nokontrak;
      document.getElementById('nilai').value=nilai;
      document.getElementById('lokasi').value=lokasi;
      document.getElementById('judul').value=judul;
      document.getElementById('per1').value=per1;
      document.getElementById('per2').value=per2;
      if (amandemen!='') {
        document.getElementById('amandemen').hidden =false;
        document.getElementById('amd').value =amandemen;
      }
      else
      {
        document.getElementById('amandemen').hidden =true;
      }
      

}

function editdet(jns_item,nama_item,vol_item,satuan_item,harga_item,jum_item,per_satuan_item,per_total_item,kode)
{
 

      document.getElementById('jnspek').value=jns_item;
      document.getElementById('kdbrg').value=kode;
      document.getElementById('brg').value=nama_item;
      document.getElementById('volume').value=vol_item;
      document.getElementById('satuan').value=satuan_item;
      document.getElementById('harsat').value=harga_item;
      document.getElementById('jumlah').value=jum_item;
      document.getElementById('peritem').value=per_satuan_item;
      document.getElementById('persen').value=per_total_item;
      document.getElementById('method').value='updatedet';

}






function getdatakontrak()
{

    pbj=document.getElementById('pbj').value;
    param='pbj='+pbj+'&method=getdatakontrak';
    tujuan='pln_slave_boq.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                    document.getElementById('nokontrak').innerHTML = con.responseText;

                   

       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}

function getdatakontrak2(nokontrak,notransaksi)
{
    
   
    param='nokontrak='+nokontrak+'&method=getdatakontrak2'+'&notransaksi='+notransaksi;
    tujuan='pln_slave_boq.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                    document.getElementById('nokontrak').innerHTML = con.responseText;
                    document.getElementById('nokontrak').disabled = true;
                    document.getElementById('pbj').disabled = true;


                   

       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}

function getnilai()
{   

    nokontrak=document.getElementById('nokontrak').value;
    param='nokontrak='+nokontrak+'&method=getnilai';
    tujuan='pln_slave_boq.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                   isdt = con.responseText.split("##");
            
                    document.getElementById('nilai').value = isdt[0];
                    document.getElementById('lokasi').value = isdt[3];
                    document.getElementById('judul').value = isdt[4];
                    if (isdt[1]==1) {
                       document.getElementById('amandemen').hidden =true;
                    }
                    else
                    {
                      document.getElementById('amandemen').hidden =false;
                      document.getElementById('amd').value =isdt[2];
                    }
                    document.getElementById('per1').value = isdt[5];
                    document.getElementById('per2').value = isdt[6];

                    getnotras(nokontrak);



       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}

function getnotras(nokontrak)
{


    //nokontrak=document.getElementById('nokontrakmg').value;
    method='getnotras';

    tujuan='pln_slave_boq.php';
    param='method='+method+'&nokontrak='+nokontrak;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                   
                
                    document.getElementById('notrans').value=con.responseText;
                    
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}



function cancelIsi()
{


    document.getElementById('jnspek').value='';
    document.getElementById('brg').value='';
    document.getElementById('volume').value='';
    document.getElementById('satuan').value='';
    document.getElementById('harsat').value='';
    document.getElementById('jumlah').value='';
    document.getElementById('peritem').value='';
    document.getElementById('persen').value='';
    document.getElementById('method').value='insertdet';


}

function cancelIsidet()
{


    document.getElementById('header').style.display="none";
    document.getElementById('listmenu').style.display="block";
    document.getElementById('listdata').style.display="block";
    document.getElementById('headerlist').style.display="none";
    document.getElementById('listdatadetail').style.display="none";

    document.getElementById('pbj').value='';
    document.getElementById('nokontrak').value='';
    document.getElementById('nilai').value='';




}

function simpanheader()
{
     pbj=document.getElementById('pbj').value;
     nokontrak=document.getElementById('nokontrak').value;
     nilai=document.getElementById('nilai').value;

     if (pbj=='') {
        alert('Silahkan Pilih PBJ');
        return;
     }
     if (nokontrak=='') {
        alert('No Kontrak Kosong');
        return;
     }
     if (nilai=='' || nilai=='0') {
        alert('nilai Kontrak Kosong');
        return;
     }

     document.getElementById('header').style.display="block";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="none";
     document.getElementById('headerlist').style.display="block";
      document.getElementById('listdatadetail').style.display="block";
      loadDatadetail(nokontrak);

}


function buatbaru()
{
   
     document.getElementById('header').style.display="none";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="none";
     document.getElementById('headerlist').style.display="block";
     document.getElementById('listdatadetail').style.display="none";

       document.getElementById('nokontrak').disabled = false;
       document.getElementById('nokontrak').value = '';
       document.getElementById('pbj').disabled = false;
       document.getElementById('pbj').value = '';
       document.getElementById('nilai').value = '';

}

function listdata()
{
   
     document.getElementById('header').style.display="none";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="block";
      document.getElementById('headerlist').style.display="none";
     document.getElementById('listdatadetail').style.display="none";
      document.getElementById('nokontrak').disabled = false;
       document.getElementById('nokontrak').value = '';
       document.getElementById('pbj').disabled = false;
       document.getElementById('pbj').value = '';
       document.getElementById('nilai').value = '';
       document.getElementById('amandemen').hidden =true;
     loadData();

}

function getjum()
{
    nilai=document.getElementById('nilai').value;
    volume=document.getElementById('volume').value;
    harsat=remove_comma_var(document.getElementById('harsat').value);
    peritem=document.getElementById('peritem').value;
    persen=document.getElementById('persen').value;

    jumlah=volume*harsat;
    jumperitem=(jumlah*100/nilai)/volume;
    jumperitem=jumperitem.toFixed(2);
    jumpersen=(jumlah*100/nilai);
    jumpersen=jumpersen.toFixed(2);

    document.getElementById('jumlah').value=jumlah;
    document.getElementById('peritem').value=jumperitem;
    document.getElementById('persen').value=jumpersen;
    

}




