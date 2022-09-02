<?php
	// config 
	$titulo = "Astro - Admin";
	$siteURL = "";
	$PainelA = "painel";
	// conexao db 
	$dbhost = "localhost";
	$dbuser = "";
	$dbpassword = "@";
	$dbdatabase = "";
 	$conexao = mysqli_connect($dbhost, $dbuser, $dbpassword) or die("<script>location.href=\"http://$siteURL/$PainelA/errodb.php\";</script>");
    mysqli_set_charset('utf8');
	mysqli_select_db($conexao, $dbdatabase) or die("<script>location.href=\"http://$siteURL/$PainelA/errodb.php\";</script>");
   	if (!mysqli_set_charset($conexao, 'utf8')) {
    printf('Error ao usar utf8: %s', mysqli_error($conexao));
    mysql_query("SET NAMES 'utf8'");
    exit;
}
?>

