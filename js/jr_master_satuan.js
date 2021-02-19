function simpan()
{

    nama=document.getElementById('nama').value;
    ket=document.getElementById('ket').value;
    status=document.getElementById('status').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&nama='+nama+'&ket='+ket+'&status='+status;

    tujuan='jr_slave_master_satuan.php';
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
    tujuan='jr_slave_master_satuan.php';
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

function edit(nama,ket,status)
{

    document.getElementById('nama').value=nama;
    document.getElementById('nama').disabled=true;
    document.getElementById('ket').value=ket;
    document.getElementById('status').value=status;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{

    document.getElementById('nama').value='';
    document.getElementById('ket').value='';
    document.getElementById('status').value='';
    document.getElementById('nama').disabled=false;
     document.getElementById('method').value='insert';

}