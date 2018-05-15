<?php
if(filter_has_var(INPUT_COOKIE, 'ciastko')){
	echo "1";
}
else{
	echo "0";
}

if(filter_has_var(INPUT_POST, 'ciastko'))
	setcookie('ciastko', 1, time()+31536000, "/");
?>