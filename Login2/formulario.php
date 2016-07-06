<?php require_once('../Connections/localhost.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<?php
mysql_select_db($database_localhost, $localhost);
$query_formulario = "SELECT * FROM formulario";
$formulario = mysql_query($query_formulario, $localhost) or die(mysql_error());
$row_formulario = mysql_fetch_assoc($formulario);
$totalRows_formulario = mysql_num_rows($formulario);
?>

</body>
</html>
<?php
mysql_free_result($formulario);
?>
