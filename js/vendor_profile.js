

function simpan()
{
    namabpj=document.getElementById('namabpj').value;
    alamatbpj=document.getElementById('alamatbpj').value;
	emailbpj=document.getElementById('emailbpj').value;
    tlpbpj=document.getElementById('tlpbpj').value;
    namadir=document.getElementById('namadir').value;
    tlpdir=document.getElementById('tlpdir').value;
    emaildir=document.getElementById('emaildir').value;
    namamgr=document.getElementById('namamgr').value;
    tlpmgr=document.getElementById('tlpmgr').value;
    emailmgr=document.getElementById('emailmgr').value;
	namapengawas=document.getElementById('namapengawas').value;
    tlppengawas=document.getElementById('tlppengawas').value;
	emailpengawas=document.getElementById('emailpengawas').value;
	nmpengawask3=document.getElementById('nmpengawask3').value;
	tlppengawask3=document.getElementById('tlppengawask3').value;
    emailpengawask3=document.getElementById('emailpengawask3').value;
    nmadmin=document.getElementById('nmadmin').value;
    tlpdmin=document.getElementById('tlpdmin').value;
    emaildmin=document.getElementById('emaildmin').value;
    nmpp=document.getElementById('nmpp').value;
    tlppp=document.getElementById('tlppp').value;
	emailpp=document.getElementById('emailpp').value;
    method=document.getElementById('method').value;
    param='method='+method+'&namabpj='+namabpj+'&alamatbpj='+alamatbpj+'&emailbpj='+emailbpj+'&tlpbpj='+tlpbpj+'&namadir='+namadir;
    param+='&tlpdir='+tlpdir+'&emaildir='+emaildir+'&namamgr='+namamgr+'&tlpmgr='+tlpmgr+'&emailmgr='+emailmgr+'&namapengawas='+namapengawas+'&tlppengawas='+tlppengawas;
    param+='&emailpengawas='+emailpengawas+'&nmpengawask3='+nmpengawask3+'&tlppengawask3='+tlppengawask3+'&emailpengawask3='+emailpengawask3+'&nmadmin='+nmadmin+'&tlpdmin='+tlpdmin+'&emaildmin='+emaildmin+'&nmpp='+nmpp+'&tlppp='+tlppp+'&emailpp='+emailpp;
   

	tujuan='vendor_slave_profile.php';
	post_response_text(tujuan, param, respog);
	function respog(){
		if (con.readyState == 4) {
			if (con.status == 200) {
				busy_off();
				if (!isSaveResponse(con.responseText)) {
					alert('ERROR TRANSACTION,\n' + con.responseText);
				}
				else {

					
                   
                    alert('Done.');
                    window.location = 'indexxvendor.php';
			
				}
			}
			else {
				busy_off();
				error_catch(con.status);
			}
		}
	}		

}
