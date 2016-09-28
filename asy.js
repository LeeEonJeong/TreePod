
  function test(jobid){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'asynchronousPart.php');
    xhr.onreadystatechange = function(){
      document.querySelector('#state').innerHTML = xhr.responseText;
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = '';
    data += "jobid="+jobid;
    xhr.send(data);
  }

