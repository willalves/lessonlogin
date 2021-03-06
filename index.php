<?php
ob_start();
session_start();
	if(isset($_SESSION['usuariowill']) && (isset($_SESSION['senhawill']))){
		header("Location: home.php");
	}
	include_once("conexao/conecta.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Sistema Login - William Alves</title>
		<link href="css/estilo.css" rel="stylesheet">
	</head>
	<body>
		<p class="menssagem">
			<?php

			if(isset($_GET['acao'])){
				$acao = $_GET['acao'];
				if($acao=='negado'){
					echo "<b>ERROR to access!</b> You must be logged in to access.";
				}
			}

			if(isset($_POST['logar'])){
				$usuario = trim(strip_tags($_POST['usuario']));
				$senha = trim(strip_tags($_POST['senha']));

				
				$select = "SELECT * from login WHERE BINARY usuario=:usuario AND BINARY senha=:senha";

					try{
						$result = $conexao->prepare($select);
						$result->bindParam(':usuario', $usuario,  PDO::PARAM_STR);
						$result->bindParam(':senha', $senha,  PDO::PARAM_STR);
						$result->execute();
						$contar = $result->rowCount();

						if($contar>0){
							$usuario = $_POST['usuario'];
							$senha = $_POST['senha'];
							$_SESSION['usuariowill'] = $usuario;
							$_SESSION['senhawill'] = $senha;
							header("Refresh: 2, home.phtml");
							echo "<b style='color: green;'>Successfully logged in, please wait!</b>";
						}else{
							echo 'The data entered is incorrect!';
						}

					}catch(PDOException $error){
						echo $error;
					}

			}
		?>
		</p>
		<div id="div-centro">
		   <!-- Caixa Esquerda -->
			<div id="div-esquerda">
			    <p><b>New Visitors</b></p>
			    <p class="letra">Creating a new account is free and instant.</p>
			    <a href="cadastro.php"><input id="botao-criar" type="submit" value="Create an Account" name="Create"></a>
			</div>
           <!-- Linha entre as duas caixas -->
            <div id="div-meio"><hr></div>
            <!-- Caixa Direita -->
		    <div id="div-direita">
		        <p><b>Resturning Visitors</b></p>
			    <p class="letra">Login using the email address and password you selected on your first visit.</p>

                <!-- Formulario de login -->
			    <p class="formulario">
                    <form action="index.php" method="post" title="LogIn">
                        <b class="letra">Email</b> <input class="caixa caixa-usuario" type="text" name="usuario" placeholder="User"><br>
                        <b class="letra">Password</b> <input class="caixa caixa-senha" type="password" name="senha" placeholder="Password"><br>
                        <!-- Inicio configuração checkbox -->
                        <p class="letra">
                            <input class="caixa-checkbox" type="checkbox"> Remember my email until next time
                        </p>
                        <input id="botao-login" type="submit" value="Login" name="logar">
                    </form>
			    </p>
			    <!-- Link forgot senha/email -->
			    <p>
			        <a href="lembrar.php" class="link-forgot">I forgot my password</a><br>
			        <a href="#" class="link-forgot">I forgot which email address I used TESTE TESTE TESTE</a>
			    </p>
		    </div>
		</div>
	</body>
</html>