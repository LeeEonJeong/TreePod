
	<?php
//	echo "test";
//	var_dump($_SESSION['displayname']);
	
	@session_start();
//	echo "??";
//	var_dump($_SESSION['tetete']);
	if(isset($_POST['displayname'])){
		$displayname = $_POST['displayname'];
//		echo $displayname."<br/>";
//		foreach($_SESSION as $key => $value){
//			echo $key."<br/>";
//		}
		
		if(!isset($_SESSION[$displayname])){
		//	echo "ㅗㅗㅗ";
			exit;
		}
	//	var_dump(array_search($displayname, $_SESSION['displayname']));
	//	var_dump($_SESSION['displayname']);
	//	if (array_search($displayname,$_SESSION['displayname']) === false) {
	//		$key = array_search($displayname, $_SESSION['displayname']);
		echo "<td colspan='2'> password <td colspan='5'> ".$_SESSION[$displayname]."</td>";
	//	}
	}


//	echo "<table>";
//	if(isset($_SESSION['displayname']) && isset($_SESSION['password'])) {
//		echo "<tr>";

//		foreach ($_SESSION['displayname'] as $key => $value) {
//			echo "<td>".$value."</td>";
//		}
//		echo "</tr>";

//		echo "<tr>";
	//	foreach ($_SESSION['password'] as $key => $value) {
	//		echo "<td colspan='2'> password <td colspan='5'> ".$value."</td>";
//		}
//		echo "</tr>"; 
//	}
//	echo "</table>";
	
	?>