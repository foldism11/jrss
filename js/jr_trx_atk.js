function buatbaru()
{
   
     document.getElementById('headerlist').style.display="none";
    document.getElementById('header').style.display="block";

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

function simpanhead()
{
    faktur=document.getElementById('faktur').value;
    cabang=document.getElementById('cabang').value;
    tgl=document.getElementById('tgl').value;


    if (cabang=='') {
        alert('Cabang Kosong');
        return;
    }


    if (tgl=='') {
        alert('Tanggal Kosong');
        return;
    }

    
     document.getElementById('headerlist').style.display="none";
    document.getElementById('header').style.display="block";
    document.getElementById('detail').style.display="block";
    document.getElementById('detaillist').style.display="block";

    getnofak();

}

function getdata()
{
    brg=document.getElementById('brg').value;
    cabang=document.getElementById('cabang').value;
    param='method=getdata'+'&brg='+brg+'&cabang='+cabang;
    tujuan='jr_slave_trx_atk.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                     isdt = con.responseText.split("##");
                   
                    document.getElementById('harga').value = isdt[0];
                    document.getElementById('satuan').value = isdt[1];
                 
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function getnofak()
{

    cabang=document.getElementById('cabang').value;
    param='method=getnofak'+'&cabang='+cabang;
    tujuan='jr_slave_trx_atk.php';
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
    brg=document.getElementById('brg').value;
    harga=document.getElementById('harga').value;
    qty=document.getElementById('qty').value;
    tgl=document.getElementById('tgl').value;
    jum=document.getElementById('jum').value;


    method=document.getElementById('method').value;
    param='method='+method+'&faktur='+faktur+'&cabang='+cabang+'&brg='+brg+'&qty='+qty+'&tgl='+tgl+'&harga='+harga+'&jum='+jum;
    tujuan='jr_slave_trx_atk.php';
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
                   cancelIsidetail();
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


function loadDatadetail(num){

    faktur=document.getElementById('faktur').value;
    cabang=document.getElementById('cabang').value; 
    param='method=loadDatadetail'+'&faktur='+faktur+'&cabang='+cabang;
    tujuan='jr_slave_trx_atk.php';
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


function loadData(num){

    param='method=loadData';
    tujuan='jr_slave_trx_atk.php';
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

function edit(faktur,cabang,createtime)
{

  document.getElementById('headerlist').style.display="none";
  document.getElementById('header').style.display="block";
  document.getElementById('detail').style.display="block";
  document.getElementById('detaillist').style.display="block";


    document.getElementById('faktur').value=faktur;
    document.getElementById('cabang').value=cabang;
    document.getElementById('tgl').value=createtime;
    loadDatadetail();


}

function  editdetail(barang,harga,qty,jumrp)
{

  document.getElementById('method').value='updatedetail';

  document.getElementById('brg').value=barang;
  document.getElementById('brg').disabled=true;
  document.getElementById('harga').value=harga;
  document.getElementById('qty').value=qty;
  document.getElementById('jum').value=jumrp;



}

function  cancelIsi()

{

    document.getElementById('faktur').value='';
    document.getElementById('cabang').value='';
    document.getElementById('brg').value='';
    document.getElementById('harga').value='';
    document.getElementById('qty').value='';
    document.getElementById('tgl').value='';
    document.getElementById('jum').value='';
    document.getElementById('method').value='insert';
 

}


function  cancelIsidetail()

{



    document.getElementById('brg').value='';
    document.getElementById('harga').value='0';
    document.getElementById('qty').value='0';
    document.getElementById('jum').value='0';
    document.getElementById('brg').disabled=false;

    document.getElementById('method').value='insert';
 

}





function hapus(faktur,nourut)
{
    fileTarget='jr_slave_trx_atk';
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
    if(confirm('Hapus data Transaksi '+faktur+'?'))post_response_text(fileTarget+'.php', param, respon);
}

function hapushead(faktur)
{
    fileTarget='jr_slave_trx_atk';
    param='faktur='+faktur+'&method=deletehead';
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
    if(confirm('Hapus data Transaksi '+faktur+'?'))post_response_text(fileTarget+'.php', param, respon);
}

/*function upload()
{ 
    window.location = 'import_csv/form.php?'; 
}
*/

function getjum()
{
   
   qty=remove_comma_var(document.getElementById('qty').value);
   harga=remove_comma_var(document.getElementById('harga').value);

   jumlah=qty*harga;
   document.getElementById('jum').value=jumlah;


}

function saveall(faktur)
{
    fileTarget='jr_slave_trx_atk';
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
    if(confirm('Apakah  data Dengan '+faktur+' Sudah Benar? Jumlah Barang akan Mengurangi stock'))post_response_text(fileTarget+'.php', param, respon);
}
