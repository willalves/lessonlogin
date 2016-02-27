<?php
ob_start();
session_start();
	if(!isset($_SESSION['usuariowill']) && (!isset($_SESSION['senhawill']))){
		header("Location: index.php?acao=negado");
	}

	include_once("conexao/conecta.php");
	include_once("logout.php");
?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Sistema Login - William Alves</title>
		<link href="css/estilo.css" rel="stylesheet">
	</head>
	<body>
		<div id="div-centro-home">
			<a href="?sair" onClick="return confirm('Really want to exit?')" id="log-out">Log out</a>
			<div id="div-meio-home">
				<p>Welcome, this is a restricted area of our website!</p>
			</div>
		</div>
	</body>
</html>