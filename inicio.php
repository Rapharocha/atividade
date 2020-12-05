<?php

$server = "localhost";
$user = "root";
$password = "";
$banco = "teste";

//criar uma conexão
$conexao = new mysqli($server, $user, $password, $banco);

// Testar a conexão
if($conexao -> connect_error)
	echo "A conexão falhou: ".$conexao -> connect_error;

$result = $conexao -> query("SELECT * FROM alunos");

if(isset($_GET['alt']))
{
	$resultAlt = $conexao -> query("SELECT * FROM alunos where AlunosID = ".$_GET['alt'] );

	foreach ($resultAlt as $row) 
	{
		$AlunosIDAlt = $row["AlunosID"];
		$NomeAlt = $row["Nome"];
		$IdadeAlt = $row["Idade"];
		$SexoAlt = $row["Sexo"];
		$CidAlt = $row["Cidade"];
		$EnderecoAlt = $row["Endereco"];
	}
	$action = "action=\"CRUD.php?btnUpdate=Salvar&nome=$NomeAlt&idade=$IdadeAlt&selectSexo=$SexoAlt&cidade=$CidAlt&Endereco=$EnderecoAlt&AlunosID=$AlunosIDAlt\"";
	$method = "GET";

} else {
	$action =  "action=\"CRUD.php\"";
	$method = "POST";
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="StyleSheet.css">
</head>
<body>
	<form method="<?=$method?>" <?=$action?>>
		<a href="index.php">Voltar</a>
		<div class="container">
		<table>
				<h2>Cadastro de alunos</h2>

		
			
			<input type="hidden" name="AlunosID" value="<?php if(!empty($AlunosIDAlt)) echo $AlunosIDAlt; ?>">
			<label for="nome" class="dados">Nome: </label>
			<input type="text" class="campo_nome" name="nome" placeholder="Digite seu nome..." id="nome" value="<?php if(!empty($NomeAlt)) echo $NomeAlt; ?>" required>
			

		
			<label for="idade" class="dados">Idade: </label>
			<input type="text" class="campo_idade" name="idade" placeholder="Digite sua idade..." id="idade"  value="<?php if(!empty($IdadeAlt)) echo $IdadeAlt; ?>" required>
			

			
			<label for="cidade" class="dados">Cidade: </label>
			<input type="text" class="campo_cidade" name="cidade" placeholder="Digite sua Cidade..." id="cidade" value="<?php if(!empty($CidAlt)) echo $CidAlt; ?>" required>
			
		
		
		<label for="endereco" class="dados">Endereco: </label>
		<input type="text" class="campo_endereco" name="endereco" placeholder="Digite seu Endereco..." id="endereco"  value="<?php if(!empty($enderecoAlt)) echo $enderecoAlt; ?>" required>
			
		<label for="selectSexo" class="dados">Sexo: </label>
		<select class="campo_sexo" name="selectSexo" required>
			<option value="" disabled selected>Escolha um Sexo</option>
			<?php

				if(!empty($SexoAlt))
				{
					if($SexoAlt == "F")
					{
						echo "<option value=\"$SexoAlt\" selected>Feminino</option>";
						echo "<option value=M>Masculino</option>";	
					}
					else
					{
						echo "<option value=\"$SexoAlt\" selected>Masculino</option>";
						echo "<option value=F>Feminino</option>";	
					}
				}
				else
				{
					echo "<option value=M>Masculino</option>";
					echo "<option value=F>Feminino</option>";
				}

			?>
			

		
			
		<?php if (!empty($_GET['alt'])): ?>			
			<input type="submit" value="Salvar" name="btnUpdate">
		<?php else:	?>
			<input type="submit" value="Salvar" name="btnSalvar">
		<?php endif	?>	
					
		
		
		</select>
		</table>

		<br/>
		<br/>




		<br/>
		<br/>

		<table border="" class="table">
			<tr> 
				<td class="tabela_nome"> 
					Nome
				</td>
				<td class="tabela_nome"> 
					Idade
				</td>
				<td class="tabela_nome"> 
					Sexo
				</td>
				<td class="tabela_nome"> 
					Cidade
				</td>
				<td class="tabela_nome"> 
					Endereco
				</td>
			</tr>

			<?php
				foreach ($result as $row) 
				{
			?>
					<tr> 
						<td> 
							<?php echo $row["Nome"] ?>
						</td>
						<td> 
							<?php echo $row["Idade"] ?>
						</td>
						<td> 
							<?php echo $row["Sexo"] ?>
						</td >
						<td> 
							<?php echo $row["Cidade"] ?>
						</td>
						<td> 
							<?php echo $row["Endereco"] ?>
						</td>
						<td>
							<a href="inicio.php?alt=<?php echo $row["AlunosID"] ?>">Alterar</a>
						</td>
						<td>
							<a href="CRUD.php?del=<?php echo $row["AlunosID"] ?>">Excluir</a>
						</td>
					</tr>
			<?php
				}
			?>			

		</table>

	</div>

	</form>

</body>
</html>




