<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
  <style type="text/css">
    .dragHelper{
                display: block;
                padding: 30px;
                margin-top: 10px;
                background: #fff;
                border: 2px dashed #c2cdda;
                border-radius: 3px;
                text-align: center;
                -webkit-transition: background-color 0.2s ease;
                transition: background-color 0.2s ease;
            }   
</style>
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

	<div id="base_celulas" class="sortable">
		    <?php
    $tipo = $_GET['tipo'];
    $id = (int) $_GET['id'];
	if($tipo == 'apagar'){
	mysqli_query($conexao, "DELETE FROM produtos WHERE categoria='$id'");
	}
    $sql = mysqli_query($conexao, "SELECT * FROM produtos WHERE categoria='$id' ORDER BY id_ordem ASC");
	while($ver = mysqli_fetch_array($sql)){
	?>
		<div id ="<?php echo $ver['id']; ?>">
		<div id="dados_celula">
			<div id="id_foto" style="background-image: url(uplouds/<?php echo $ver['imagem']; ?>);"></div>
			<div id="titulo_celula"><?php echo Encurta($ver['nome'],40); ?><br /><font style="color: #838383; font-size: 12px;"><?php echo Encurta($ver['descricao'],60); ?></font></div>
			<div id="<?php if($ver['status'] == 'ativo'){echo "status_celula";}else{echo "status_celula-inativo";}?>"><?php echo $ver['status']; ?></div>
			<div id="data_celula"><?php echo $ver['data'];?><br /><font style="color: #838383; font-size: 13px;"></font></div>
            <div id="opcoes_celula"><a href="index.php?link=edit-noticias&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="media/imgs/editar.png" width="17" height="17" /></a>&nbsp;&nbsp;&nbsp;<img src="media/imgs/excluir.png" width="15" height="18" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;" /></div>
        </div>
    </div>
       <?php } ?>
   <script type="text/javascript">
    
    $(function(){
       
            $(".sortable").sortable({
                connectWith: ".sortable",
                placeholder: 'dragHelper',
                scroll: true,
                revert: true,
                cursor: "move",
                update: function(event, ui) {
                     var cad_id_item_list = $(this).sortable('toArray').toString();
                     $.ajax({
                         url: '/painel/modulos/cad_ordenar_item1.php',
                         type: 'POST',
                         data: {cad_id_item : cad_id_item_list},
                         success: function(data) {
                            
                         }
                     });
                },
                start: function( event, ui ) {
                                                
                },
                stop: function( event, ui ) {
                     
                }
            });
        }); 

</script>    
