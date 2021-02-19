

function preview()
{
	nokontrak=document.getElementById('nokontrak').value;
	judul=document.getElementById('judul').value;
	jeniskontrak=document.getElementById('jeniskontrak').value;
	var tanggalx = document.getElementById('reservation').value;
	var tanggal = tanggalx.substr(0,10);
	var tanggal2 = tanggalx.substr(12,11);
	method='preview';
    tujuan='pln_slave_monitoring_kontrak.php';
	param='method='+method+'&nokontrak='+nokontrak+'&judul='+judul+'&tanggal='+tanggal+'&tanggal2='+tanggal2+'&jeniskontrak='+jeniskontrak;
	post_response_text(tujuan, param, respog);
	function respog(){
		if (con.readyState == 4) {
			if (con.status == 200) {
				busy_off();
				if (!isSaveResponse(con.responseText)) {
					alert('ERROR TRANSACTION,\n' + con.responseText);
				}
				else {
                   
					document.getElementById('container').innerHTML=con.responseText;
				}
			}
			else {
				busy_off();
				error_catch(con.status);
			}
		}
	}		

}

