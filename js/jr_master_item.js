function simpan()
{

    id=document.getElementById('id').value;
    nama=document.getElementById('nama').value;
    satuan=document.getElementById('satuan').value;
    cabang=document.getElementById('cabang').value;
    ket=document.getElementById('ket').value;
    status=document.getElementById('status').value;
    konv=document.getElementById('konv').value;
    min=document.getElementById('min').value;
    max=document.getElementById('max').value;
    retur=document.getElementById('retur').value;
    maxord=document.getElementById('maxord').value;
    minord=document.getElementById('minord').value;


    method=document.getElementById('method').value;
    param='method='+method+'&satuan='+satuan+'&nama='+nama+'&cabang='+cabang+'&ket='+ket+'&status='+status+'&id='+id+'&konv='+konv+'&min='+min+'&max='+max+'&retur='+retur+'&maxord='+maxord+'&minord='+minord;
    tujuan='jr_slave_master_item.php';
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
    tujuan='jr_slave_master_item.php';
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

function edit(id,nama,satuan,cabang,ket,status,konv,min,max,retur,maxord,minord)
{
    document.getElementById('id').value=id;
    document.getElementById('nama').value=nama;
    document.getElementById('satuan').value=satuan;
    document.getElementById('cabang').value=cabang;
    document.getElementById('ket').value=ket;
    document.getElementById('status').value=status;
    document.getElementById('konv').value=konv;
    document.getElementById('min').value=min;
    document.getElementById('max').value=max;
    document.getElementById('retur').value=retur;
    document.getElementById('maxord').value=maxord;
    document.getElementById('minord').value=minord;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('satuan').value='';
    document.getElementById('nama').value='';
    document.getElementById('cabang').value='';
    document.getElementById('ket').value='';
    document.getElementById('status').value='';
    document.getElementById('id').value='';
    document.getElementById('konv').value='';
    document.getElementById('min').value='';
    document.getElementById('max').value='';
    document.getElementById('retur').value='';
    document.getElementById('maxord').value='';
    document.getElementById('minord').value='';
    document.getElementById('method').value='insert';
 

}