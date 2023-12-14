<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_sectorial = "localhost";
$database_sectorial = "eyf";
$username_sectorial = "fernanced";
$password_sectorial = "F3rn4nd0_02";
$sectorial = mysql_pconnect($hostname_sectorial, $username_sectorial, $password_sectorial) or trigger_error(mysql_error(),E_USER_ERROR); 
?>