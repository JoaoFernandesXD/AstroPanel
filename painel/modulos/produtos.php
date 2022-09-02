
        <div class="pagina">
            <div class="titulo">
                <font style="font-family: Manrope ExtraLight">Nossos</font>
                <font style="font-family: Manrope ExtraBold">produtos</font>
            </div>
        </div>
        <div class="barra_bg_cinza">
            <div class="catalogo">
                <div class="container">
                    <div class="row">
                         <?php
                        $sql = mysqli_query($conexao, "SELECT * FROM categorias WHERE status='ativo' order by id desc
 LIMIT 99");
                        while ($exibe = mysqli_fetch_assoc($sql)) {
                            ?>
                        <div class="col-lg-4 col-sm-6">
                            <a href="<?php echo $install['diretorio']; ?>categoria/<?php echo $exibe['id']; ?>">
                                <div class="base">
                                    <div class="icon"><img src="<?php echo $exibe['imagem']; ?>"/></div>
                                    <div class="informacoes"><?php echo $exibe['nome']; ?></div>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
       