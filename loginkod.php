<?php

session_start();

$mysqli = new mysqli('dbtrain.im.uu.se', 'dbtrain_250' ,'hpejtl' , 'dbtrain_250');

$uname = isset ($_POST['Uname']) ? $_POST ['Uname'] : '';
$password = isset ($_POST ['Password']) ? $_POST['Password'] : '';

$sql = ("SELECT password FROM nations WHERE nation_name = '$uname'");
$sql2 = $mysqli ->query($sql);
$result = mysqli_fetch_row($sql2);
$sql2 = $result [0];


if (password_verify($password, $sql2))
{	
	session_start();
	$_SESSION['login_user'] = $epost;
	header("Location: index.php");

}
else
{
	session_destroy();
	header("Location: ");
}

$mysqli->close();

?>
