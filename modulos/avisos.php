
<div id="bx_inicio">Olá <?php echo $ver['usuario']; ?></div>
  <div id="titulo_conteudo">Anotações / Avisos</div>
     <div id="aviso">
     	<?php 
     	 $sql = mysqli_query($conexao, "SELECT * FROM gc_avisos ORDER BY id DESC LIMIT 30");
	while($ver = mysqli_fetch_array($sql)){
	?>
    	<div id="aviso_t">
    	  <p><font style="font-size: 16px; font-weight:500;"><?php echo $ver['titulo'];?></font><br /><br/>

      Sistema de gerenciamento de conteúdo o Astro é um aplicativo utilizado para criar, editar, gerenciar e publicar conteúdo em plataformas digitais, permitindo que o mesmo seja modificado, removido e adicionado sem a necessidade do conhecimento</p></div>
      
  </div>


<?php }?>
