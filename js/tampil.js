

function simpan()
{
    noba=document.getElementById('noba').value;
    nokontrak=document.getElementById('nokontrak').value;
	judul=document.getElementById('judul').value;
    sifatba=document.getElementById('sifatba').value;
    noreferensi=document.getElementById('noreferensi').value;
    tanggalamandemen=document.getElementById('tanggalamandemen').value;
    nilaiamandemen=remove_comma_var(document.getElementById('nilaiamandemen').value);
    noamandemen=document.getElementById('noamandemen').value;
    upt=document.getElementById('upt').value;
    penyedia=document.getElementById('penyedia').value;
    tanggal=document.getElementById('tanggal').value;
    periode=document.getElementById('reservation').value;
    masa=document.getElementById('masa').value;
    nilai=remove_comma_var(document.getElementById('nilai').value);
    dirpekrjaan=document.getElementById('dirpekrjaan').value;
	dirlap=document.getElementById('dirlap').value;
    penglap=document.getElementById('penglap').value;
	manupt=document.getElementById('manupt').value;
	dirven=document.getElementById('dirven').value;
	jeniskontrak=document.getElementById('jeniskontrak').value;
    sifatkerja=document.getElementById('sifatkerja').value;
    prk=document.getElementById('prk').value;
    lokasi=document.getElementById('lokasi').value;
    proman=document.getElementById('proman').value;
    pengk3=document.getElementById('pengk3').value;
    tengker=document.getElementById('tengker').value;
    adm=document.getElementById('adm').value;
	
	
    var periode = document.getElementById('reservation').value;
    var periode1 = periode.substr(0,10);
    var periode2 = periode.substr(12,11);
    method=document.getElementById('method').value;
    param='method='+method+'&noba='+noba+'&nokontrak='+nokontrak+'&judul='+judul+'&upt='+upt+'&penyedia='+penyedia;
    param+='&tanggal='+tanggal+'&periode1='+periode1+'&periode2='+periode2+'&masa='+masa+'&nilai='+nilai+'&dirpekrjaan='+dirpekrjaan+'&dirlap='+dirlap;
    param+='&penglap='+penglap+'&manupt='+manupt+'&dirven='+dirven+'&jeniskontrak='+jeniskontrak+'&sifatkerja='+sifatkerja+'&prk='+prk+'&lokasi='+lokasi+'&proman='+proman+'&pengk3='+pengk3+'&tengker='+tengker+'&adm='+adm+'&sifatba='+sifatba+'&noreferensi='+noreferensi+'&tanggalamandemen='+tanggalamandemen+'&nilaiamandemen='+nilaiamandemen+'&noamandemen='+noamandemen;
	tujuan='pln_slave_kontrak_form.php';
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

                    document.getElementById('header').style.display="none";
                    document.getElementById('listmenu').style.display="block";
                    document.getElementById('listdata').style.display="block";
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
    tujuan='pln_slave_kontrak_form.php';
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

function hapus(nokontrak,noba)
{
    fileTarget='pln_slave_kontrak_form';
    param='nokontrak='+nokontrak+'&method=delete'+'&noba='+noba;
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

/*function edit(no_kontrak,noba,judul_kontrak,nama_vendor,tanggal_kontrak,perkontrak1,perkontrak2,masa_pemeliharaan,man_upt,prk,lokasi_pekerjaan,project_manager,pengawas_k3,tenaga_kerja,nilai_kotrak,direksi_pekerjaan,direksi_lapangan,pengawas_lapangan,mst_upt,direktur_vendor,input_wbs,jenis_kontrak,sifat_pekerjaan)
{
    document.getElementById('noba').value=noba;
    document.getElementById('noba').disabled=true;
    document.getElementById('nokontrak').value=no_kontrak;
    document.getElementById('judul').value=judul_kontrak;
    document.getElementById('upt').value=mst_upt;
    document.getElementById('penyedia').value=nama_vendor;
    document.getElementById('tanggal').value=tanggal_kontrak;
    document.getElementById('reservation').value=perkontrak1;
    document.getElementById('masa').value=masa_pemeliharaan;
    document.getElementById('nilai').value=nilai_kotrak;
    document.getElementById('dirpekrjaan').value=direksi_pekerjaan;
    document.getElementById('dirlap').value=direksi_lapangan;
    document.getElementById('penglap').value=pengawas_lapangan;
    document.getElementById('manupt').value=man_upt;
    document.getElementById('dirven').value=direktur_vendor;
    document.getElementById('jeniskontrak').value=jenis_kontrak;
    document.getElementById('sifatkerja').value=sifat_pekerjaan;
    document.getElementById('prk').value=prk;
    document.getElementById('lokasi').value=lokasi_pekerjaan;
    document.getElementById('proman').value=project_manager;
    document.getElementById('pengk3').value=pengawas_k3;
    document.getElementById('tengker').value=tenaga_kerja;
    document.getElementById('method').value='update';


}*/


function edit(nokontrak,noamandemen)
{

    param='nokontrak='+nokontrak+'&noamandemen='+noamandemen+'&method=getdata';
    tujuan='pln_slave_kontrak_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    isdt = con.responseText.split("##");

                    if (isdt[23]==0) {

                        document.getElementById('dirven').disabled = false;
                        document.getElementById('proman').disabled = false;
                        document.getElementById('pengk3').disabled = false;
                        document.getElementById('adm').disabled = false;
                        document.getElementById('dirpekrjaan').disabled = false;
                        document.getElementById('dirlap').disabled = false;
                        document.getElementById('penglap').disabled = false;

                        document.getElementById('nokontrak').value = isdt[0];
                        document.getElementById('judul').value = isdt[1];
                        document.getElementById('noba').value = isdt[2];
                        document.getElementById('upt').value = isdt[3];
                        document.getElementById('penyedia').value = isdt[4];
                        document.getElementById('tanggal').value = isdt[5];
                        document.getElementById('nokontrak').disabled = true;
                        document.getElementById('ref2').hidden = false;
                        document.getElementById('ref').hidden = true;
                        document.getElementById('tglamandemen').hidden = false;
                        document.getElementById('amandemen').hidden = false;
                        document.getElementById('nilaiaman').hidden = false;


                        var periodex = isdt[6];
                        var tahun1 = periodex.substr(0,4);
                        var bulan1 = periodex.substr(5,2);
                        var hari1 = periodex.substr(8,2);

                        var periodey = isdt[7];
                        var tahun2 = periodey.substr(0,4);
                        var bulan2 = periodey.substr(5,2);
                        var hari2 = periodey.substr(8,2);

                        document.getElementById('reservation').value = bulan1+'/'+hari1+'/'+tahun1+'- '+bulan2+'/'+hari2+'/'+tahun2;
                        document.getElementById('masa').value = isdt[8];
                        document.getElementById('nilai').value = isdt[9];
                        document.getElementById('dirpekrjaan').value = isdt[10];
                        document.getElementById('dirlap').value = isdt[11];
                        document.getElementById('penglap').value = isdt[12];
                        document.getElementById('manupt').value = isdt[13];
                        document.getElementById('dirven').value = isdt[14];
                        document.getElementById('jeniskontrak').value = isdt[15];
                        document.getElementById('sifatkerja').value = isdt[16];
                        document.getElementById('prk').value = isdt[17];
                        document.getElementById('lokasi').value = isdt[18];
                        document.getElementById('proman').value = isdt[19];
                        document.getElementById('pengk3').value = isdt[20];
                        document.getElementById('tengker').value = isdt[21];
                        document.getElementById('adm').value = isdt[22];
                        document.getElementById('sifatba').value = isdt[23];
                        document.getElementById('sifatba').disabled = true;
                        document.getElementById('noreferensi2').value = isdt[24];
                        document.getElementById('noamandemen').value = isdt[25];
                        document.getElementById('tanggalamandemen').value = isdt[26];
                        document.getElementById('nilaiamandemen').value = isdt[27];
                        document.getElementById('method').value='update';

                        document.getElementById('header').style.display="block";
                        document.getElementById('listmenu').style.display="block";
                        document.getElementById('listdata').style.display="none";

                    }
                    else
                    {
                        document.getElementById('dirven').disabled = false;
                        document.getElementById('proman').disabled = false;
                        document.getElementById('pengk3').disabled = false;
                        document.getElementById('adm').disabled = false;
                        document.getElementById('dirpekrjaan').disabled = false;
                        document.getElementById('dirlap').disabled = false;
                        document.getElementById('penglap').disabled = false;

                        document.getElementById('nokontrak').value = isdt[0];
                        document.getElementById('judul').value = isdt[1];
                        document.getElementById('noba').value = isdt[2];
                        document.getElementById('upt').value = isdt[3];
                        document.getElementById('penyedia').value = isdt[4];
                        document.getElementById('tanggal').value = isdt[5];
                        document.getElementById('nokontrak').disabled = true;

                        document.getElementById('ref2').hidden = true;
                        document.getElementById('ref').hidden = true;
                        document.getElementById('tglamandemen').hidden = true;
                        document.getElementById('amandemen').hidden = true;
                        document.getElementById('nilaiaman').hidden = true;



                        var periodex = isdt[6];
                        var tahun1 = periodex.substr(0,4);
                        var bulan1 = periodex.substr(5,2);
                        var hari1 = periodex.substr(8,2);

                        var periodey = isdt[7];
                        var tahun2 = periodey.substr(0,4);
                        var bulan2 = periodey.substr(5,2);
                        var hari2 = periodey.substr(8,2);

                         document.getElementById('reservation').value = bulan1+'/'+hari1+'/'+tahun1+'- '+bulan2+'/'+hari2+'/'+tahun2;
                        document.getElementById('masa').value = isdt[8];
                        document.getElementById('nilai').value = isdt[9];
                        document.getElementById('dirpekrjaan').value = isdt[10];
                        document.getElementById('dirlap').value = isdt[11];
                        document.getElementById('penglap').value = isdt[12];
                        document.getElementById('manupt').value = isdt[13];
                        document.getElementById('dirven').value = isdt[14];
                        document.getElementById('jeniskontrak').value = isdt[15];
                        document.getElementById('sifatkerja').value = isdt[16];
                        document.getElementById('prk').value = isdt[17];
                        document.getElementById('lokasi').value = isdt[18];
                        document.getElementById('proman').value = isdt[19];
                        document.getElementById('pengk3').value = isdt[20];
                        document.getElementById('tengker').value = isdt[21];
                        document.getElementById('adm').value = isdt[22];
                        document.getElementById('sifatba').value = isdt[23];
                        document.getElementById('sifatba').disabled = true;

                        document.getElementById('method').value='update';

                        document.getElementById('header').style.display="block";
                        document.getElementById('listmenu').style.display="block";
                        document.getElementById('listdata').style.display="none";
                    }


                    


       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}


function getdatakontrak()
{
    noreferensi=document.getElementById('noreferensi').value;
    param='noreferensi='+noreferensi+'&method=getdatakontrak';
    tujuan='pln_slave_kontrak_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    isdt = con.responseText.split("##");

                    document.getElementById('dirven').disabled = false;
                    document.getElementById('proman').disabled = false;
                    document.getElementById('pengk3').disabled = false;
                    document.getElementById('adm').disabled = false;
                     document.getElementById('dirpekrjaan').disabled = false;
                    document.getElementById('dirlap').disabled = false;
                    document.getElementById('penglap').disabled = false;
                    document.getElementById('nokontrak').disabled = true;
                    document.getElementById('noreferensi2').disabled = true;

                    document.getElementById('nokontrak').value = isdt[0];
                    document.getElementById('ref').hidden = true;
                    document.getElementById('ref2').hidden = false;
                    document.getElementById('noreferensi2').value = isdt[0];
                    document.getElementById('judul').value = isdt[1];
                    document.getElementById('noba').value = isdt[2];
                    document.getElementById('upt').value = isdt[3];
                    document.getElementById('penyedia').value = isdt[4];
                    document.getElementById('tanggal').value = isdt[5];

                    var periodex = isdt[6];
                    var tahun1 = periodex.substr(0,4);
                    var bulan1 = periodex.substr(5,2);
                    var hari1 = periodex.substr(8,2);

                    var periodey = isdt[7];
                    var tahun2 = periodey.substr(0,4);
                    var bulan2 = periodey.substr(5,2);
                    var hari2 = periodey.substr(8,2);
                    document.getElementById('reservation').value = bulan1+'/'+hari1+'/'+tahun1+'- '+bulan2+'/'+hari2+'/'+tahun2;
                    document.getElementById('masa').value = isdt[8];
                    document.getElementById('nilai').value = isdt[9];
                    document.getElementById('dirpekrjaan').value = isdt[10];
                    document.getElementById('dirlap').value = isdt[11];
                    document.getElementById('penglap').value = isdt[12];
                    document.getElementById('manupt').value = isdt[13];
                    document.getElementById('dirven').value = isdt[14];
                    document.getElementById('jeniskontrak').value = isdt[15];
                    document.getElementById('sifatkerja').value = isdt[16];
                    document.getElementById('prk').value = isdt[17];
                    document.getElementById('lokasi').value = isdt[18];
                    document.getElementById('proman').value = isdt[19];
                    document.getElementById('pengk3').value = isdt[20];
                    document.getElementById('tengker').value = isdt[21];
                    document.getElementById('adm').value = isdt[22];
                    document.getElementById('sifatba').value = isdt[23];
                    document.getElementById('noreferensi').value = isdt[24];
                    document.getElementById('sifatba').value = '0';
                    document.getElementById('method').value='insert';

                    document.getElementById('header').style.display="block";
                    document.getElementById('listmenu').style.display="block";
                    document.getElementById('listdata').style.display="none";


       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }


}
function getdatapbj()
{
    penyedia=document.getElementById('penyedia').value;
    param='penyedia='+penyedia+'&method=getdatapbj';
    tujuan='pln_slave_kontrak_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{

                    document.getElementById('dirven').disabled = false;
                    document.getElementById('proman').disabled = false;
                    document.getElementById('pengk3').disabled = false;
                    document.getElementById('adm').disabled = false;

                    isdt = con.responseText.split("##");
                    document.getElementById('dirven').innerHTML = isdt[0];
                    document.getElementById('proman').innerHTML = isdt[1];
                    document.getElementById('pengk3').innerHTML = isdt[2];
                    document.getElementById('adm').innerHTML = isdt[3];
                   
                   
       
                }
            }else{
                busy_off();
          error_catch(con.status);
            }
        }   
    }
}

function getdataupt()
{
    upt=document.getElementById('upt').value;
    param='upt='+upt+'&method=getdataupt';
    tujuan='pln_slave_kontrak_form.php';
    post_response_text(tujuan, param, respog);
    function respog(){
        if(con.readyState==4){
            if (con.status == 200){
                busy_off();
                if (!isSaveResponse(con.responseText)){
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                }else{
                    
                    document.getElementById('dirpekrjaan').disabled = false;
                    document.getElementById('dirlap').disabled = false;
                    document.getElementById('penglap').disabled = false;


                     isdt = con.responseText.split("##");
                    document.getElementById('dirpekrjaan').innerHTML = isdt[0];
                    document.getElementById('dirlap').innerHTML = isdt[1];
                    document.getElementById('penglap').innerHTML = isdt[2];

                    
       
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

    document.getElementById('noba').value='';
    document.getElementById('nokontrak').value='';
    document.getElementById('judul').value='';
    document.getElementById('upt').value='';
    document.getElementById('penyedia').value='';
    document.getElementById('tanggal').value='';
    document.getElementById('reservation').value='';
    document.getElementById('masa').value='';
    document.getElementById('nilai').value='';
    document.getElementById('dirpekrjaan').value='';
    document.getElementById('dirlap').value='';
    document.getElementById('penglap').value='';
    document.getElementById('manupt').value='';
    document.getElementById('dirven').value='';
    document.getElementById('jeniskontrak').value='';
    document.getElementById('sifatkerja').value='';
    document.getElementById('prk').value='';
    document.getElementById('lokasi').value='';
    document.getElementById('proman').value='';
    document.getElementById('pengk3').value='';
    document.getElementById('tengker').value='';
    document.getElementById('noreferensi').value='';
    document.getElementById('tanggalamandemen').value='';

    document.getElementById('dirven').disabled = false;
    document.getElementById('proman').disabled = false;
    document.getElementById('pengk3').disabled = false;
    document.getElementById('adm').disabled = false;
    document.getElementById('dirpekrjaan').disabled = false;
    document.getElementById('dirlap').disabled = false;
    document.getElementById('penglap').disabled = false;
    document.getElementById('noreferensi2').disabled = false;
    document.getElementById('ref').hidden = false;
    document.getElementById('ref2').hidden = true;


}


function buatbaru()
{
   
     document.getElementById('header').style.display="block";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="none";

}

function listdata()
{
   
     document.getElementById('header').style.display="none";
     document.getElementById('listmenu').style.display="block";
     document.getElementById('listdata').style.display="block";
     loadData();

}

function disnoref()
{
     if (document.getElementById('sifatba').value=='0') {
         document.getElementById('ref').hidden=false;
         document.getElementById('amandemen').hidden=false;
         document.getElementById('tglamandemen').hidden=false;
         document.getElementById('nilaiaman').hidden=false;
     }
     else
     {
         document.getElementById('ref').hidden=true;
         document.getElementById('tglamandemen').hidden=true;
         document.getElementById('amandemen').hidden=true;
         document.getElementById('nilaiaman').hidden=true;
     }
    
     loadData();

}


