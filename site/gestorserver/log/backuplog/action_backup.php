<?php
// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) session_start();
$nivel_necessario = 5;
// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] > $nivel_necessario)) {
	// Destr�i a sess�o por seguran�a
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: /site/login/index.php"); exit;
}
?>
<?php
require '../../../Connections/site.php';
mysql_select_db($database_site, $site);
$data_hora = date("YmdHis");
$comando = "mysqldump -u $username_site -p$password_site Syslog > /var/www/html/site/gestorserver/log/backuplog/$data_hora.sql";
//echo $comando;
$output = shell_exec($comando);

//exit;
//$output = shell_exec('ls -lart');
echo "<pre>$output</pre>";

echo "<script type='text/javascript'> alert('Backup realizado com data e hora atual confira na lista no menu status do servidor o novo arquivo criado.');</script>"; 
echo '<head><meta http-equiv=refresh content="0; URL=/site/gestorserver/log/?pagina=status"></head>';
?>