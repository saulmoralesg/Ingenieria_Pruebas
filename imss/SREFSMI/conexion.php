<?php
function conectar()
{
	mysql_connect("localhost", "fernanced", "F3rn4nd0_02");
	mysql_select_db("eyf");
}

$conexiondb=conectar();


function desconectar()
{
	mysql_close();
}
?>
