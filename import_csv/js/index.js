

function preview(num){


    pelatihan=document.getElementById('pelatihan').value;
    jns=document.getElementById('jns').value;
    if (jns==0) {
         periode=document.getElementById('reservation').value;
    }
    else
    {
        periode=document.getElementById('reservation2').value;
    }
   

    var periode = document.getElementById('reservation').value;
    var periode1 = periode.substr(0,10);
    var periode2 = periode.substr(12,11);

    param='method=preview';
     param+='&pelatihan='+pelatihan+'&periode1='+periode1+'&periode2='+periode2+'&jns='+jns;
    tujuan='../slave_index.php';
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

function excel(ev){
pelatihan=document.getElementById('pelatihan').value;
    jns=document.getElementById('jns').value;
    if (jns==0) {
         periode=document.getElementById('reservation').value;
    }
    else
    {
        periode=document.getElementById('reservation2').value;
    }

    var periode = document.getElementById('reservation').value;
    var periode1 = periode.substr(0,10);
    var periode2 = periode.substr(12,11);
    param='method=preview';
     param+=/*'&nosertif='+nosertif+'&stsreg='+stsreg+'&stssertif='+stssertif+*/'&pelatihan='+pelatihan+/*'&nosertif='+nosertif+*/'&periode1='+periode1+'&periode2='+periode2+'&tipe=excel'+'&jns='+jns;
    tujuan='../slave_index.php';
    judul='Report Ms.Excel';        
    printFile(param,tujuan,judul,ev)    
}


function printFile(param,tujuan,title,ev){
   tujuan=tujuan+"?"+param;  
   width='700';
   height='400';
   content="<iframe frameborder=0 width=100% height=100% src='"+tujuan+"'></iframe>"
   showDialog2(title,content,width,height,ev);  
}

function tgl(){
  jns=document.getElementById('jns').value;
  if (jns==0) {
        document.getElementById('tgl2').hidden=true;
        document.getElementById('tgl1').hidden=false;
  }
  else
  {
        document.getElementById('tgl1').hidden=true;
        document.getElementById('tgl2').hidden=false;
  }
}

