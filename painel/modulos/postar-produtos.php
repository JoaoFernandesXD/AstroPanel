<?php

$dados_album = mysqli_query($conexao, "SELECT * FROM categorias WHERE status='ativo'");
    //header('Location: /index.php?link=meus_dados');
$tipo = $_GET['tipo'];
$id = (int) $_GET['id'];
  if($tipo == 'apagar'){
  mysqli_query($conexao, "DELETE FROM fotos_album WHERE id='$id'");
  }
?>
   <form method="post" enctype="multipart/form-data">
	<div id="bx_inicio">Adicionar produtos</div>
    <div id="conteudo">
				
			 Selecione a categoria:
              <br>
         <select name="projeto" id="input_padrao" onchange="location.href=this.value">
           <option value="">Seleciona</option>
          <?php while($fetch = mysqli_fetch_array($dados_album)){
          echo '<option value="index.php?link=list-produtos&id='.$fetch['id'].'">'.$fetch['nome'].'</option>';
                    

          }?>
        </select> <br>

	</div>


