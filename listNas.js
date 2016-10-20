function makeByteToGB(byte){
  byte = Number(byte);
  return (byte/1024/1024/1024).toFixed(2) + " GB";
}

function resizeNASVolume(th){
  var td = document.getElementById('totalsize');
  var ori = td.innerHTML
  ori = ori.replace(/[^0-9]/g,'');
  ori = ori/100;
  td.innerHTML="";
//  alert(td.chlidNodes);
  var form = document.createElement('form');
  form.setAttribute('id','resize_form');
  form.setAttribute('method','post');
  form.setAttribute('action','test.php');
  var input_total_size = document.createElement('input');
  input_total_size.setAttribute('type','number');
  input_total_size.setAttribute('class','transparent');
  input_total_size.setAttribute('value',ori);
  input_total_size.setAttribute('name','totalsize');
  form.appendChild(input_total_size);

  var input_id = document.createElement('input');
  input_id.setAttribute('type','hidden');
  input_id.setAttribute('name','id');
  input_id.setAttribute('value',document.getElementById('NAS_state_form').id.value);
  form.appendChild(input_id);

  td.appendChild(form);
 // alert(th);
  th.style.display='none';
  document.getElementById('submit_resize').style.display='inline';
}

function resizeSubmit(){
	var form = document.getElementById('resize_form');
	form.action='updateNAS.php';
	form.method='post';
  Alert.render('NAS','크기 변경 진행중....','');
	form.submit();
}

function stateClose(){
  document.getElementById('NASState').style.display="none";
}
function listClose(){
  document.getElementById('NASList').style.display="none";
}
function NASAttachSubmit(){
  var form = document.getElementById('NAS_connect_form');
  form.action='NASAttach.php';
  form.method='post';
  Alert.render('NAS','서버 연결 진행중...','');
  form.submit();
}

function NASDettachSubmit(){
  var form = document.getElementById('NAS_connect_form');
  form.action='NASDettach.php';
//  form.action='test.php';
  form.method='post';
  Alert.render('NAS','서버 연결 끊기 진행중...','');
  form.submit();
}

function showNASState(t){
  var postVal = t.innerHTML;
  var xhr = new XMLHttpRequest();
  xhr.open('POST','NASState.php');
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var data = 'name='+postVal;
  xhr.send(data);
  xhr.onreadystatechange = function(){
      if(xhr.readyState === 4 && xhr.status === 200) {
      	var temp_text = xhr.responseText;
   //   	alert(temp_text);
        document.getElementById('NASState').innerHTML = xhr.responseText;
        var size_array = temp_text.split("<size>"); 
        //  alert(size_array[1]);
      	document.getElementById('usedsize').innerHTML = makeByteToGB(size_array[1]);
      	document.getElementById('totalsize').innerHTML = makeByteToGB(size_array[3]);
        //	alert(size_array.length);
      	if(size_array.length != 5) {
      		document.getElementById('autoresize').innerHTML = makeByteToGB(size_array[5]) + "/" + makeByteToGB(size_array[7]);    
        }
      }
  }
  document.getElementById('NASState').style.display = 'table';
}

function showNASList(t){
  stateClose();
  var postVal = t;
  var xhr = new XMLHttpRequest();
  xhr.open('POST','NASList.php');
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var data = 'networkid='+postVal;
  xhr.send(data);
  xhr.onreadystatechange = function(){
      if(xhr.readyState === 4 && xhr.status === 200) {
        var temp_text = xhr.responseText;
        document.getElementById('NASList').innerHTML = temp_text;
      }
  }
  document.getElementById('NASList').style.display = 'table-row-group';

}

function showNasConnect(num){
    var postVal = document.forms[num].id.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','NASConnectState.php');
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var data = 'id='+postVal;
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {
          var temp_text = xhr.responseText;
     //     alert(temp_text);
          document.getElementById('NASState').innerHTML = xhr.responseText;
        }
      }
    document.getElementById('NASState').style.display = 'table';
}