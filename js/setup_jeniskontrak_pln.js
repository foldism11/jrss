function simpan()
{
    idkontrak=document.getElementById('idkontrak').value;
    jnskontrak=document.getElementById('jnskontrak').value;
    ket=document.getElementById('ket').value;
    status=document.getElementById('status').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&idkontrak='+idkontrak+'&jnskontrak='+jnskontrak+'&ket='+ket+'&status='+status;

    tujuan='setup_slave_jeniskontrak_pln.php';
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
    tujuan='setup_slave_jeniskontrak_pln.php';
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

function edit(idkontrak,jnskontrak,ket,status)
{
    document.getElementById('idkontrak').value=idkontrak;
    document.getElementById('jnskontrak').value=jnskontrak;
    document.getElementById('ket').value=ket;
    document.getElementById('status').value=status;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('idkontrak').value='';
    document.getElementById('jnskontrak').value='';
    document.getElementById('ket').value='';
    document.getElementById('status').value='';

}