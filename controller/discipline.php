<?php
if(filter_has_var(INPUT_POST, "iddys")){
	$iddys=filter_input(INPUT_POST, "iddys");
	setcookie("dyscyplina", $iddys, time()+86400, "/");		
}
?>