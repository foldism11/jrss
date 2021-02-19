function simpan()
{

    cb = document.getElementById('hometrip');
    cb.checked = false;
    cb.disabled = false;
    checkhometrip(cb);



}

function saveheader(id)
{
   cb = document.getElementById('check'+id);
   nama = document.getElementById('nama').value;
 
   	 if (cb.checked) {
   	 	tipe='1';

   	 }
   	 else
   	 {
   	 	tipe='0';
   	 }
  

	   	method='simpanheader';
	   	param='method='+method+'&id='+id+'&tipe='+tipe+'&nama='+nama;
	   	tujuan='jr_slave_master_akses.php';
	   	post_response_text(tujuan, param, respog);
	   	function respog(){
	   		if (con.readyState == 4) {
	   			if (con.status == 200) {
	   				busy_off();
	   				if (!isSaveResponse(con.responseText)) {
	   					alert('ERROR TRANSACTION,\n' + con.responseText);
	   				}
	   				else {

	   				/*	loadData();
	   					cancelIsi();
	   					alert('Done.');*/
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


  function getdata(user)
{
		method='getdata';
	   	param='method='+method+'&nama='+user;
	   	tujuan='jr_slave_master_akses.php';
	   	post_response_text(tujuan, param, respog);
	   	function respog(){
	   		if (con.readyState == 4) {
	   			if (con.status == 200) {
	   				busy_off();
	   				if (!isSaveResponse(con.responseText)) {
	   					alert('ERROR TRANSACTION,\n' + con.responseText);
	   				}
	   				else {
/*
	   					loadData();
	   					cancelIsi();
	   					alert('Done.');*/

	   					//sampai disi jadi belum bisa ambil nilai terakhir di split ##, untuk menjadikan varialbel for di bawah
	   					isdt = con.responseText.split("##");
	   					for (var i = 0; i >= 0; i--) {
	   						Things[i]
	   					}
	   					

	                    document.getElementById('check'+isdt[0]).checked=true;
	                    document.getElementById('check'+isdt[1]).checked=true;
	                }
	            }
	            else {
	            	busy_off();
	            	error_catch(con.status);
	            }
	        }
	    }       

}

   

