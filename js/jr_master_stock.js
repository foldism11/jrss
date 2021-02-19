function simpan()
{

    //id=document.getElementById('id').value;
    cabang=document.getElementById('cabang').value;
    supp=document.getElementById('supp').value;
    faktur=document.getElementById('faktur').value;
    tgltiba=document.getElementById('tgltiba').value;
    brg=document.getElementById('brg').value;
    ket=document.getElementById('ket').value;
    pcs=document.getElementById('pcs').value;
    pax=document.getElementById('pack').value;
    harga=document.getElementById('harga').value;
    hargabeli=document.getElementById('hargabeli').value;
    totfax=document.getElementById('totfak').value;




    method=document.getElementById('method').value;
    param='method='+method+'&cabang='+cabang+'&supp='+supp+'&faktur='+faktur+'&tgltiba='+tgltiba+'&brg='+brg+'&ket='+ket+'&pcs='+pcs+'&pax='+pax+'&harga='+harga+'&totfax='+totfax+'&hargabeli='+hargabeli;
    tujuan='jr_slave_master_stock.php';
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
    tujuan='jr_slave_master_stock.php';
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

function edit(cabang,supp,faktur,tgltiba,brg,pcs,pax,harga,totfax,ket,hargabeli)
{
    document.getElementById('cabang').value=cabang;
    document.getElementById('cabang').disabled=true;
    document.getElementById('supp').value=supp;
     document.getElementById('supp').disabled=true;
    document.getElementById('faktur').value=faktur;
    document.getElementById('tgltiba').value=tgltiba;
    document.getElementById('brg').value=brg;
    document.getElementById('brg').disabled=true;
    document.getElementById('ket').value=ket;
    document.getElementById('pcs').value=pcs;
    document.getElementById('pack').value=pax;
    document.getElementById('harga').value=harga;
    document.getElementById('hargabeli').value=hargabeli;
    document.getElementById('totfak').value=totfax;
    document.getElementById('method').value='update';


}

function hapus(cabang,supp,brg)
{
    fileTarget='jr_slave_master_stock';
    param='cabang='+cabang+'&method=delete'+'&supp='+supp+'&brg='+brg;
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadData();
                     cancelIsi();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data '))post_response_text(fileTarget+'.php', param, respon);
}

function  cancelIsi()

{
    document.getElementById('cabang').value='';
     document.getElementById('cabang').disabled=false;
    document.getElementById('supp').value='';
     document.getElementById('supp').disabled=false;
    document.getElementById('faktur').value='';
    document.getElementById('tgltiba').value='';
    document.getElementById('brg').value='';
    document.getElementById('brg').disabled=false;
    document.getElementById('ket').value='';
    document.getElementById('pcs').value='';
    document.getElementById('pack').value='';
    document.getElementById('harga').value='';
    document.getElementById('hargabeli').value='';
    document.getElementById('totfak').value='';
    document.getElementById('method').value='insert';
 

}