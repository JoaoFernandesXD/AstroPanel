<?php if($ver['cargo'] == '1'){?>

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

$tipo = $_GET['tipo'];
$id = (int) $_GET['id'];
if($tipo == 'editar'){
  // Codigo para editar noticia

  // variaveis

  $data = date('d-m-Y H:i:s');
  $titulo = $_POST['usuario'];
  $status = $_POST['status'];
  $link = $_POST['link'];
  $foto = $_FILES['imagem'];
  $cliente = $_POST['cliente'];
        $sql1 = mysqli_query($conexao, "SELECT * FROM parceiro WHERE id='$id'");
        $exibe = mysqli_fetch_array($sql1);
        if($_POST){
        if(!empty($foto["name"])){
        // Verifica se o arquivo ?? uma imagem
        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso n&atilde;o &eacute; uma imagem.";
              }
        // Se n??o houver nenhum erro
        if(count($error) == 0) {
          preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
          $caminho_imagem = "uplouds/".$nome_imagem;
          move_uploaded_file($foto["tmp_name"], $caminho_imagem);
          echo "<script>alert('Dados atualizados!');</script>";
          mysqli_query($conexao, "UPDATE parceiro SET titulo='$titulo', imagem='$nome_imagem', link='$link', status='$status', parceiros='$cliente' WHERE id='$id'");
          header('Location: ?link=parceiros'); 


    
        }else{
          foreach($error as $erro){
            echo $erro;
          }
        }
      }else{
        echo "<script>alert('Dados atualizados!');</script>";
          mysqli_query($conexao, "UPDATE parceiro SET titulo='$titulo', link='$link', status='$status', parceiros='$cliente' WHERE id='$id'");
          header('Location: ?link=parceiros'); 

      }
    }


}
$sql = mysqli_query($conexao, "SELECT * FROM parceiro WHERE id='$id'");
$item = mysqli_fetch_array($sql);
?>
   <form method="post" enctype="multipart/form-data">
	<div id="bx_inicio">Editar Parceiro</div>
    <div id="conteudo">Nome:
    		<form>
			<input type="text" id="input_padrao" size="80px" name="usuario" value="<?php echo $item['titulo']; ?>">
            	<br />
            	URL (pagina do parceiro):
            	<br>
				<input name="link" type="text" id="input_padrao" size="80px" value="<?php echo $item['link']; ?>" />
        <br>
        Foto: (Perfil)<span style="font-size:11px;"></span><br>
    <a href="uplouds/<?php echo $item['imagem']; ?>" rel="shadowbox" onMouseOver="tooltip.show('Ampliar');" onMouseOut="tooltip.hide();"><img src="uplouds/<?php echo $item['imagem']; ?>" width="150" height="150"></a><br>
    <input type="file" name="imagem"><br>
              
				  Status:
              <br>
				 <select name="status" id="input_padrao">
              			<option value="ativo"<?php if($item['status'] == 'ativo'){echo(' selected');} ?>>Ativo</option>
              			<option value="inativo"<?php if($item['status'] == 'inativo'){echo(' selected');} ?>>Inativo</option>
				</select> 
        <br>
				  Parceiro/cliente:
              <br>
         <select name="cliente" id="input_padrao">
                    <option value="clientes"<?php if($item['parceiros'] == 'clientes'){echo(' selected');} ?>>Clientes</option>
                    <option value="parceiros"<?php if($item['parceiros'] == 'parceiros'){echo(' selected');} ?>>Parceiro</option>
        </select> 
       <br>
			</form>
      <br>
				<input name="submit"  type="submit" id="submit_padrao" value="Editar" />
			
	</div>


<?php  }else{
	header('Location: ?link=avisos'); 
} ?> 