
  <div id="bx_inicio">Produtos</div>
  <a href="index.php?link=postar-noticia"><div id="pag-inicial">Postar produtos</div></a>
  <br>
  <br>
  <div id="barra_celulas">
		<div id="m_c_a">Imagem</div>
		<div id="m_c_t">Produto</div>
		<div id="m_c_s">Status</div>
		<div id="m_c_d">Data de cadastro</div>
		<div id="m_c_o">Opções</div>
  </div>
  <script>
var apagar = {
	sim:function(id){
		if(confirm('Tem certeza que deseja apagar ?')){
			$.ajax({
				type:'GET',
				url:'index.php?link=noticias&tipo=apagar&id='+id,
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
    $tipo = $_GET['tipo'];
    $id = (int) $_GET['id'];
	if($tipo == 'apagar'){
	mysqli_query($conexao, "DELETE FROM produtos WHERE id='$id'");
	}
    $sql = mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id DESC LIMIT 999");
	while($ver = mysqli_fetch_array($sql)){
	?>
		<div id="dados_celula">
			<div id="id_foto" style="background-image: url(uplouds/<?php echo $ver['imagem']; ?>);"></div>
			<div id="titulo_celula"><?php echo Encurta($ver['nome'],40); ?><br /><font style="color: #838383; font-size: 12px;"><?php echo Encurta($ver['descricao'],60); ?></font></div>
			<div id="<?php if($ver['status'] == 'ativo'){echo "status_celula";}else{echo "status_celula-inativo";}?>"><?php echo $ver['status']; ?></div>
			<div id="data_celula"><?php echo $ver['data'];?><br /><font style="color: #838383; font-size: 13px;"></font></div>
            <div id="opcoes_celula"><a href="index.php?link=edit-noticias&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="media/imgs/editar.png" width="17" height="17" /></a>&nbsp;&nbsp;&nbsp;<img src="media/imgs/excluir.png" width="15" height="18" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;" /></div>
        </div>
       <?php } ?>
       
