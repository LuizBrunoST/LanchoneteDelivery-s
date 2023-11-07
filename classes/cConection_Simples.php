<?php
    $host = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "deliverys";
	$mysqli = new mysqli($host, $usuario, $senha, $dbname);
	if($mysqli->connect_errno)
	echo "Falha na conecxão: (".$mysqli->connect_errno.") ".$mysqli->connect;