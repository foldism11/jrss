function simpan()
{
    password=document.getElementById('password').value;
    nama=document.getElementById('nama').value;
    email=document.getElementById('email').value;
    hak=document.getElementById('hak').value;
    status=document.getElementById('status').value;
    pos=document.getElementById('kodepos').value;
    kota=document.getElementById('kota').value;
    alamat=document.getElementById('alamat').value;

    
    method=document.getElementById('method').value;
    param='method='+method+'&password='+password+'&nama='+nama+'&email='+email+'&status='+status+'&hak='+hak+'&pos='+pos+'&kota='+kota+'&alamat='+alamat;

    tujuan='setup_slave_user_pln.php';
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
    tujuan='setup_slave_user_pln.php';
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

/*function edit(nama,password,hak,kodepos,kota,email,alamat,status)
{
    

    document.getElementById('password').value=password;
    document.getElementById('nama').value=nama;
    document.getElementById('email').value=email;
    document.getElementById('hak').value=hak;
    document.getElementById('status').value=status;
    document.getElementById('kodepos').value=pos;
    document.getElementById('kota').value=kota;
    document.getElementById('alamat').value=alamat;
    document.getElementById('method').value='update';


}*/

function edit(nama)
{

    param='nama='+nama+'&method=getdata';
    tujuan='setup_slave_user_pln.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    isdt = con.responseText.split("##");

                    document.getElementById('nama').value = isdt[0];
                    document.getElementById('password').value = isdt[1];
                    document.getElementById('hak').value = isdt[2];
                    document.getElementById('status').value = isdt[3];
                    document.getElementById('kodepos').value = isdt[4];
                    document.getElementById('kota').value = isdt[5];
                    document.getElementById('email').value = isdt[6];
                    document.getElementById('alamat').value = isdt[7];
                    document.getElementById('method').value='update';


       
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
    document.getElementById('password').value='';
    document.getElementById('nama').value='';
    document.getElementById('email').value='';
    document.getElementById('hak').value='';
    document.getElementById('status').value='';
    document.getElementById('pos').value='';
    document.getElementById('kota').value='';
    document.getElementById('alamat').value='';

}

function getuser()
{
    hak=document.getElementById('hak').value;
    param='hak='+hak+'&method=getuser';
    tujuan='setup_slave_user_pln.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('nama').value = con.responseText;
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}
