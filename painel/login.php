<?php
session_start(); // Inicia a sessão
date_default_timezone_set('America/Sao_Paulo');
// config
include ("painel-config/config.php");
// data
$data = time();
// pegar ip
$ip = $_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['adm_usuario'])) {
    unset($_SESSION["adm_id"]);
    unset($_SESSION["adm_nome"]);
    unset($_SESSION['login']);
}
?>
<html>
    <head>
        <title>Astro · Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/imagens/favicon.png" type="image/x-icon"/>
        <link href="media/css/login.css" type="text/css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    <script>
    var login = {
            iniciar: function ()
            {
                $('#submit').click(function ()
                {
                    var id = 0;
                    var usuario = $.trim($('#user').val());
                    var senha = $.trim($('#password').val());
                    if (usuario == '' || senha == '')
                    {
                        //login.alerta('1', 'vermelho', 'Preencha todo os campos!');
                        alert('Preencha todo os campos!');
                      
                    } else{
                        $.ajax({
                            url: "painel-config/processar.php",
                            type: 'POST',
                            data: {'usuario': usuario, 'senha': senha},
                            dataType: 'json',
                            beforeSend: function ()
                            {
                                $('#b_f_login').animate({opacity: 0.5});

                            },success: function(html)
                            {
                                $('#b_f_login').animate({opacity: 1});

                                if (html == 'deu')
                                {
                                    //login.alerta('1', 'verde', 'Logado com sucesso!');
                                    alert("Logado com sucesso!");
                                    location.href = 'index.php';


                                } else if (html == 'ruim')
                                {
                                    //login.alerta('2', 'vermelho', 'Dados incorretos!');
                                    alert('Dados incorretos!');

                                } else
                                {
                                    login.alerta('0', 'vermelho', html);
                                }

                            }

                        });

                    }

                });
            }, alerta: function (id, cor, conteudo) {
                var html = '';
                var id = 0;
                // verificar cor
                if (cor == 'verde') {
                    html += '<div id="login_sucess"><div id="t_login">';
                } else {
                    html += '<div id="login_error"><div id="t_login">';
                }
                html += conteudo;

                html += '</div>';
                html += '</div>';

                $('#alertas').html(html);
                //$('body').html(html);
            }
        }
        $(document).ready(function () {
            // iniciar funcao
            login.iniciar();
        });

 </script>

  

    <body>
        <div class="login">
            <div class="logo"></div>
            <form action="javascript:;">
            <input type="text" id="user" name="login" placeholder="e-mail">
            <input type="password" id="password" name="senha" placeholder="senha">
            <button name="submit" type="submit" id="submit">entrar</button>
            </form>
        </div>
    </body>
</html>