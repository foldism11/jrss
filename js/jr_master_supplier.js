function simpan()
{
    id=document.getElementById('id').value;
    nama=document.getElementById('nama').value;
    ket=document.getElementById('ket').value;
    status=document.getElementById('status').value;
    tlp=document.getElementById('tlp').value;
    email=document.getElementById('email').value;
    alamat=document.getElementById('alamat').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&id='+id+'&nama='+nama+'&ket='+ket+'&status='+status+'&tlp='+tlp+'&email='+email+'&alamat='+alamat;

    tujuan='jr_slave_master_supplier.php';
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
    tujuan='jr_slave_master_supplier.php';
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

function edit(id,nama,ket,status,tlp,email,alamat)
{
    document.getElementById('id').value=id;
    document.getElementById('nama').value=nama;
    document.getElementById('ket').value=ket;
    document.getElementById('status').value=status;
    document.getElementById('tlp').value=tlp;
    document.getElementById('email').value=email;
    document.getElementById('alamat').value=alamat;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('id').value='';
    document.getElementById('nama').value='';
    document.getElementById('ket').value='';
    document.getElementById('status').value='';
    document.getElementById('tlp').value='';
    document.getElementById('email').value='';
    document.getElementById('alamat').value='';
    document.getElementById('method').value='insert';

}