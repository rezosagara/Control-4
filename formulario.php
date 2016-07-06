<?php require_once('../Connections/localhost.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO formulario (id_formulario, nombre, telefono, región, estado, correo, dirección) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_formulario'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString($_POST['regin'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['direccin'], "text"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/calendario.js" ></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type='text/javascript'></script>

<script>
function solonumero(e){
  key=e.keyCode || e.which;
 teclado=String.fromCharCode(key);
 numero="0123456789"; 
 especiales="8-37-38-46"; //array
 teclado_especial=false; 
 for(var i in especiales){ 
   if(key==especiales[i]){
   teclado_especial=true;
   		}
  }
  if(numero.indexOf(teclado)==-1 && !teclado_especial){ 
   return false;
   		}
 }
</script>

<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>

<script type="text/javascript"> 
function populate(s1,s2) { 
var s1= document.getElementById(s1);
var s2= document.getElementById(s2);
s2.innerHTML = "";
if (s1.value == "Region I"){
	var optionArray = ["|", "tarapaca|Tarapaca"];
} 
else if (s1.value == "Region II"){
	var optionArray = ["|", "antofagasta|Antofagasta"];
} else if (s1.value == "Region III"){
	var optionArray = ["|", "atacama|Atacama", "coquimbo|Coquimbo"];
} else if (s1.value == "Region IV"){
	var optionArray = ["|", "valparaíso|Valparaíso", "aconcagua|Aconcagua"];
} else if (s1.value == "Region V"){
	var optionArray = ["|", "o'Higgins|O'Higgins", "colchagua|Colchagua"];
} else if (s1.value == "Region VI"){
	var optionArray = ["|", "curicó|Curicó", "colchagua|Colchagua"];
} else if (s1.value == "Region VII"){
	var optionArray = ["|", "ñuble|Ñuble", "concepción|Concepción" , "arauco|Arauco", "biobío|Biobío" , "malleco|Malleco"];
} else if (s1.value == "Region VIII"){
	var optionArray = ["|", "cautín|Cautín"];
}else if (s1.value == "Region IX"){
	var optionArray = ["|", "valdivia|Valdivia", "osorno|Osorno"];
}else if (s1.value == "Region X"){
	var optionArray = ["|", "llanquihue|Llanquihue", "chiloé|Chiloé", "aysen|Aysen"];
} else if (s1.value == "Region XI"){
	var optionArray = ["|", "magallanes|Magallanes"];
} else if (s1.value == "Region XII"){
	var optionArray = ["|", "Santiago|santiago"];
}
for (var option in optionArray){
var pair = optionArray [option].split ("|");
var newOption = document.createElement("option");
newOption.value = pair[0];
newOption.innerHTML = pair[1];
s2.options.add(newOption);
	}
} 
</script> 
<script>
function validarEmail(valor) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
   alert("La dirección de email " + valor + " es correcta.");
  } else {
   alert("La dirección de email es incorrecta.");
  }
}
</script>
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="" size="32" onkeypress="return soloLetras(event)" oncopy="return false" onpaste="return false" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Telefono:</td>
      <td><input type="text" name="telefono" value="" size="32"onkeypress="return solonumero(event)" oncopy="return false" onpaste="return false" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Región:</td>
      <td><label>
        <select name="Region" required="required" size="1" id="Region" onchange="populate(this.id,'provincia' )">
        <option></option>
  		  <option value="Region I">I - Tarapacá</option>
          <option value="Region II">II - Antofagasta</option>
          <option value="Region III">III - Atacama</option>
          <option value="Region IV">IV - Coquimbo</option>
          <option value="Region V">V - Valparaíso</option>
          <option value="Region VI">VI - O'Higgins</option>
          <option value="Region VII">VII - Maule</option>
          <option value="Region VIII">VIII - Biobío</option>
          <option value="Region IX">IX - Araucanía</option>
          <option value="Region X">X - Los Lagos</option>
          <option value="Region XI">XI - Aysén</option>
          <option value="Region XII">XII - Magallanes</option>
        </select>
		
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Provincia:</td>
      <td><label>

        <select name="provincia" required="Region I" size="1" id="provincia">
 <!--       <option></option>
  		  <option>Tarapacá</option>
		</select>
	

<select name="region" required="required" size="1" id="Region II">
 <option></option>
          <option>Antofagasta</option>
		  </select>

	
	


		<!-- <select name="region" required="required" size="1" id="Region III">
        <option></option>
          <option>Atacama</option>
		  <option>Coquimbo</option>
		 </select>
		 <select name="region" required="required" size="1" id="Region IV">
        <option></option>
          <option>Valparaíso</option>
		  <option>Aconcagua</option>
		 </select>
		 <select name="region" required="required" size="1" id="Region V">
        <option></option>
          <option>O'Higgins</option>
		   <option>Colchagua</option>
		</select>
		<select name="region" required="required" size="1" id="Region VI">
        <option></option>
		<option>Curicó</option>
		<option> Talca</option>
		<option>Maule</option>
		<option>Linares</option>
		</select>
		<select name="region" required="required" size="1" id="Region VII">
        <option></option>
		<option>Ñuble</option>
		<option>Concepción</option>
		<option>Arauco</option>
		<option>Biobío</option>
		<option>Malleco</option>
		</select>
		<select name="region" required="required" size="1" id="Region VIII">
        <option></option>
          <option>Cautín</option>
		</select>
          <select name="region" required="required" size="1" id="Region IX">
        <option></option>
					<option>Valdivia</option>
		 			<option>Osorno</option>
		</select>
		<select name="region" required="required" size="1" id="Region X">
        <option></option>
					<option>Llanquihue</option>
		 			<option>Chiloé</option>
					<option>Aysen</option>
		</select>
          <select name="region" required="required" size="1" id="Region XI">
        <option></option>
					<option>Magallanes</option>
		</select>
          <select name="region" required="required" size="1" id="Region XII">
        <option></option>
					<option>Santiago</option>
		</select>
        </select>
          -->
        
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Correo:</td>
      <td><input type="text" name="correo" value="" size="32" ></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dirección:</td>
      <td><input type="text" name="direccin" value="" size="32"  oncopy="return false" onpaste="return false" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>

