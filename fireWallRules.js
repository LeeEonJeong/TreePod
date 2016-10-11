  function stateClose(){
    document.getElementById('viewer').style.display="none";
  }

  function firewall(num){
  //  alert("firewall");
    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','fireWallRulesList.php'); //fix it
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

  function addFireWall(num){

    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','fireWallRulesAdd.php'); //fix it
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
    document.forms[num].action = 'deleteFireWallRules.php';
    document.forms[num].method = "post";
    document.forms[num].submit();
  }

  function addFireWallRules(){
    var startPort = document.getElementById('startport').value;
    var endPort = document.getElementById('endport').value;
    var protocol = document.getElementById('protocol').value;
    var cidrList = document.getElementById('cidrlist').value;

    var form = document.getElementById('addFireWallForm');
    form.action ="fireWallRulesCreate.php";
    form.startport.value = startPort;
    form.endport.value = endPort;
    form.protocol.value = protocol;
    form.cidrlist.value = cidrList;
    form.submit();
  }
