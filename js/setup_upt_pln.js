function simpan()
{
    id=document.getElementById('id').value;
    nama=document.getElementById('nama').value;
    email=document.getElementById('email').value;
    tlpn=document.getElementById('tlpn').value;
    status=document.getElementById('status').value;
    propinsi=document.getElementById('propinsi').value;
    pos=document.getElementById('pos').value;
    kota=document.getElementById('kota').value;
    alamat=document.getElementById('alamat').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&id='+id+'&nama='+nama+'&email='+email+'&status='+status+'&tlpn='+tlpn+'&propinsi='+propinsi+'&pos='+pos+'&kota='+kota+'&alamat='+alamat;

    tujuan='setup_slave_upt_pln.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                    loadData();
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


function loadData(num){

    param='method=loadData';
    tujuan='setup_slave_upt_pln.php';
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

function edit(id,nama,email,tlpn,pos,propinsi,kota,alamat,status)
{
    

    document.getElementById('id').value=id;
    document.getElementById('nama').value=nama;
    document.getElementById('email').value=email;
    document.getElementById('tlpn').value=tlpn;
    document.getElementById('status').value=status;
    document.getElementById('propinsi').value=propinsi;
    document.getElementById('pos').value=pos;
    document.getElementById('kota').value=kota;
    document.getElementById('alamat').value=alamat;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('id').value='';
    document.getElementById('nama').value='';
    document.getElementById('email').value='';
    document.getElementById('tlpn').value='';
    document.getElementById('status').value='';
    document.getElementById('propinsi').value='';
    document.getElementById('pos').value='';
    document.getElementById('kota').value='';
    document.getElementById('alamat').value='';

}