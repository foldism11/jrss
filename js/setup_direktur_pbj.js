function simpan()
{
    pbj=document.getElementById('pbj').value;
    nama=document.getElementById('nama').value;
    tlp=document.getElementById('tlp').value;
    email=document.getElementById('email').value;
    alamat=document.getElementById('alamat').value;
    status=document.getElementById('status').value;
    kode=document.getElementById('kode').value;
    
    method=document.getElementById('method').value;
    param='method='+method+'&pbj='+pbj+'&nama='+nama+'&tlp='+tlp+'&email='+email+'&alamat='+alamat+'&status='+status+'&kode='+kode;

    tujuan='setup_slave_direktur_pbj.php';
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
    tujuan='setup_slave_direktur_pbj.php';
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

function edit(kode_dirven,kode_pbj,nama_dirven,telpon_dirven,email_dirven,alamat,status)
{
    document.getElementById('kode').value=kode_dirven;
    document.getElementById('pbj').value=kode_pbj;
    document.getElementById('nama').value=nama_dirven;
    document.getElementById('tlp').value=telpon_dirven;
    document.getElementById('email').value=email_dirven;
    document.getElementById('alamat').value=alamat;
    document.getElementById('status').value=status;
    document.getElementById('method').value='update';


}

function  cancelIsi()

{
    document.getElementById('pbj').value='';
    document.getElementById('nama').value='';
    document.getElementById('tlp').value='';
    document.getElementById('email').value='';
    document.getElementById('alamat').value='';
    document.getElementById('status').value='';
    document.getElementById('kode').value='';
}