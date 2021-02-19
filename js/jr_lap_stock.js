function tampilkan(tipe){

    cabang=document.getElementById('cabang').value;
    //supp=document.getElementById('supp').value;
    brg=document.getElementById('brg').value;
    
    param='method=tampilkan'+'&brg='+brg+'&cabang='+cabang/*+'&supp='+supp*/;
    tujuan='jr_slave_lap_stock.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('container').innerHTML = con.responseText;
                     //cancelIsidetail();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}
