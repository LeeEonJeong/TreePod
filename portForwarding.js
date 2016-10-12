  function stateClose(){
    document.getElementById('viewer').style.display="none";
  }

  function portForwarding(num){
    num = parseInt(num);
    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','portForwardingList.php');
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

  function addPortForwarding(num){
    num = parseInt(num);
    document.getElementById('viewer').style.display="table-row-group";
    var ipaddressid = document.forms[num].ipaddressid.value;
    var ipadrressname = document.forms[num].ipaddress.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','portForwardingAdd.php');
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

  function deletePortForwardingRules(num){
    num = parseInt(num) + parseInt(publicIp_length);
    document.forms[num].action = 'deletePortForwarding.php';
    document.forms[num].method = "post";
    document.forms[num].submit();
  }

  function addPorForwardingRules(){

    if(document.getElementById('virtualmachineid').value == "") {
      alert("서버를 선택해 주세요.");
      return false;
    }
    var privatePort = document.getElementById('privateport').value;
    var publicPort = document.getElementById('publicport').value;
    var privateEndPort = document.getElementById('privateendport').value;
    var publicEndPort = document.getElementById('publicendport').value;
  //  var cidrList = document.getElementById('cidrlist').value;
    var openFireWall = document.getElementById('openfirewall').value;
    var virtualMachineId = document.getElementById('virtualmachineid').value;
    var protocol = document.getElementById('protocol').value;
    var form = document.getElementById('addPortForm');
  //  form.action = "portForwarding.php";
    form.publicport.value = publicPort;
    form.privateport.value = privatePort;
    form.publicendport.value = publicEndPort;
    form.privateendport.value = privateEndPort;
    form.virtualmachineid.value = virtualMachineId;
    form.protocol.value = protocol;
  //  form.cidrlist.value = cidrList;
    form.openfirewall.value = openFireWall;
    form.submit();
  }
