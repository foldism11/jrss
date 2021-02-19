

function preview()
{
	nokontrak=document.getElementById('nokontrak').value;
	judul=document.getElementById('judul').value;
	jeniskontrak=document.getElementById('jeniskontrak').value;
    var tanggalx = document.getElementById('reservation').value;
    var tanggal = tanggalx.substr(0,10);
    var tanggal2 = tanggalx.substr(12,11);
	method='preview';
    tujuan='pln_slave_kelengkapan_berkas.php';
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


function pdf(notrans,sifatba)
{
    form();
    param = 'method=pdf' + '&nokontrak=' + notrans+ '&sifatba=' + sifatba;
    tujuan = 'pln_slave_kelengkapan_berkas.php';
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

function form()
{
    width = '700';
    height = '';
    //nopp=document.getElementById('nopp_'+id).value;
    content = "<div id=containerd align=center style=\"width:680px;overflow:auto;\"></div>";
    ev = 'event';
    title = "Jenis BA";
    showDialog1(title, content, width, height, ev); 
}


function cetak(nokontrak,sifatba,ev) {
    jenis=document.getElementById('idba').value;
    param = 'method=cetak' + '&nokontrak=' + nokontrak+ '&jenis=' + jenis+ '&sifatba=' + sifatba;
    tujuan = 'pln_slave_kelengkapan_berkas.php';
    title = 'Report PDF';
    printFile(param, tujuan, title, ev);
}

function printFile(param, tujuan, title, ev) {
    tujuan = tujuan + "?" + param;
    width = '';
    height = '500';
    content = "<iframe frameborder=0 width=100% height=100% src='" + tujuan + "'></iframe>"
        showDialog2(title, content, width, height, ev);
}

function uploaddata(nokontrak)
{
    formupload();
    param = 'method=uploaddata' + '&nokontrak=' + nokontrak;
    tujuan = 'pln_slave_kelengkapan_berkas.php';
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
                    loadfiles(nokontrak);
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

function formupload()
{
    width = '690';
    height = '';
    //nopp=document.getElementById('nopp_'+id).value;
    content = "<div id=containerd align=center style=\"width:680px;overflow:auto;\"></div>";
    ev = 'event';
    title = "Upload File";
    showDialog1(title, content, width, height, ev); 
}

function loadfiles(nokontrak) {
    param = 'method=loadfiles&nokontrak='+nokontrak;
    tujuan = 'pln_slave_kelengkapan_berkas.php';
    post_response_text(tujuan, param, respog);
    function respog() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } else {
                    document.getElementById('containerupload').innerHTML = con.responseText;
                }
            } else {
                busy_off();
                error_catch(con.status);
            }
        }
    }
}


function addfile(nokontrak){
    var file = document.getElementById("upload").files[0];
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("fileupload", document.getElementById("upload").value);
    formdata.append("nokontrak", nokontrak);
    if (document.getElementById("upload").value == "") {
        alert("warning : Upload file has been empty.");
        return false;
    }
    var con = createXMLHttpRequest();
    con.open("POST", "pln_slave_kelengkapan_berkas.php?method=simpanupload", true);
    con.onreadystatechange = eval(respon);
    con.send(formdata);
    function respon() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert(con.responseText);
                } else {
                    //=== Success Response
                    document.getElementById("upload").value = "";
                    loadfiles(nokontrak);
                }
            } else {
                busy_off();
                error_catch(con.status);
            }
        }
    }
}

function deletefile(nokontrak,namafile) {
    param = 'method=deletefile&namafile='+namafile+'&nokontrak='+nokontrak;
    tujuan = 'pln_slave_kelengkapan_berkas.php';
    post_response_text(tujuan, param, respog);
    function respog() {
        if (con.readyState == 4) {
            if (con.status == 200) {
                busy_off();
                if (!isSaveResponse(con.responseText)) {
                    alert('ERROR TRANSACTION,\n' + con.responseText);
                } else {
                    loadfiles(nokontrak);
                }
            } else {
                busy_off();
                error_catch(con.status);
            }
        }
    }
}