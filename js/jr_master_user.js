function simpan()
{
    id=document.getElementById('id').value;
    nama=document.getElementById('nama').value;
    pass=document.getElementById('pass').value;
    cabang=document.getElementById('cabang').value;
    ket=document.getElementById('ket').value;
    status=document.getElementById('status').value;
    tipe=document.getElementById('tipe').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&pass='+pass+'&nama='+nama+'&cabang='+cabang+'&ket='+ket+'&status='+status+'&id='+id+'&tipe='+tipe;

    tujuan='jr_slave_master_user.php';
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
    tujuan='jr_slave_master_user.php';
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

function edit(nama,pass,cabang,ket,status,id,tipe)
{
    document.getElementById('pass').value=pass;
    document.getElementById('nama').value=nama;
    document.getElementById('cabang').value=cabang;
    document.getElementById('ket').value=ket;
    document.getElementById('status').value=status;
    document.getElementById('id').value=id;
    document.getElementById('tipe').value=tipe;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('pass').value='';
    document.getElementById('nama').value='';
    document.getElementById('cabang').value='';
    document.getElementById('ket').value='';
    document.getElementById('status').value='';
    document.getElementById('id').value='';
    document.getElementById('tipe').value='';
    document.getElementById('method').value='insert';

}