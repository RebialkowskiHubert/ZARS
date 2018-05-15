<<<<<<< HEAD
<?php
session_start();
if(isset($_SESSION["login"]))
	header('Location: view/uzytkownik.php');
else
	header('Location: view/glowna.php');
=======
<?php
session_start();
if(isset($_SESSION["login"]))
	header('Location: view/uzytkownik.php');
else
	header('Location: view/glowna.php');
>>>>>>> 6f4311abe3f2332758f3a04f92fa97e9ac5af4d6
?>