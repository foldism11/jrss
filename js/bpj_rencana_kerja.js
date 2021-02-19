
//harian

function buatbaruharian()
{
 
     document.getElementById('indexharian').style.display="block";
     document.getElementById('headerharian').style.display="block";
     document.getElementById('detailharian').style.display="none";
     document.getElementById('listheaderharian').style.display="none";
     document.getElementById('listdetailharian').style.display="none";
     document.getElementById('nokontrakhr').disabled = false;

}

function listdataharian()
{
 
     document.getElementById('indexharian').style.display="block";
     document.getElementById('headerharian').style.display="none";
     document.getElementById('detailharian').style.display="none";
     document.getElementById('listheaderharian').style.display="block";
     document.getElementById('listdetailharian').style.display="none";

     document.getElementById('nokontrakhr').value = '';
     document.getElementById('judulhr').value = '';
     document.getElementById('pbjhr').value = '';
     document.getElementById('tanggalhr').value = '';
     document.getElementById('lokasihr').value = '';

     loadDatahr();
}


function cancelhr()
{
 
    listdataharian();

}

function getharian()
{


	nokontrak=document.getElementById('nokontrakhr').value;
    method='getharian';

    tujuan='bpj_slave_rencana_kerja.php';
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

                    isdt = con.responseText.split("##");
                   
                    document.getElementById('judulhr').value=isdt[0];
                    document.getElementById('pbjhr').innerHTML=isdt[1];
                    document.getElementById('lokasihr').value=isdt[2];
					document.getElementById('tkhr').innerHTML=isdt[3];
                     //loadDatadetailhr(nokontrak);
				
					
				}
			}
			else {
				busy_off();
				error_catch(con.status);
			}
		}
	}		

}



function lanjutharianht()
{
    nokontrakhr=document.getElementById('nokontrakhr').value;
    judulhr=document.getElementById('judulhr').value;
    pbjhr=document.getElementById('pbjhr').value;
    tanggalhr=document.getElementById('tanggalhr').value;
    lokasihr=document.getElementById('lokasihr').value;

    if (nokontrakhr=='') {
        alert('No Kontrak Kosong..');
        return;
    }

    if (judulhr=='') {
        alert('Judul Kosong..');
        return;
    }

    if (pbjhr=='') {
        alert('PBJ Kosong..');
        return;
    }

    if (tanggalhr=='') {
        alert('Tanggal Kosong..');
        return;
    }

    if (lokasihr=='') {
        alert('Lokasi Kosong..');
        return;
    }

     document.getElementById('indexharian').style.display="block";
     document.getElementById('headerharian').style.display="block";
     document.getElementById('detailharian').style.display="block";
     document.getElementById('listheaderharian').style.display="none";
     document.getElementById('listdetailharian').style.display="block";

      getnotranshr(nokontrakhr);




}


function getnotranshr(nokontrakhr)
{


    //nokontrak=document.getElementById('nokontrakmg').value;
    method='getnotranshr';

    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&nokontrak='+nokontrakhr;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                   
                
                    document.getElementById('notranshr').value=con.responseText;
                    
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}



function simpanhr()
{

    notransaksi=document.getElementById('notranshr').value;
	nokontrak=document.getElementById('nokontrakhr').value;
	judul=document.getElementById('judulhr').value;
	pbj=document.getElementById('pbjhr').value;
    tanggal = document.getElementById('tanggalhr').value;
    lokasi=document.getElementById('lokasihr').value;


    keg=document.getElementById('keghr').value;
    tk=document.getElementById('tkhr').value;
    mat=document.getElementById('mathr').value;
    alat=document.getElementById('alathr').value;
    ket=document.getElementById('kethr').value;
    method=document.getElementById('methodhr').value;



    tujuan='bpj_slave_rencana_kerja.php';
	param='method='+method+'&nokontrak='+nokontrak+'&judul='+judul+'&pbj='+pbj+'&tanggal='+tanggal+'&lokasi='+lokasi+'&keg='+keg+'&notransaksi='+notransaksi;
	param+='&tk='+tk+'&mat='+mat+'&alat='+alat+'&ket='+ket;
	post_response_text(tujuan, param, respog);
	function respog(){
		if (con.readyState == 4) {
			if (con.status == 200) {
				busy_off();
				if (!isSaveResponse(con.responseText)) {
					alert('ERROR TRANSACTION,\n' + con.responseText);
				}
				else {
                   
                   	loadDatadetailhr(notransaksi);
                    cancelisihr();
					
					alert('Done.');
				}
			}
			else {
				busy_off();
				error_catch(con.status);
			}
		}
	}		


}

function loadDatadetailhr(notransaksi){

    param='method=loadDatadetailhr'+'&notransaksi='+notransaksi;
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerhariandt').innerHTML = con.responseText;
                      getharian();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}

function loadDatahr(num){

    param='method=loadDatahr';
    tujuan='bpj_slave_rencana_kerja.php';

    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerharianht').innerHTML = con.responseText;
                   loadDatamg();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function cancelisihr()
{
    document.getElementById('keghr').value='';
    document.getElementById('keghr').disabled=false;
    document.getElementById('tkhr').value='';
    document.getElementById('tkhr').disabled=false;
    document.getElementById('mathr').value='';
    document.getElementById('alathr').value='';
    document.getElementById('kethr').value='';
    document.getElementById('methodhr').value='inserthr';

}


function edithr(notransaksi,nokontrak,judul,pbj,tanggal,lokasi)
{

    document.getElementById('notranshr').value=notransaksi;
    document.getElementById('nokontrakhr').value=nokontrak;
    document.getElementById('nokontrakhr').disabled=true;

    document.getElementById('tanggalhr').value=tanggal;
   
   

     document.getElementById('indexharian').style.display="block";
     document.getElementById('headerharian').style.display="block";
     document.getElementById('detailharian').style.display="block";
     document.getElementById('listheaderharian').style.display="none";
     document.getElementById('listdetailharian').style.display="block";

     loadDatadetailhr(notransaksi);


}

function editdethr(nokontrak,kegiatan,tk,material,peralatan,ket)
{


    document.getElementById('keghr').value=kegiatan;
    document.getElementById('keghr').disabled=true;
    document.getElementById('tkhr').value=tk;
    document.getElementById('tkhr').disabled=true;
    document.getElementById('mathr').value=material;
    document.getElementById('alathr').value=peralatan;
    document.getElementById('kethr').value=ket;
    document.getElementById('methodhr').value='updatehr';
   



}


function hapusdethr(notransaksi,keg,tk)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='method=deletedethr'+'&keg='+keg+'&tk='+tk+'&notransaksi='+notransaksi;

    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetailhr(notransaksi);
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}


function hapushr(notransaksi)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='notransaksi='+notransaksi+'&method=deletehr';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatahr();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}


function pdfhr(notransaksi,ev) 
{    param = 'method=pdfhr' + '&notransaksi=' + notransaksi;
    tujuan = 'bpj_slave_rencana_kerja.php';
    title = 'Report Excel';
    printFile(param, tujuan, title, ev);
}

function printFile(param, tujuan, title, ev) {
    tujuan = tujuan + "?" + param;
    width = '';
    height = '500';
    content = "<iframe frameborder=0 width=100% height=100% src='" + tujuan + "'></iframe>"
        showDialog2(title, content, width, height, ev);
}


///////////////////tutup harian/////////////////////////////

///////////////////Mingguan/////////////////////////////
function buatbarumingguan()
{
 
     document.getElementById('indexmingguan').style.display="block";
     document.getElementById('headermingguan').style.display="block";
     document.getElementById('detailmingguan').style.display="none";
     document.getElementById('listheadermingguan').style.display="none";
     document.getElementById('listdetailmingguan').style.display="none";
     document.getElementById('nokontrakmg').disabled = false;

}

function listdatamingguan()
{
 
     document.getElementById('indexmingguan').style.display="block";
     document.getElementById('headermingguan').style.display="none";
     document.getElementById('detailmingguan').style.display="none";
     document.getElementById('listheadermingguan').style.display="block";
     document.getElementById('listdetailmingguan').style.display="none";

     document.getElementById('nokontrakmg').value = '';
     document.getElementById('judulmg').value = '';
     document.getElementById('pbjmg').value = '';
     document.getElementById('tanggalmg').value = '';
     document.getElementById('lokasimg').value = '';

     loadDatamg();



}


function getmingguan()
{


    nokontrak=document.getElementById('nokontrakmg').value;
    method='getmingguan';

    tujuan='bpj_slave_rencana_kerja.php';
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

                    isdt = con.responseText.split("##");
                
                    document.getElementById('judulmg').value=isdt[0];
                    document.getElementById('pbjmg').innerHTML=isdt[1];
                    document.getElementById('lokasimg').value=isdt[2];
                    document.getElementById('uraian').innerHTML=isdt[3];
                    document.getElementById('nilaikontrak').value=isdt[4];
                     //loadDatadetailhr(nokontrak);
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}


function lanjutmingguanht()
{
    nokontrakmg=document.getElementById('nokontrakmg').value;
    judulmg=document.getElementById('judulmg').value;
    pbjmg=document.getElementById('pbjmg').value;
    tanggalmg=document.getElementById('tanggalmg').value;
    lokasimg=document.getElementById('lokasimg').value;
    mingguke=document.getElementById('mingguke').value;

    if (nokontrakmg=='') {
        alert('No Kontrak Kosong..');
        return;
    }

    if (judulmg=='') {
        alert('Judul Kosong..');
        return;
    }

    if (pbjmg=='') {
        alert('PBJ Kosong..');
        return;
    }

    if (tanggalmg=='') {
        alert('Tanggal Kosong..');
        return;
    }

    if (lokasimg=='') {
        alert('Lokasi Kosong..');
        return;
    }

    if (mingguke=='') {
        alert('Minggu Ke Kosong..');
        return;
    }

     document.getElementById('indexmingguan').style.display="block";
     document.getElementById('headermingguan').style.display="block";
     document.getElementById('detailmingguan').style.display="block";
     document.getElementById('listheadermingguan').style.display="none";
     document.getElementById('listdetailmingguan').style.display="block";

     getnotransmg(nokontrakmg);


}

function getnotransmg(nokontrakmg)
{


    //nokontrak=document.getElementById('nokontrakmg').value;
    method='getnotransmg';

    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&nokontrak='+nokontrakmg;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                    isdt = con.responseText.split("##");
                
                    document.getElementById('notransmg').value=con.responseText;
                    
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}

function getjummg()
{

    vol=remove_comma_var(document.getElementById('vol').value);
    harsat=remove_comma_var(document.getElementById('harsat').value);
    nilaikontrak=remove_comma_var(document.getElementById('nilaikontrak').value);

  
   
    jumlah=vol*harsat;
    bobot=jumlah*100/nilaikontrak;
  

    document.getElementById('jum').value=jumlah;
    document.getElementById('bobot').value=bobot.toFixed(0);
  
    

}


function getharsat()
{

    uraian=document.getElementById('uraian').value;
    nokontrakmg=document.getElementById('nokontrakmg').value;
    notransaksi=document.getElementById('notransmg').value;

    param='uraian='+uraian+'&nokontrak='+nokontrakmg+'&notransaksi='+notransaksi+'&method=getharsat';
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                    document.getElementById('harsat').value = con.responseText;
                   

       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
   

    

}


function simpanmg()
{

    notransaksi=document.getElementById('notransmg').value;
    nokontrak=document.getElementById('nokontrakmg').value;
    judul=document.getElementById('judulmg').value; 
    pbj=document.getElementById('pbjmg').value;
    tanggal = document.getElementById('tanggalmg').value;
    lokasi=document.getElementById('lokasimg').value;
    mingguke=document.getElementById('mingguke').value;


    uraian=document.getElementById('uraian').value;
    harsat=document.getElementById('harsat').value;
    vol=document.getElementById('vol').value;
    jum=document.getElementById('jum').value;
    bobot=document.getElementById('bobot').value;
    method=document.getElementById('methodmg').value;;



    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&notransaksi='+notransaksi+'&nokontrak='+nokontrak+'&judul='+judul+'&pbj='+pbj+'&tanggal='+tanggal+'&lokasi='+lokasi+'&mingguke='+mingguke;
    param+='&uraian='+uraian+'&harsat='+harsat+'&vol='+vol+'&jum='+jum+'&bobot='+bobot;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {
                    isdt = con.responseText.split("##");
                    nokontrak=isdt[0];
                    noamandemen=isdt[1];
                    
                   
                    loadDatadetailmg(notransaksi);
                    cancelisimg();
                    
                    alert('Done.');
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       


}

function loadDatadetailmg(notransaksi){

    param='method=loadDatadetailmg'+'&notransaksi='+notransaksi;
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containermingguandt').innerHTML = con.responseText;
                         getmingguan();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}




function loadDatamg(num){

    param='method=loadDatamg';
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containermingguanht').innerHTML = con.responseText;
                    //loadDataminggu();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function cancelmg()
{
    document.getElementById('uraian').value='';
    document.getElementById('harsat').value=0;
    document.getElementById('harsat').disabled=true;
    document.getElementById('vol').value=0;
    document.getElementById('jum').value=0;
    document.getElementById('jum').disabled=true;
    document.getElementById('bobot').value=0;
    document.getElementById('bobot').disabled=true;
    document.getElementById('methodmg').value='insertmg';

}


function editmg(notransaksi,nokontrak,judul,pbj,tanggal,lokasi,mingguke)
{
   
    document.getElementById('notransmg').value=notransaksi;
    document.getElementById('notransmg').disabled=true;
    document.getElementById('nokontrakmg').value=nokontrak;
    document.getElementById('nokontrakmg').disabled=true;
    document.getElementById('tanggalmg').value=tanggal;
    document.getElementById('mingguke').value=mingguke;
   


     document.getElementById('indexmingguan').style.display="block";
     document.getElementById('headermingguan').style.display="block";
     document.getElementById('detailmingguan').style.display="block";
     document.getElementById('listheadermingguan').style.display="none";
     document.getElementById('listdetailmingguan').style.display="block";

     loadDatadetailmg(notransaksi);


}

function editdetmg(notransaksi,item,vol,jum,bobot)
{


    document.getElementById('uraian').value=item;
    document.getElementById('uraian').disabled=true;
    document.getElementById('vol').value=vol;
    document.getElementById('jum').value=jum;
    document.getElementById('bobot').value=bobot;
    document.getElementById('methodmg').value='updatemg';
    getharsat();
   



}


function hapusdetmg(notransaksi,item)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='method=deletedetmg'+'&notransaksi='+notransaksi+'&uraian='+item;
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetailmg(notransaksi);
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}



function hapusmg(notransaksi)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='notransaksi='+notransaksi+'&method=deletemg';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatamg();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}


function pdfmg(notransaksi,ev) 
{    param = 'method=pdfmg' + '&notransaksi=' + notransaksi;
    tujuan = 'bpj_slave_rencana_kerja.php';
    title = 'Report Excel';
    printFile(param, tujuan, title, ev);
}

function printFile(param, tujuan, title, ev) {
    tujuan = tujuan + "?" + param;
    width = '';
    height = '500';
    content = "<iframe frameborder=0 width=100% height=100% src='" + tujuan + "'></iframe>"
        showDialog2(title, content, width, height, ev);
}


///////////////////Tutup Mingguan/////////////////////////////



/////////////////// Bulanan/////////////////////////////

function buatbarubulanan()
{
 
     document.getElementById('indexbulanan').style.display="block";
     document.getElementById('headerbulanan').style.display="block";
     document.getElementById('detailbulanan').style.display="none";
     document.getElementById('listheaderbulanan').style.display="none";
     document.getElementById('listdetailbulanan').style.display="none";
     document.getElementById('nokontrakbl').disabled = false;

}

function listdatabulanan()
{
 
     document.getElementById('indexbulanan').style.display="block";
     document.getElementById('headerbulanan').style.display="none";
     document.getElementById('detailbulanan').style.display="none";
     document.getElementById('listheaderbulanan').style.display="block";
     document.getElementById('listdetailbulanan').style.display="none";

     document.getElementById('nokontrakbl').value = '';
     document.getElementById('judulbl').value = '';
     document.getElementById('pbjbl').value = '';
     document.getElementById('tanggalbl').value = '';
     document.getElementById('lokasibl').value = '';

     loadDatabl();



}


function getbulanan()
{


    nokontrak=document.getElementById('nokontrakbl').value;
    method='getbulanan';

    tujuan='bpj_slave_rencana_kerja.php';
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

                    isdt = con.responseText.split("##");
                
                    document.getElementById('judulbl').value=isdt[0];
                    document.getElementById('pbjbl').innerHTML=isdt[1];
                    document.getElementById('lokasibl').value=isdt[2];
                    document.getElementById('uraianbl').innerHTML=isdt[3];
                    document.getElementById('nilaikontrakbl').value=isdt[4];
                     //loadDatadetailbl(nokontrak);
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}


function lanjutbulananht()
{
    nokontrakbl=document.getElementById('nokontrakbl').value;
    judulbl=document.getElementById('judulbl').value;
    pbjbl=document.getElementById('pbjbl').value;
    tanggalbl=document.getElementById('tanggalbl').value;
    lokasibl=document.getElementById('lokasibl').value;


    if (nokontrakbl=='') {
        alert('No Kontrak Kosong..');
        return;
    }

    if (judulbl=='') {
        alert('Judul Kosong..');
        return;
    }

    if (pbjbl=='') {
        alert('PBJ Kosong..');
        return;
    }

    if (tanggalbl=='') {
        alert('Tanggal Kosong..');
        return;
    }

    if (lokasibl=='') {
        alert('Lokasi Kosong..');
        return;
    }


     document.getElementById('indexbulanan').style.display="block";
     document.getElementById('headerbulanan').style.display="block";
     document.getElementById('detailbulanan').style.display="block";
     document.getElementById('listheaderbulanan').style.display="none";
     document.getElementById('listdetailbulanan').style.display="block";

     getnotransbl(nokontrakbl);


}

function getnotransbl(nokontrakbl)
{


    //nokontrak=document.getElementById('nokontrakmg').value;
    method='getnotransbl';

    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&nokontrak='+nokontrakbl;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                    isdt = con.responseText.split("##");
                
                    document.getElementById('notransbl').value=con.responseText;
                    detailbulan(nokontrakbl);
                    
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}


function detailbulan(nokontrakbl)
{


    notransaksi=document.getElementById('notransbl').value;
    method='detailbulan';

    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&nokontrak='+nokontrakbl+'&notransaksi='+notransaksi;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {

                
                    document.getElementById('detailbulan').innerHTML=con.responseText;
                
                    
                
                    
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       

}

function save(maxRow){     
    maxf=maxRow;
    loopsave(1,maxRow);
}

function loopsave(currRow,maxRow){
    notransaksi=document.getElementById('notransbl').value;
    nokontrak=document.getElementById('nokontrakbl').value;
    judul=document.getElementById('judulbl').value; 
    pbj=document.getElementById('pbjbl').value;
    tanggal = document.getElementById('tanggalbl').value;
    lokasi=document.getElementById('lokasibl').value;
    method=document.getElementById('methodbl').value;


    kegiatan=document.getElementById('kegiatanx'+currRow).value;
    vol=document.getElementById('vol'+currRow).value;
    satuan=document.getElementById('satuan'+currRow).value;
    jum=document.getElementById('jum'+currRow).value;
    bobot=document.getElementById('bobot'+currRow).value;

    param='method='+method+'&notransaksi='+notransaksi+'&nokontrak='+nokontrak+'&judul='+judul+'&pbj='+pbj+'&tanggal='+tanggal+'&lokasi='+lokasi;
    param+='&kegiatan='+kegiatan+'&satuan='+satuan+'&vol='+vol+'&jum='+jum+'&bobot='+bobot;
            tujuan = 'bpj_slave_rencana_kerja.php';
            post_response_text(tujuan, param, respog);
            document.getElementById('row'+currRow).style.backgroundColor='cyan';
            //lockScreen('wait');
 
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                    unlockScreen();
                } else {
                    currRow+=1;
                    sekarang=currRow;
                    if(currRow>maxRow){
                        alert('Done');
                        loadDatadetailbl(notransaksi);
                        cancelisibl();
                    } else {
                        loopsave(currRow,maxRow);
                    }
                }
            } else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       
}

function getjumbl()
{

    vol=remove_comma_var(document.getElementById('volbl').value);
    harsat=remove_comma_var(document.getElementById('harsatbl').value);
    nilaikontrak=remove_comma_var(document.getElementById('nilaikontrakbl').value);

  
   
    jumlah=vol*harsat;
    bobot=jumlah*100/nilaikontrak;
  

    document.getElementById('jumbl').value=jumlah;
    document.getElementById('bobotbl').value=bobot.toFixed(0);
  
    

}


function getharsatbl()
{

    uraian=document.getElementById('uraianbl').value;
    nokontrakbl=document.getElementById('nokontrakbl').value;

    param='uraian='+uraian+'&nokontrak='+nokontrakbl+'&method=getharsatbl';
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                    document.getElementById('harsatbl').value = con.responseText;
                   

       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
   

    

}


/*function simpanbl()
{

    notransaksi=document.getElementById('notransbl').value;
    nokontrak=document.getElementById('nokontrakbl').value;
    judul=document.getElementById('judulbl').value; 
    pbj=document.getElementById('pbjbl').value;
    tanggal = document.getElementById('tanggalbl').value;
    lokasi=document.getElementById('lokasibl').value;
    bulanke=document.getElementById('bulanke').value;


    uraian=document.getElementById('uraianbl').value;
    harsat=document.getElementById('harsatbl').value;
    vol=document.getElementById('volbl').value;
    jum=document.getElementById('jumbl').value;
    bobot=document.getElementById('bobotbl').value;
    method=document.getElementById('methodbl').value;;



    tujuan='bpj_slave_rencana_kerja.php';
    param='method='+method+'&notransaksi='+notransaksi+'&nokontrak='+nokontrak+'&judul='+judul+'&pbj='+pbj+'&tanggal='+tanggal+'&lokasi='+lokasi+'&bulanke='+bulanke;
    param+='&uraian='+uraian+'&harsat='+harsat+'&vol='+vol+'&jum='+jum+'&bobot='+bobot;
    post_response_text(tujuan, param, respog);
    function respog(){
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }
                else {
                    isdt = con.responseText.split("##");
                    nokontrak=isdt[0];
                    noamandemen=isdt[1];
                    
                   
                    loadDatadetailbl(notransaksi);
                    cancelisibl();
                    
                    alert('Done.');
                }
            }
            else {
                busy_off();
                error_catch(con.status);
            }
        }
    }       


}*/

function loadDatadetailbl(notransaksi){

    param='method=loadDatadetailbl'+'&notransaksi='+notransaksi;
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerbulanandt').innerHTML = con.responseText;
                         getbulanan();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}




function loadDatabl(num){

    param='method=loadDatabl';
    tujuan='bpj_slave_rencana_kerja.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerbulananht').innerHTML = con.responseText;
                    //loadDataminggu();
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}


function cancelbl()
{
    document.getElementById('uraianbl').value='';
    document.getElementById('harsatbl').value=0;
    document.getElementById('harsatbl').disabled=true;
    document.getElementById('volbl').value=0;
    document.getElementById('jumbl').value=0;
    document.getElementById('jumbl').disabled=true;
    document.getElementById('bobotbl').value=0;
    document.getElementById('bobotbl').disabled=true;
    document.getElementById('methodbl').value='insertbl';

}


function editbl(notransaksi,nokontrak,judul,pbj,tanggal,lokasi,bulanke)
{
   
    document.getElementById('notransbl').value=notransaksi;
    document.getElementById('notransbl').disabled=true;
    document.getElementById('nokontrakbl').value=nokontrak;
    document.getElementById('nokontrakbl').disabled=true;
    document.getElementById('tanggalbl').value=tanggal;
    document.getElementById('bulanke').value=bulanke;
   


     document.getElementById('indexbulanan').style.display="block";
     document.getElementById('headerbulanan').style.display="block";
     document.getElementById('detailbulanan').style.display="block";
     document.getElementById('listheaderbulanan').style.display="none";
     document.getElementById('listdetailbulanan').style.display="block";

     loadDatadetailbl(notransaksi);


}

function editdetbl(notransaksi,nokontrak,item,vol,jum,bobot)
{


    document.getElementById('uraianbl').value=item;
    document.getElementById('uraianbl').disabled=true;
    document.getElementById('volbl').value=vol;
    document.getElementById('jumbl').value=jum;
    document.getElementById('bobotbl').value=bobot;
    document.getElementById('methodbl').value='updatebl';
    getharsatbl();
   



}


function hapusdetbl(notransaksi,nokontrak,item)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='nokontrak='+nokontrak+'&method=deletedetbl'+'&notransaksi='+notransaksi+'&uraian='+item;
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetailbl(notransaksi);
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}



function hapusbl(notransaksi)
{
    fileTarget='bpj_slave_rencana_kerja';
    param='notransaksi='+notransaksi+'&method=deletebl';
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatabl();
                   
                }
            } 
            else 
            {
                busy_off();
                error_catch(con.status);
            }
        }
    }
    if(confirm('Hapus data ?'))post_response_text(fileTarget+'.php', param, respon);
}

