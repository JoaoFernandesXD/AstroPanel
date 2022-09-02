        

        <link href="<?php echo $install['diretorio']; ?>bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="<?php echo $install['diretorio']; ?>css/estilo.css" type="text/css" rel="stylesheet">

<?php
$tipo = $_GET['tipo'];
$id = (int) $_GET['id'];
$sql = mysqli_query($conexao, "SELECT * FROM contato WHERE id='$id'");
$item = mysqli_fetch_array($sql);
?>
              
                  
                  <form method="post" enctype="multipart/form-data">
    <div id="bx_inicio">Detalhes contato</div>
    <div id="conteudo">Nome:
            <form>
            <input type="text" id="input_padrao" size="80px" name="titulo" disabled="disabled" value="<?php echo $item['nome']; ?>">
                <br />
                E-mail
               <input type="text" id="input_padrao" size="80px" name="titulo" disabled="disabled" value="<?php echo $item['email']; ?>">
               <br>

               <textarea type="text" id="input_padrao" size="80px" name="titulo" disabled="disabled" value="" style="height: 300px;"><?php echo $item['mensagem']; ?></textarea>
            </form>
    </div>