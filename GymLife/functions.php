<?php
function post($var) {
    return filter_var($_POST[$var],FILTER_SANITIZE_STRING);
}

function hashPassword($pass) {
	return md5($pass. "gym");
}
?>