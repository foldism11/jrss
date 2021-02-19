function tampilkan(tipe){

    cabang=document.getElementById('cabang').value;
    brg=document.getElementById('brg').value;
    var tanggalx = document.getElementById('reservation').value;
    var tanggal = tanggalx.substr(0,10);
    var tanggal2 = tanggalx.substr(12,11);
    
    param='method=tampilkan'+'&brg='+brg+'&cabang='+cabang+'&tanggal='+tanggal+'&tanggal2='+tanggal2;
    tujuan='jr_slave_lap_jual_barang.php';
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


function lihatDetail(faktur)
{
    form(faktur);
    param = 'faktur=' + faktur+'&method=detail';
    tujuan = 'jr_slave_lap_jual_barang.php';
    post_response_text(tujuan, param, respog);
    function respog()
    {
        if (con.readyState == 4)
        {
            if (con.status == 200)
            {
                busy_off();
                if (!isSaveResponse(con.responseText))
                {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else
                {
                    document.getElementById('containerd').innerHTML = con.responseText;
                   // loadfiles(notrans);
                }
            }
            else
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
}

function form(faktur)
{
    width = '950';
    height = '400';
    //nopp=document.getElementById('nopp_'+id).value;
     content = "<div id=containerd align=center style=\"width=100% height=100% \"></div>";
   // content = "<iframe frameborder=0 width=100% height=100% src='" + tujuan + "'></iframe>"
    ev = 'event';
    title = "Detail Faktur "+faktur;
    showDialog1(title, content, width, height, ev); 
}
