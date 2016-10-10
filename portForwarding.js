  function stateClose(){
    document.getElementById('viewer').style.display="none";
  }

  function portForwarding(num){
    num = parseInt(num)+1;
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
    num = parseInt(num)+1;
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
    var virtualMachineId = document.getElementById('virtualmachineid').value;
    var form = document.getElementById('addPortForm');
    form.publicport.value = publicPort;
    form.privateport.value = privatePort;
    form.publicendport.value = publicEndPort;
    form.privateendport.value = privateEndPort;
    form.virtualmachineid.value = virtualMachineId;
    form.submit();
  }

  function showNewIP(){
    var tr = document.getElementById('newIP');
    var tr_input = document.getElementById('newIPInput');
    var but = document.getElementById('newIPButton');
    if(tr.style.display=='none') {
      tr.style.display='table-row';  
      tr_input.style.display='table-row';
      but.innerHTML='창 닫기';
    } else {
      tr.style.display='none';  
      tr_input.style.display='none';
      but.innerHTML='새로운 공인 IP 등록';
    }
    
  }