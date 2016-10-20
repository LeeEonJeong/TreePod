
function deleteOption(type){
    var select_option = document.getElementById(type);
 //   alert(select_option);
    for(i=0; i<select_option.length-1;){
        select_option.remove(select_option.length-1);
    }
}

function display(my_id,type) {
    var send_form = document.getElementById('sendform');
    var my_val = document.getElementById(my_id).value;
    var data = my_id+'='+my_val;
    var xhr = new XMLHttpRequest();
    var asyPage = 'asyVM.php';
    deleteOption(type);
    xhr.open('POST',asyPage);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {

            var temp_text = xhr.responseText;
     //       alert(temp_text);
            var option_array = temp_text.split("<option>");
            var input_id = document.getElementById(type);

            var opt = document.createElement("OPTION");
            for( i=0; i<option_array.length-1; i = i + 2 ){
                var opt = document.createElement("OPTION");
                opt.setAttribute("value", option_array[i+1]);
                opt.label = option_array[i];
                input_id.add(opt);
            }
        }
    }
}

function isEnglihOrNum(str){
    var err = 0; 
  
    for (var i=0; i<str.length; i++)  { 
       var chk = str.substring(i,i+1); 
        if(!chk.match(/[0-9]|[a-z]|[A-Z]/)) { 
            err = err + 1; 
        } 
    }    
    if (err > 0) { 
        return false;
    }
    return true; 
}

function checkDisplayName() {
    var dis = document.getElementById('sendform').name.value;
    if(dis==""){ 
        Alert.render('경고','disk 이름을 입력해 주세요.','default');
        document.getElementById('sendform').name.focus();
        return false;
    }
    else if(isEnglihOrNum(dis)==false){
        Alert.render('경고','영문및 숫자만 사용 가능 합니다.','default');
        document.getElementById('sendform').name.focus();
        return false;
    }
    else{
        window.open("NasNameCheck.php?disk_name="+dis,'','left=300, top=300, width=400, height=300, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, copyhistory=no, resizable=no');
    }
}

function checkPathName() {
    var dis = document.getElementById('sendform').path.value;
    if(dis==""){ 
        Alert.render('경고','경로를 입력해 주세요. ','default');
        document.getElementById('sendform').path.focus();
        return false;
    }
    else if(isEnglihOrNum(dis)==false){
        Alert.render('경고','영문및 숫자만 사용 가능 합니다.','default');
        document.getElementById('sendform').path.focus();
        return false;
    }
    else{
        window.open("pathNameCheck.php?disk_path="+dis,'','left=300, top=300, width=400, height=300, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, copyhistory=no, resizable=no');
    }
}

function submitForm(){
    var form = document.getElementById('sendform');
    if(form.name.value=="") {
        Alert.render('경고','volume이름을 입력해 주세요. ','default');
        return false;
    }
    if(form.name.readOnly == false) {
        Alert.render('경고','volume이름 중복검사 해주세요. ','default');
        return false;
    }
    if(form.path.value=="") {
        Alert.render('경고','경로를 입력해 주세요. ','default');
        return false;
    }
    if(form.name.readOnly == false) {
        Alert.render('경고','경로명 중복검사 해주세요. ','default');
        return false;
    }

    form.method="post";
//    form.action='test.php';
    form.action="NASadd.php";
    form.submit();
    Alert.render('NAS 신청','화면이 바뀔 때 까지<br>잠시만 기다려 주십시요.... ','');
}