<?php
	$servidor = "localhost";
	$usuario = "locatell_site";
	$senha = "locatelli2011@";
	$dbname = "locatell_site";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	

$array_aulas = $_POST['arrayordem'];

$cont_ordem = 1;
foreach($array_aulas as $id_aula){
	$result_aulas = "UPDATE categorias SET id_ordem = $cont_ordem WHERE cad_ordem_item = $array_aulas";
	$resultado_aulas = mysqli_query($conn, $result_aulas);	
	$cont_ordem++;
}
echo "<span style='color: green;'>Alterado com sucesso</span>";