function buatbaru()
{
   
     document.getElementById('headerlist').style.display="none";
    document.getElementById('header').style.display="block";
    cancelIsi();

}

function listdata()
{
   
   
     document.getElementById('headerlist').style.display="block";
    document.getElementById('header').style.display="none";
    document.getElementById('detail').style.display="none";
    document.getElementById('detaillist').style.display="none";
     loadData();

}

function detail()
{
   
   
     document.getElementById('headerlist').style.display="block";
    document.getElementById('header').style.display="none";
     loadData();

}


function getjum()
{
   
 qtypcs=remove_comma_var(document.getElementById('qtypcs').value);
 qtypack=remove_comma_var(document.getElementById('qtypack').value);
 hargabeli=remove_comma_var(document.getElementById('hargabeli').value);
 brg=document.getElementById('brg').value;
 cabang=document.getElementById('cabang').value;

    param='method=getjum'+'&qtypcs='+qtypcs+'&qtypack='+qtypack+'&hargabeli='+hargabeli+'&brg='+brg+'&cabang='+cabang;
    tujuan='jr_slave_trx_beli.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
               
                   
                    document.getElementById('jum').value = con.responseText;
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}

function  edit(faktur,cabang,supp,tanngalbeli,tanggaltiba)
{

  document.getElementById('headerlist').style.display="none";
  document.getElementById('header').style.display="block";
  document.getElementById('detail').style.display="block";
  document.getElementById('detaillist').style.display="block";

  document.getElementById('faktur').value=faktur;
  document.getElementById('cabang').value=cabang;
  document.getElementById('supp').value=supp;
  document.getElementById('tgl').value=tanngalbeli;
  document.getElementById('tgl2').value=tanggaltiba;

  loadDatadetail();

}

function  editdetail(faktur,kode_barang,rec_conv1,rec_conv2,cost_buy,cost_sell,jum)
{

  document.getElementById('method').value='updatedetail';
  document.getElementById('brg2').value=kode_barang;
  document.getElementById('brg').value=kode_barang;
  document.getElementById('brgx').hidden=true;
  document.getElementById('brg2x').hidden=false;
  document.getElementById('brg2').disabled=true;
  document.getElementById('qtypcs').value=rec_conv1;
  document.getElementById('qtypack').value=rec_conv2;
  document.getElementById('hargabeli').value=cost_buy;
  document.getElementById('hargajual').value=cost_sell;
  document.getElementById('jum').value=jum;


}

function simpanhead()
{
     
    faktur=document.getElementById('faktur').value;
    cabang=document.getElementById('cabang').value;
    tgl=document.getElementById('tgl').value;
    tgl2=document.getElementById('tgl2').value;
    supp=document.getElementById('supp').value;
    if (faktur=='') {
        alert('Faktur Kosong');
        return;
    }

    if (cabang=='') {
        alert('Cabang Kosong');
        return;
    }


    if (tgl=='') {
        alert('Tanggal Beli Kosong');
        return;
    }

       if (tgl2=='') {
        alert('Tanggal Tiba Kosong');
        return;
    }

       if (supp=='') {
        alert('Supplier  Beli Kosong');
        return;
    }

    document.getElementById('headerlist').style.display="none";
    document.getElementById('header').style.display="block";
    document.getElementById('detail').style.display="block";
    document.getElementById('detaillist').style.display="block";

}


function getnofak()
{

    cabang=document.getElementById('cabang').value;
    supp=document.getElementById('supp').value;
    param='method=getnofak'+'&supp='+supp+'&cabang='+cabang;
    tujuan='jr_slave_trx_beli.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
               
                   
                    document.getElementById('faktur').value = con.responseText;
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function simpan()
{

    faktur=document.getElementById('faktur').value;
    cabang=document.getElementById('cabang').value;
    supp=document.getElementById('supp').value;
    tgl=document.getElementById('tgl').value;
    tgl2=document.getElementById('tgl2').value;  


    brg=document.getElementById('brg').value;
    qtypcs=remove_comma_var(document.getElementById('qtypcs').value);
    qtypack=remove_comma_var(document.getElementById('qtypack').value);
    hargabeli=remove_comma_var(document.getElementById('hargabeli').value);
    hargajual=remove_comma_var(document.getElementById('hargajual').value);
    jum=remove_comma_var(document.getElementById('jum').value);
    


    method=document.getElementById('method').value;
    param='method='+method+'&faktur='+faktur+'&cabang='+cabang+'&supp='+supp+'&tgl='+tgl+'&tgl2='+tgl2;
    param+='&brg='+brg+'&qtypcs='+qtypcs+'&qtypack='+qtypack+'&hargabeli='+hargabeli+'&hargajual='+hargajual+'&jum='+jum;
    tujuan='jr_slave_trx_beli.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                    loadDatadetail();
                  
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


function loadData(num){


    param='method=loadData';
    tujuan='jr_slave_trx_beli.php';
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


function loadDatadetail(num){

    faktur=document.getElementById('faktur').value;
    cabang=document.getElementById('cabang').value;
    supp=document.getElementById('supp').value;
    tgl=document.getElementById('tgl').value;
    tgl2=document.getElementById('tgl2').value;  
    param='method=loadDatadetail'+'&faktur='+faktur+'&cabang='+cabang+'&supp='+supp+'&tgl='+tgl+'&tgl2='+tgl2;
    tujuan='jr_slave_trx_beli.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerdet').innerHTML = con.responseText;
                     cancelIsidetail();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}





function  cancelIsi()

{


    
    document.getElementById('faktur').value='';
    //document.getElementById('cabang').value='';
    document.getElementById('supp').value='';
    document.getElementById('tgl').value='';
    document.getElementById('tgl2').value='';

    document.getElementById('brg').value='';
    document.getElementById('qtypcs').value='0';
    document.getElementById('qtypack').value='0';
    document.getElementById('hargabeli').value='0';
    document.getElementById('hargajual').value='0';
    document.getElementById('jum').value='0';
    document.getElementById('method').value='insert';

    document.getElementById('brgx').hidden=false;
    document.getElementById('brg2x').hidden=true;


 

}

function  cancelIsidetail()

{

    document.getElementById('brg').value='';
    document.getElementById('qtypcs').value='0';
    document.getElementById('qtypack').value='0';
    document.getElementById('hargabeli').value='0';
    document.getElementById('hargajual').value='0';
    document.getElementById('jum').value='0';
    document.getElementById('method').value='insert';
 

}


function hapus(faktur,nourut)
{
    fileTarget='jr_slave_trx_beli';
    param='faktur='+faktur+'&method=delete'+'&nourut='+nourut;
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetail();
                     cancelIsidetail();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data Dengan '+faktur+'?'))post_response_text(fileTarget+'.php', param, respon);
}


function saveall(faktur)
{
    fileTarget='jr_slave_trx_beli';
    param='faktur='+faktur+'&method=saveall';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    listdata();
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
    if(confirm('Apakah  data Dengan '+faktur+'Sudah Benar? Jumlah Barang akan menambahkan stock'))post_response_text(fileTarget+'.php', param, respon);
}
function upload()
{ 
    window.location = 'import_csv/form.php?'; 
}


