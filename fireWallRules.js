  function stateClose(){
    document.getElementById('viewer').style.display="none";
  }

  function firewall(num){

    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','fireWallList.php'); //fix it
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'ipaddressid='+ipaddressid;
    data += '&ipaddress='+ ipadrressname;
    xhr.send(data);
    xhr.onreadystatechange = function(){
      if(xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('viewer').innerHTML = xhr.responseText; 
      }
    }
  }

  function addFireWallRules(num){

    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','fireWallAdd.php'); //fix it
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'ipaddressid='+ipaddressid;
    data += '&ipaddress='+ ipadrressname;
    xhr.send(data);
    xhr.onreadystatechange = function(){
      if(xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('viewer').innerHTML = xhr.responseText; 
     //   alert(xhr.responseText);
      }
    }
  }


  function deleteFireWallRules(num){
    num = parseInt(num) + parseInt(publicIp_length);
    document.forms[num].action = 'deletePortForwarding.php';
    document.forms[num].method = "post";
    document.forms[num].submit();
  }
