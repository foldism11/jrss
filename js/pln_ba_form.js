

function simpan()
{   
    nokontrak=document.getElementById('nokontrak').value;
    tanggal=document.getElementById('tanggal').value;
    noba=document.getElementById('noba').value;
    jenisba=document.getElementById('jenisba').value;
    sifatba=document.getElementById('sifatba').value;
    method=document.getElementById('methodba').value;


    if (jenisba=='bakp') {
        tanggallkp=document.getElementById('tanggallkp').value;
        persenbakp=document.getElementById('persenbakp').value;
        refkontrakbakp=document.getElementById('refkontrakbakp').value;
        param='tanggallkp='+tanggallkp+'&persenbakp='+persenbakp+'&refkontrakbakp='+refkontrakbakp;
    }

    else if (jenisba=='basp') {
        pasalbasp=document.getElementById('pasalbasp').value;
        tahapbasp=document.getElementById('tahapbasp').value;
        sampaibasp=document.getElementById('sampaibasp').value;
        nominalbasp=remove_comma_var(document.getElementById('nominalbasp').value);
        waktubasp=document.getElementById('waktubasp').value;
        dendabasp=document.getElementById('dendabasp').value;
        waktuterlambatbasp=document.getElementById('waktuterlambatbasp').value;
        persenbasp=document.getElementById('persenbasp').value;
        param='pasalbasp='+pasalbasp+'&tahapbasp='+tahapbasp+'&sampaibasp='+sampaibasp+'&nominalbasp='+nominalbasp+'&waktubasp='+waktubasp+'&dendabasp='+dendabasp+'&waktuterlambatbasp='+waktuterlambatbasp+'&persenbasp='+persenbasp;
    }

    else if (jenisba=='bast') {
        ketpbjbast=document.getElementById('ketpbjbast').value;
        nobaspbast=document.getElementById('nobaspbast').value;
        tanggalbaspbast=document.getElementById('tanggalbaspbast').value;
        param='ketpbjbast='+ketpbjbast+'&nobaspbast='+nobaspbast+'&tanggalbaspbast='+tanggalbaspbast;
    }
    
    else if (jenisba=='bastb') {
        ketpbjbastb=document.getElementById('ketpbjbastb').value;
        nobaspbastb=document.getElementById('nobaspbastb').value;
        tanggalbaspbastb=document.getElementById('tanggalbaspbastb').value;
        param='ketpbjbastb='+ketpbjbastb+'&nobaspbastb='+nobaspbastb+'&tanggalbaspbastb='+tanggalbaspbastb;
    }

    else if (jenisba=='bak') {
        nobappbak=document.getElementById('nobappbak').value;
        tanggalbappbak=document.getElementById('tanggalbappbak').value;
        terlambatbak=document.getElementById('terlambatbak').value;
        persenbak=document.getElementById('persenbak').value;
        param='nobappbak='+nobappbak+'&tanggalbappbak='+tanggalbappbak+'&terlambatbak='+terlambatbak+'&persenbak='+persenbak;
       
    }

    else if (jenisba=='bap') {
       nobakpbap=document.getElementById('nobakpbap').value;
       nobappbap=document.getElementById('nobappbap').value;
       nobakbap=document.getElementById('nobakbap').value;
       persenbap=document.getElementById('persenbap').value;
       terminbap=document.getElementById('terminbap').value;
       persen2bap=document.getElementById('persen2bap').value;
       nominalbap=document.getElementById('nominalbap').value;
       param='nobakpbap='+nobakpbap+'&nobappbap='+nobappbap+'&nobakbap='+nobakbap+'&persenbap='+persenbap+'&terminbap='+terminbap+'&persen2bap='+persen2bap+'&nominalbap='+nominalbap;
    }

    else if (jenisba=='basmp') {
        lamamasabasmp=document.getElementById('lamamasabasmp').value;
        pasalbasmp=document.getElementById('pasalbasmp').value;
        tahapbasmp=document.getElementById('tahapbasmp').value;
        terbayarbasmp=document.getElementById('terbayarbasmp').value;
        param='lamamasabasmp='+lamamasabasmp+'&pasalbasmp='+pasalbasmp+'&tahapbasmp='+tahapbasmp+'&terbayarbasmp='+terbayarbasmp;
    }

    else if (jenisba=='bast_2') {
        ketpbjbast2=document.getElementById('ketpbjbast2').value;
        nobaspbast2=document.getElementById('nobaspbast2').value;
        tanggalbaspbast5=document.getElementById('tanggalbaspbast5').value;
        param='ketpbjbast2='+ketpbjbast2+'&nobaspbast2='+nobaspbast2+'&tanggalbaspbast5='+tanggalbaspbast5;
    }

    else if (jenisba=='baepw') {
        sebabbaepw=document.getElementById('sebabbaepw').value;
        tglevaluasibaepw=document.getElementById('tglevaluasibaepw').value;
        wktperpanjangbaepw=document.getElementById('wktperpanjangbaepw').value;
        mulaibaepw=document.getElementById('mulaibaepw').value;
        batasbaepw=document.getElementById('batasbaepw').value;
        tanggaljaminanbaepw=document.getElementById('tanggaljaminanbaepw').value;
        dendabaepw=document.getElementById('dendabaepw').value;
        urutbaepw=document.getElementById('urutbaepw').value;
        param='sebabbaepw='+sebabbaepw+'&tglevaluasibaepw='+tglevaluasibaepw+'&wktperpanjangbaepw='+wktperpanjangbaepw+'&mulaibaepw='+mulaibaepw+'&batasbaepw='+batasbaepw+'&tanggaljaminanbaepw='+tanggaljaminanbaepw+'&dendabaepw='+dendabaepw+'&urutbaepw='+urutbaepw;
    }

    else if (jenisba=='baetk') {
        suratbaetk=document.getElementById('suratbaetk').value;
        resumebaetk=document.getElementById('resumebaetk').value;
        fcrbaetk=document.getElementById('fcrbaetk').value;
        perhitunganbaetk=document.getElementById('perhitunganbaetk').value;
        evaluasibaetk=document.getElementById('evaluasibaetk').value;
        ppnbaetk=document.getElementById('ppnbaetk').value;
        ppn2baetk=document.getElementById('ppn2baetk').value;
        urutbaetk=document.getElementById('urutbaetk').value;
        param='suratbaetk='+suratbaetk+'&resumebaetk='+resumebaetk+'&fcrbaetk='+fcrbaetk+'&perhitunganbaetk='+perhitunganbaetk+'&evaluasibaetk='+evaluasibaetk+'&ppnbaetk='+ppnbaetk+'&ppn2baetk='+ppn2baetk+'&urutbaetk='+urutbaetk;
    }

      else if (jenisba=='bapjd') {
        suratbapjd=document.getElementById('suratbapjd').value;
        resumebapjd=document.getElementById('resumebapjd').value;
        judulbapjd=document.getElementById('judulbapjd').value;
        param='suratbapjd='+suratbapjd+'&resumebapjd='+resumebapjd+'&judulbapjd='+judulbapjd;
    }



    param+='&method='+method+'&nokontrak='+nokontrak+'&tanggal='+tanggal+'&noba='+noba+'&jenisba='+jenisba+'&sifatba='+sifatba;

	tujuan='pln_slave_ba_form.php';
	post_response_text(tujuan, param, respog);
	function respog(){
		if (con.readyState == 4) {
			if (con.status == 200) {
				busy_off();
				if (!isSaveResponse(con.responseText)) {
					alert('ERROR TRANSACTION,\n' + con.responseText);
				}
				else {

					loadDatadetail();
                    alert('Done.');
                    cancelIsi();
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
    tujuan='pln_slave_ba_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('container').innerHTML = con.responseText;
                    loadDatadetail()
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}

function loadDatadetail(){
    nokontrak=document.getElementById('nokontrak').value;
    noba=document.getElementById('noba').value;
    param='method=loadDatadetail'+'&nokontrak='+nokontrak+'&noba='+noba;
    tujuan='pln_slave_ba_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                   
                    document.getElementById('containerx').innerHTML = con.responseText;
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}

function hapusheader(nokontrak,noba)
{
    fileTarget='pln_slave_ba_form';
    param='nokontrak='+nokontrak+'&method=deleteheader'+'&noba='+noba;
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
    if(confirm('Hapus data Kontrak '+nokontrak+'?'))post_response_text(fileTarget+'.php', param, respon);
}

function hapusdetail(nokontrak,noba,jenisba,sifatba)
{
    fileTarget='pln_slave_ba_form';
    param='nokontrak='+nokontrak+'&method=deletedetail'+'&noba='+noba+'&jenisba='+jenisba+'&sifatba='+sifatba;
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } 
                else 
                {
                    loadDatadetail();
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
    if(confirm('Hapus data BA '+jenisba+'?'))post_response_text(fileTarget+'.php', param, respon);
}

function editheader(nokontrak,sifatba)
{

    param='method=loadDatadetail'+'&nokontrak='+nokontrak+'&sifatba='+sifatba;
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    
                    document.getElementById('containerx').innerHTML = con.responseText;
                   document.getElementById('header').style.display="block";
                   document.getElementById('listmenu').style.display="block";
                   document.getElementById('listdata').style.display="none";
                   document.getElementById('listdatadetail').style.display="block";


       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}


function editdetail(nokontrak,noba,jenisba,sifatba)
{

     param='nokontrak='+nokontrak+'&jenisba='+jenisba+'&sifatba='+sifatba+'&noba='+noba+'&method=getdata';
     tujuan='pln_slave_ba_form.php';
     post_response_text(tujuan, param, respog);
     function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    
                    isdt = con.responseText.split("##");

                    var tanggalheader = isdt[1];
                    var tahun = tanggalheader.substr(0,4);
                    var bulan = tanggalheader.substr(5,2);
                    var hari = tanggalheader.substr(8,2);

                    document.getElementById('nokontrak').value = isdt[0];
                    document.getElementById('tanggal').value = bulan+'/'+hari+'/'+tahun;;
                    document.getElementById('noba').value = isdt[3];
                    document.getElementById('sifatba').value = sifatba;

                    document.getElementById('nokontrak').disabled = true;
                    document.getElementById('tanggal').disabled = true;
                    document.getElementById('noba').disabled = true;
                    document.getElementById('jenisba').disabled = true;
                    document.getElementById('methodba').value='update';


                    if (jenisba=='bakp') {
            
                    var periodex = isdt[4];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);
             
                     document.getElementById('jenisba').value = isdt[2];
                     document.getElementById('tanggallkp').value = bulanx+'/'+harix+'/'+tahunx;
                     document.getElementById('persenbakp').value = isdt[5];
                     document.getElementById('refkontrakbakp').value = isdt[6];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = false;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='basp') {
             
                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('pasalbasp').value = isdt[4];
                     document.getElementById('tahapbasp').value = isdt[5];
                     document.getElementById('sampaibasp').value = isdt[6];
                     document.getElementById('nominalbasp').value = isdt[7];
                     document.getElementById('waktubasp').value = isdt[8];
                     document.getElementById('dendabasp').value = isdt[9];
                     document.getElementById('waktuterlambatbasp').value = isdt[10];
                     document.getElementById('persenbasp').value = isdt[11];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = false;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='bast') {
        
                    var periodex = isdt[6];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('ketpbjbast').value = isdt[4];
                     document.getElementById('nobaspbast').value = isdt[5];
                     document.getElementById('tanggalbaspbast').value = bulanx+'/'+harix+'/'+tahunx;

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = false;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true; 

                    }

                    else if (jenisba=='bastb') {
        
                    var periodex = isdt[6];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('ketpbjbastb').value = isdt[4];
                     document.getElementById('nobaspbastb').value = isdt[5];
                     document.getElementById('tanggalbaspbastb').value = bulanx+'/'+harix+'/'+tahunx;

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bastb').hidden = false;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true; 

                    }

                    else if (jenisba=='bak') {
                    
                    var periodex = isdt[5];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('nobappbak').value = isdt[4];
                     document.getElementById('tanggalbappbak').value = bulanx+'/'+harix+'/'+tahunx;
                     document.getElementById('terlambatbak').value = isdt[6];
                     document.getElementById('persenbak').value = isdt[7];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = false;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='bap') {
                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('nobakpbap').value = isdt[4];
                     document.getElementById('nobappbap').value = isdt[5];
                     document.getElementById('nobakbap').value = isdt[6];
                     document.getElementById('persenbap').value = isdt[7];
                     document.getElementById('terminbap').value = isdt[8];
                     document.getElementById('persen2bap').value = isdt[9];
                     document.getElementById('nominalbap').value = isdt[10];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = false;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='basmp') {
                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('lamamasabasmp').value = isdt[4];
                     document.getElementById('pasalbasmp').value = isdt[5];
                     document.getElementById('tahapbasmp').value = isdt[6];
                     document.getElementById('terbayarbasmp').value = isdt[7];
                     

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = false;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }  

                    else if (jenisba=='bast_2') {
                    
                    var periodex = isdt[6];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('ketpbjbast2').value = isdt[4];
                     document.getElementById('nobaspbast2').value = isdt[5];
                     document.getElementById('tanggalxbast5').value = bulanx+'/'+harix+'/'+tahunx;

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = false;
                    document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='baepw') {
                  
                    var periodex = isdt[5];
                    var tahunx = periodex.substr(0,4);
                    var bulanx = periodex.substr(5,2);
                    var harix = periodex.substr(8,2);

                    var periodex2 = isdt[8];
                    var tahunx2 = periodex2.substr(0,4);
                    var bulanx2 = periodex2.substr(5,2);
                    var harix2 = periodex2.substr(8,2);

                    var periodex3 = isdt[9];
                    var tahunx3 = periodex3.substr(0,4);
                    var bulanx3 = periodex3.substr(5,2);
                    var harix3 = periodex3.substr(8,2);

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('sebabbaepw').value = isdt[4];
                     document.getElementById('tglevaluasibaepw').value = bulanx+'/'+harix+'/'+tahunx;
                     document.getElementById('wktperpanjangbaepw').value = isdt[6];
                     document.getElementById('mulaibaepw').value = isdt[7];
                     document.getElementById('batasbaepw').value = bulanx2+'/'+harix2+'/'+tahunx2;
                     document.getElementById('tanggaljaminanbaepw').value = bulanx3+'/'+harix3+'/'+tahunx3;
                     document.getElementById('dendabaepw').value = isdt[10];
                     document.getElementById('urutbaepw').value = isdt[11];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = false;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='baetk') {
                    

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('suratbaetk').value = isdt[4];
                     document.getElementById('resumebaetk').value = isdt[5];
                     document.getElementById('fcrbaetk').value = isdt[6];
                     document.getElementById('perhitunganbaetk').value = isdt[7];
                     document.getElementById('evaluasibaetk').value = isdt[8];
                     document.getElementById('ppnbaetk').value = isdt[9];
                     document.getElementById('ppn2baetk').value = isdt[10];
                     document.getElementById('urutbaetk').value = isdt[11];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = false;
                     document.getElementById('bapjd').hidden = true;

                    }

                    else if (jenisba=='bapjd') {
                    

                     document.getElementById('jenisba').value = isdt[2];

                     document.getElementById('suratbapjd').value = isdt[4];
                     document.getElementById('resumebapjd').value = isdt[5];
                     document.getElementById('judulbapjd').value = isdt[6];

                     document.getElementById('bastap').hidden = true;
                     document.getElementById('bapp').hidden = true;
                     document.getElementById('bakp').hidden = true;
                     document.getElementById('basp').hidden = true;
                     document.getElementById('bastb').hidden = true;
                     document.getElementById('bast').hidden = true;
                     document.getElementById('bak').hidden = true;
                     document.getElementById('bap').hidden = true;
                     document.getElementById('basmp').hidden = true;
                     document.getElementById('bast_2').hidden = true;
                     document.getElementById('baepw').hidden = true;
                     document.getElementById('baetk').hidden = true;
                     document.getElementById('bapjd').hidden = false;

                    }
                                                         
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}



function cancelIsi()
{

       document.getElementById('nokontrak').disabled = false;
       document.getElementById('tanggal').disabled = false;
       document.getElementById('noba').disabled = false;
       document.getElementById('jenisba').disabled = false;
       document.getElementById('methodba').value='insert';


        document.getElementById('tanggallkp').value='';
        document.getElementById('persenbakp').value='';
        document.getElementById('refkontrakbakp').value='';

        document.getElementById('pasalbasp').value='';
        document.getElementById('tahapbasp').value='';
        document.getElementById('sampaibasp').value='';
        document.getElementById('nominalbasp').value='';
        document.getElementById('waktubasp').value='';
        document.getElementById('dendabasp').value='';
        document.getElementById('waktuterlambatbasp').value='';
        document.getElementById('persenbasp').value='';


        document.getElementById('ketpbjbast').value='';
        document.getElementById('nobaspbast').value='';
        document.getElementById('tanggalbaspbast').value='';

        document.getElementById('ketpbjbastb').value='';
        document.getElementById('nobaspbastb').value='';
        document.getElementById('tanggalbaspbastb').value='';

        document.getElementById('nobappbak').value='';
        document.getElementById('tanggalbappbak').value='';
        document.getElementById('terlambatbak').value='';
        document.getElementById('persenbak').value='';

       document.getElementById('nobakpbap').value='';
       document.getElementById('nobappbap').value='';
       document.getElementById('nobakbap').value='';
       document.getElementById('persenbap').value='';
       document.getElementById('terminbap').value='';
       document.getElementById('persen2bap').value='';
       document.getElementById('nominalbap').value='';

        document.getElementById('lamamasabasmp').value='';
        document.getElementById('pasalbasmp').value='';
        document.getElementById('tahapbasmp').value='';
        document.getElementById('terbayarbasmp').value='';


        document.getElementById('ketpbjbast2').value='';
        document.getElementById('nobaspbast2').value='';
        document.getElementById('tanggalbaspbast5').value='';

        document.getElementById('sebabbaepw').value='';
        document.getElementById('tglevaluasibaepw').value='';
        document.getElementById('wktperpanjangbaepw').value='';
        document.getElementById('mulaibaepw').value='';
        document.getElementById('batasbaepw').value='';
        document.getElementById('tanggaljaminanbaepw').value='';
        document.getElementById('dendabaepw').value='';
        document.getElementById('urutbaepw').value='';

        document.getElementById('suratbaetk').value='';
        document.getElementById('resumebaetk').value='';
        document.getElementById('fcrbaetk').value='';
        document.getElementById('perhitunganbaetk').value='';
        document.getElementById('evaluasibaetk').value='';
        document.getElementById('ppnbaetk').value='';
        document.getElementById('ppn2baetk').value='';
        document.getElementById('urutbaetk').value='';

        document.getElementById('suratbapjd').value='';
        document.getElementById('resumebapjd').value='';
        document.getElementById('judulbapjd').value='';




}


function getnoba()
{
    nokontrak=document.getElementById('nokontrak').value;
    jenisba=document.getElementById('jenisba').value;
    sifatba=document.getElementById('sifatba').value;
    tanggal=document.getElementById('tanggal').value;
    param='nokontrak='+nokontrak+'&jenisba='+jenisba+'&sifatba='+sifatba+'&tanggal='+tanggal+'&method=getnoba';
    tujuan='pln_slave_ba_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                
                    document.getElementById('noba').value = con.responseText;
                    if (jenisba=='bastap') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                      
                    }

                    else if (jenisba=='bapp') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bakp') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = false;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='basp') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = false;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bastb') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = false;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bast') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = false;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bak') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = false;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bap') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = false;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='basmp') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = false;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }

                    else if (jenisba=='bast_2') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = false;
                        document.getElementById('baepw').hidden = true;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }
                    else if (jenisba=='baepw') {

                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = false;
                         document.getElementById('baetk').hidden = true;
                         document.getElementById('bapjd').hidden = true;
                    }
                    else if (jenisba=='baetk') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                        document.getElementById('baetk').hidden = false;
                        document.getElementById('bapjd').hidden = true;
                    }
                    else if (jenisba=='bapjd') {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                        document.getElementById('baetk').hidden = true;
                        document.getElementById('bapjd').hidden = false;
                    }
                    else
                    {
                        document.getElementById('bastap').hidden = true;
                        document.getElementById('bapp').hidden = true;
                        document.getElementById('bakp').hidden = true;
                        document.getElementById('basp').hidden = true;
                        document.getElementById('bastb').hidden = true;
                        document.getElementById('bast').hidden = true;
                        document.getElementById('bak').hidden = true;
                        document.getElementById('bap').hidden = true;
                        document.getElementById('basmp').hidden = true;
                        document.getElementById('bast_2').hidden = true;
                        document.getElementById('baepw').hidden = true;
                        document.getElementById('baetk').hidden = true;
                        document.getElementById('bapjd').hidden = true;
                    }

                
                   
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
    
}



function buatbaru()
{
   
     document.getElementById('header').style.display="block";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="none";
     document.getElementById('listdatadetail').style.display="block";

}

function listdata()
{
   
     document.getElementById('header').style.display="none";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="block";
     document.getElementById('listdatadetail').style.display="none";
     loadData();

}

