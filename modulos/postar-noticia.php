<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">

  tinyMCE.init({

    // General options

    mode : "textareas",

    theme : "advanced",

    plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",



    // Theme options

    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect",

    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",

    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,forecolor,backcolor",

    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,undo,redo,|,cite,abbr,acronym,del,|,print,|,ltr,rtl,|,fullscreen,|,charmap,iespell,media,advhr",

    theme_advanced_toolbar_location : "top",

    theme_advanced_toolbar_align : "left",

    theme_advanced_statusbar_location : "bottom",

    theme_advanced_resizing : true,



    // Example content CSS (should be your site CSS)

    content_css : "css/content.css",



    // Drop lists for link/image/media/template dialogs

    template_external_list_url : "lists/template_list.js",

    external_link_list_url : "lists/link_list.js",

    external_image_list_url : "lists/image_list.js",

    media_external_list_url : "lists/media_list.js",



    // Replace values for the template plugin

    template_replace_values : {

      username : "Some User",

      staffid : "991234"

    }

  });

</script>
<style>
body {
  margin:0;
  padding:0;
  list-style:none;
}
</style>
<?php

  // Codigo para editar noticia

  // variaveis
  $eu = $_SESSION["adm_id"];
  $data = date('Y-m-d H:i:s');
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $status = $_POST['status'];
  $altura = $_POST['altura'];
  $largura = $_POST['largura'];
  $categoria = $_POST['categoria'];
  $foto = $_FILES['imagem'];
        $sql1 = mysqli_query($conexao, "SELECT * FROM produtos WHERE id='$id'");
        $maiorvalor = mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id_ordem+1 DESC LIMIT 1");
        $mostrar_valor = mysqli_fetch_array($maiorvalor);
        $valor = $mostrar_valor['id_ordem']+1;
        $exibe = mysqli_fetch_array($sql1);
        $url = NormalizaURL($nome);
        if($_POST){
        if(!empty($foto["name"])){
        // Verifica se o arquivo é uma imagem
        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso n&atilde;o &eacute; uma imagem.";
              }
        // Se não houver nenhum erro
        if(count($error) == 0) {
          preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
          $caminho_imagem = "uplouds/".$nome_imagem;
          move_uploaded_file($foto["tmp_name"], $caminho_imagem);
          echo "<script>alert('Produto postado!');</script>";
          mysqli_query($conexao, "INSERT INTO produtos (nome, descricao, largura, altura, categoria, status, imagem, data, criador, url, id_ordem) VALUES ('$nome','$descricao','$largura','$altura','$categoria','$status','$nome_imagem','$data','$eu','$url','$valor')");

          header('Refresh:0');

    
        }else{
          foreach($error as $erro){
            echo $erro;
          }
        }
      }else{
        echo "<script>alert('Produto postado!');</script>";
         mysqli_query($conexao, "INSERT INTO produtos (nome, descricao, largura, altura, categoria, status, imagem, data, criador, url, id_ordem) VALUES ('$nome','$descricao','$largura','$altura','$categoria','$status','uplouds/padrao.png','$data','$eu','$url','$valor')");
        header('Refresh:0'); 

      }
    }




$sql = mysqli_query($conexao, "SELECT * FROM produtos WHERE id='$id'");
$item = mysqli_fetch_array($sql);
$dados_produtos = mysqli_query($conexao, "SELECT * FROM categorias WHERE status='ativo' LIMIT 20");
//$item_cad = mysqli_fetch_array($cad_noticia);
?>
   <form method="post" enctype="multipart/form-data">
	<div id="bx_inicio">Postar produto</div>
    <div id="conteudo">Nome:
    		<form>
			<input type="text" id="input_padrao" size="80px" name="nome"">
            	<br />
            	Descrição:
            	<br>
				<input name="descricao" type="text" id="input_padrao" size="80px" />
        <br>
        <div id="conteudo">Largura:
    		<form>
			<input type="text" id="input_padrao" size="80px" name="largura"">
            	<br />
        <div id="conteudo">Altura:
    		<form>
			<input type="text" id="input_padrao" size="80px" name="altura"">
            	<br />
         Categoria:
              <br>
				 <select name="categoria" id="input_padrao">
              			<?php while($fetch = mysqli_fetch_array($dados_produtos)){
          echo '<option value="'.$fetch['id'].'">'.$fetch['nome'].'</option>';
          }?>
				</select> 
				<br />   
        Imagem: <span style="font-size:11px;"></span><br>
    <a href="uplouds/padrao.png" rel="shadowbox" onMouseOver="tooltip.show('Ampliar');" onMouseOut="tooltip.hide();"><img src="uplouds/padrao.png" width="210" height="114"></a><br>
    <input type="file" name="imagem"><br>
                <br />
            	
             
				  Status:
              <br>
				 <select name="status" id="input_padrao">
              			<option value="ativo">Ativo</option>
              			<option value="inativo">Inativo</option>
				</select> 
				<br />
        
         
				<input name="submit"  type="submit" id="submit_padrao" value="Publicar" />
			</form>
	</div>


