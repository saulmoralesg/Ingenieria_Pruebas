<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_sectorial = "localhost";
$database_sectorial = "eyf";
$username_sectorial = "root";
$password_sectorial = "c00rd1n4";
$sectorial = mysql_pconnect($hostname_sectorial, $username_sectorial, $password_sectorial) or trigger_error(mysql_error(),E_USER_ERROR); 
?>