<?php
function conectar()
{
	mysql_connect("localhost", "root", "c00rd1n4");
	mysql_select_db("eyf");
}

$conexiondb=conectar();


function desconectar()
{
	mysql_close();
}
?>
