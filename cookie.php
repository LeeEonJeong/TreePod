<script language="JavaScript" src="asy.js">
</script>
 
쿠키 생성 버튼을 누른 후 쿠키 보기를 눌러 보세요.<br>
쿠키 삭제 버튼을 누른 후 쿠키 보기도 눌러 보세요.<br>
<br>
쿠키 생성 버튼을 누른 후 이 페이지를 닫고 다시 들어와서 쿠키 보기를 눌러보세요.<br>
<br>
 
<input type="button" value="쿠키 생성" onclick="setCookie('test', 'cookie test, 쿠키 테스트', 1)">
<input type="button" value="쿠키 보기" onclick="alert(getCookie('test'))">
<input type="button" value="쿠키 삭제" onclick="setCookie('test', '', -1)">
