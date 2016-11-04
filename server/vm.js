

function destroyVM(){
//  alert(document.forms[num]);
  var server = document.getElementById('server_state_form');
  server.action = 'destroyVM.php';
  server.method = 'post';
  server.submit();
}
function startVM(){

  var server = document.getElementById('server_state_form');
  server.action = 'startVM.php';
  server.method = 'post';
  server.submit();
}
function stopVM(){
  var server = document.getElementById('server_state_form');
  server.action = 'stopVM.php';
  server.method = 'post';
  server.submit();
}
function restartVM(){
  var server = document.getElementById('server_state_form');
  server.action = 'restartVM.php';
  server.method = 'post';
  server.submit();
}
function resetPassword(){
  var server = document.getElementById('server_state_form');
//  server.action = 'test.php';
//  alert('???');
  server.action = 'resetPassword.php';
  server.method = 'post';
  server.submit(); 
}
function stateClose(){
  document.getElementById('serverState').style.display="none";
}

 function isVMdeleted(processStart,processEnd){

     var findStr = "<?php echo VM_DESTROY; ?>";
      for(i=processStart; i<=processEnd ; i++) {
        var message = document.getElementById('state'+i).innerHTML;
        if (message.indexOf(findStr) != -1) {
        //  alert('서버 삭제가 완료 되었습니다.');
          return true; //원래는 여기가 true;
        }else {   
         // alert('서버 삭제가 완료 되지 않음..');
          return false; //원래는 여기가 flase;
        }
    }
}

function viewPassword(t){
    var id = t.innerHTML+'_id';
    var view_id = t.innerHTML;
    var postVal = document.getElementById(id).value; 
//    var postVal = t.innerHTML;
//    alert(document.getElementById(id).value);
    var xhr = new XMLHttpRequest();
    xhr.open('POST','view_password.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'id='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
        //  document.querySelector('.password').innerHTML = xhr.responseText;
          document.getElementById(view_id).innerHTML = xhr.responseText; 
        }
      }
  }

  function hiddenPassword(t){
    var postVal = t.innerHTML;
    document.getElementById(postVal).innerHTML="";
  }

  function showVMState(t){
    var postVal = t.innerHTML;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','vmState.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'displayname='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
        //  document.querySelector('.password').innerHTML = xhr.responseText;
          document.getElementById('serverState').innerHTML = xhr.responseText; 
        //  alert(xhr.responseText);
        }
      }
    document.getElementById('serverState').style.display = 'table';
  }


  var renewPage = function(){
    span_start = 2;
    span_end = 1;
    var xhr = new XMLHttpRequest();
    xhr.open('GET','renewMyServer.php');
    xhr.send();
    xhr.onreadystatechange = function(){
      //  alert(xhr.responseText);
      if(xhr.readyState === 4 && xhr.status === 200) {
        document.querySelector('#myVM').innerHTML = xhr.responseText;
          //  alert(xhr.responseText);
      }
    }
       // xhr.send();
        // alert("ajax use");
    stateClose();
  }
  
  function renewMyServer(){
//    alert('renewMyServer');

    if(isVMdeleted(span_start,span_end) == true){      
        Confirm.render('VM','삭제가 완료 되었습니다',renewPage,'','no');
        
     }

  }