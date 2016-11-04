  function displayFrom(id,dis){
    var distable = document.getElementById(dis);
    var table = document.getElementById(id);

    if(table.style.display=='none'){
      table.style.display='table-row';
      distable.style.display='none';
    }
    else {
      table.style.display='none';
      distable.style.display='table-row';
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
  function isEnglihOrNumOrSpecailLetters(str){
    var err = 0; 
    var specailLetter = false;
    var number = false;
    var eng = false;
//    var engBig = false;
    for (var i=0; i<str.length; i++)  { 
      var chk = str.substring(i,i+1); 
      if(chk.match(/[0-9]/)){
        number = true;
      }
      if(chk.match(/[a-z]|[A-Z]/)){
        eng = true;
      }
      if(chk.match(/[`~!@#$%^&*()_+-={}\\|;:'"<>?/,.]/)){
        specailLetter=true;
      }
      if(!chk.match(/[0-9]|[a-z]|[A-Z]|[`~!@#$%^&*()_+-={}\\|;:'"<>?/,.]/)) { 
        err = err + 1; 
      } 
    }    

    if (err > 0) { 
      return false;
    }
    if (eng && number && specailLetter){
      return true; 
    }
    return false;
  }
  function formSubmit(form_id){
    var form = document.getElementById(form_id);
  //  alert(form);
//    form.action='test.php';
//    form.action='cifsAccountAdd.php';
    form.method='post';
  //  alert(form.cifsId.value.length);
    if(form.cifsId.value.length < 6 || form.cifsId.value.length > 20){      
      Alert.render('CIFS ACCOUNT ID',' 6자리 이상 20자리 이하로 입력해 주세요.','default');
      return false;
    }
    if(!isEnglihOrNum(form.cifsId.value)){
      Alert.render('CIFS ACCOUNT ID','영어와 숫자만 입력해 주세요.','default');
      return false;
    }
    if(form.cifsPw.value.length < 8 || form.cifsPw.value.length > 14){      
      Alert.render('CIFS ACCOUNT PW','  8자리 이상 14자리 이하로 입력해 주세요.','default');
      return false;
    }
    if(!isEnglihOrNumOrSpecailLetters(form.cifsPw.value)){
      Alert.render('CIFS ACCOUNT PW','영문 대 소문자, 숫자, 특수문자 ()-_.의 조합으로 구성해 주세요.','default');
      return false;
    }
    form.submit();
  }

  function newCIFS(){
    window.open("cifsAccountNew.php?",'','left=300, top=300, width=732, height=350, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, copyhistory=no, resizable=no');
  }