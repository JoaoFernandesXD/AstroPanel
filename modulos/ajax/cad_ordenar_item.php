<?php
	
	$conexao = new mysqli ("localhost","","","");
	mysqli_set_charset($conexao, "utf-8");


	$cad_id_item = $_POST["cad_id_item"];


	$arr_item = explode(",", $cad_id_item);


	$ordem = 1;

	foreach ($arr_item as $arr_item) {
		
			$sql = "UPDATE categorias SET cad_ordem_item = $ordem WHERE id= $arr_item";

			$execute = $conexao->query($sql) or die(mysqli_error($conexao));

		$ordem++;
	}


?>
