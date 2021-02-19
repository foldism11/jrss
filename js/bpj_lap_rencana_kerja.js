// harian
function preview(){

    nokontrak=document.getElementById('nokontrak').value;
    noba=document.getElementById('noba').value;
    hari=document.getElementById('hari').value;
    var tanggalx = document.getElementById('reservation').value;
    var tanggal = tanggalx.substr(0,10);
    var tanggal2 = tanggalx.substr(12,11);

    param='method=loadData'+'&nokontrak='+nokontrak+'&noba='+noba+'&hari='+hari+'&tanggal='+tanggal+'&tanggal2='+tanggal2;
    tujuan='bpj_slave_lap_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    
                    isdt = con.responseText.split("##");
                    document.getElementById('counter').innerHTML = isdt[0];
                    document.getElementById('counterx').innerHTML = isdt[1];
                   
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}



function getba()
{

    nokontrak=document.getElementById('nokontrak').value;
    method='getba';

    tujuan='bpj_slave_lap_rencana_kerja.php';
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
                   
                    document.getElementById('noba').innerHTML=con.responseText;
                    document.getElementById('noba').disabled=false;
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}