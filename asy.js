//맨 아래거가 쓰이는 거임.

 function setCookie(cName, cValue, cDay){
        var expire = new Date();
        expire.setDate(expire.getDate() + cDay);
        cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
        if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;
}
 
    // 쿠키 가져오기
    function getCookie(cName) {
        cName = cName + '=';
        var cookieData = document.cookie;
        var start = cookieData.indexOf(cName);
        var cValue = '';
        if(start != -1){
            start += cName.length;
            var end = cookieData.indexOf(';', start);
            if(end == -1)end = cookieData.length;
            cValue = cookieData.substring(start, end);
        }
        return unescape(cValue);
    }
  

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

  function testSeparate(jobid, num){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'asynchronousPart.php');
    xhr.onreadystatechange = function(){
      document.querySelector('#state'+num).innerHTML = xhr.responseText;
   //   alert(document.querySelector('#state'+num).innerHTML);
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = '';
    data += "jobid="+jobid;
    data += "&jobRank="+num;
    xhr.send(data);
    
  }

  function testSeparate2(jobid, num, timeid){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'asynchronousPart.php');
    xhr.onreadystatechange = function(){
      document.querySelector('#state'+num).innerHTML = xhr.responseText;
      var temp = xhr.responseText
      if(temp =="done!"){
        alert(temp);
        clearInterval(timeid);
      }
   //   alert(document.querySelector('#state'+num).innerHTML);
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = '';
    data += "jobid="+jobid;
    data += "&jobRank="+num;
    xhr.send(data);
    
  }
     