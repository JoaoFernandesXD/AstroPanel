
  <div id="bx_inicio">Fotos do projeto</div>
  <a href="index.php?link=projeto-foto&id=<?php echo $_GET['id']; ?>"><div id="pag-inicial">Postar fotos</div></a>
  <br>
  <br>
  <div id="barra_celulas">
		<div id="m_c_a">Imagem</div>
		<div id="m_c_t">Título da imagem</div>
		<div id="m_c_d">Data de postagem</div>
		<div id="m_c_o">Opções</div>
  </div>
  <script>
var apagar = {
	sim:function(id){
		if(confirm('Tem certeza que deseja apagar ?')){
			$.ajax({
				type:'GET',
				url:'index.php?link=postar-foto&tipo=apagar&id='+id,
				data:{'id':id},
				success:function(html){
					alert('Apagado com sucesso!');
					location.reload();
				}
			});
		}
	}
}

</script>

	<div id="base_celulas">
		    <?php
    $id = (int) $_GET['id'];
    $tipo = $_GET['tipo'];
      if($tipo == 'apagar'){
 	 mysqli_query($conexao, "DELETE FROM fotos_projeto WHERE id='$id'");
  	}
    $sql = mysqli_query($conexao, "SELECT * FROM fotos_projeto WHERE id_projeto='$id' ORDER BY id  DESC LIMIT 100");
	while($ver = mysqli_fetch_array($sql)){
	?>
		<div id="dados_celula">
			<div id="id_foto" style="background-image: url(uplouds/<?php echo $ver['foto']; ?>);"></div>
			<div id="titulo_celula"><?php echo Encurta($ver['foto'],40); ?><br /><font style="color: #838383; font-size: 12px;"><?php echo Encurta($ver['resumo'],100); ?></font></div>
			<div id="data_celula"><?php echo $ver['data'];?><br /><font style="color: #838383; font-size: 13px;"></font></div>
            <div id="opcoes_celula"><a href="index.php?link=edit-projetoleg&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="media/imgs/editar.png" width="17" height="17" /></a>&nbsp;&nbsp;&nbsp;<img src="media/imgs/excluir.png" width="15" height="18" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;" /></div>
        </div>
       <?php } ?>
      
