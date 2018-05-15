<?php
session_start();
if(isset($_SESSION["login"]))
	header('Location: view/uzytkownik.php');
else
	header('Location: view/glowna.php');
?>