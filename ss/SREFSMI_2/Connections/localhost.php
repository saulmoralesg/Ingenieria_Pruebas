<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localhost = "localhost";
$database_localhost = "srefmsi";
$database2_localhost = "srefmsi";
$username_localhost = "fernanced";
$password_localhost = "F3rn4nd0_02_291";
$localhost = mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
