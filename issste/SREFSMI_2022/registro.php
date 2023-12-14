<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>
Instituto Mexicano del Seguro Social
</title>
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="include/fixedheadertable/defaultTheme.css" media="screen" />
<script src="include/validacionesvf6.js" type="text/javascript"></script>
<script type="text/javascript" src="include/fixedheadertable/jquery.min_1.7.2.js"></script>
<script type="text/javascript" src="include/fixedheadertable/jquery.fixedheadertable.min.js"></script>
<script type="text/javascript" src="include/fixedheadertable/demo.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<style>
#customers
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
/*width:100%;*/
border-collapse:collapse;
}
#customers td, #customers th 
{
font-size:1 em;
border:1px solid #98bf21;
padding:1px 3px 1px 3px;
}
#customers th 
{
font-size:14px; 
text-align:left;
padding-top:0px;
padding-bottom:0px;
background-color:#669900;
color:#fff;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
.Estilo6 {font-size: 11pt}
.highlight {color:red;}
.textfieldRequiredMsg, .selectRequiredMsg
{
display: inline;
	color: #CC3333;
	border: 1px solid #CC3333;
}
input[type="text"]
{
background-color:white;
}
label {
cursor:pointer;
color: black; 
background-color: transparent;
}
td {
word-break: break-word;
white-space: normal;
 }
/*.tableFixHead { overflow-y: auto; height: 600px; }
.tableFixHead thead th { position: sticky; top: 0; }*/
/*.table {
  table-layout: fixed;
 }*/ 
</style>
</head>
<body>
<?php 
include 'conexion.php';
include 'Encabezado.php';
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
mysql_set_charset("utf8");
if(is_numeric($del))
$entidad="Entidad Federativa ";
else
$entidad=""; 
?>
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" width="32"></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_ayuda_2021_issste_2022_2022.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong><label onClick="">Guía de Ayuda</label></strong></td>
<td width="80"><a href="#" onClick="document.getElementById('regresar').submit();"><img src="Imagenes/regresar.jpg" alt="atras" border="0" width="34"/></a><br><strong><label onClick="document.getElementById('regresar').submit();">Regresar</label></strong></td>
</tr>
</table>
<form name="regresar" id="regresar" method="POST" action="grupoyespecialidad2.php">
<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto" >
<input type="text" name="clues" id="clues" value="<?php echo $clues; ?>" class="CampoOculto">
<input type="text" name="clp" id="clp" value="<?php echo $clp; ?>" class="CampoOculto" >
<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" class="CampoOculto" >
<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" class="CampoOculto" >
<input type="text" name="servicio" id="servicio" value="<?php echo $servicio; ?>" class="CampoOculto" >
<input type="text" name="grupo" id="grupo" value="<?php echo $grupo; ?>" class="CampoOculto" >
<input type="text" name="opcion" id="opcion" value="<?php echo $opcion; ?>" class="CampoOculto" >
</form>

<!--
<div style="height:15px"></div>
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php //echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 

    </th>
  </tr>
</table>-->
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:16px; font-weight:bold">
<?php echo $entidad." ".$delegoumae;?><br>
<?php echo "CLUES: ".$clues;?><?php echo " / Unidad Médica: ".$nom_sec;?><br><br>

<?php echo $servicio;?><br>
<?php echo "Grupo de Servicio: ".$grupo;?><br>
<?php echo "Especialidad: ".$especialidad;?>
</div>
<br>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
Paso 6.- Llenar la siguiente tabla, la cual contiene los productos de acuerdo al Grupo de Servicio y Especialidad seleccionados.</div>
<form name="form2" method="post" action="guardar.php">
<input type="text" name="excedenteofaltante" id="excedenteofaltante" value="1" class="CampoOculto">
<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto" >
<input type="text" name="clues" id="clues" value="<?php echo $clues; ?>" class="CampoOculto">
<input type="text" name="clp" id="clp" value="<?php echo $clp; ?>" class="CampoOculto" >
<input type="text" name="tipo" id="tipo" value="<?php echo $tipo; ?>" class="CampoOculto" >
<input type="text" name="numero" id="numero" value="<?php echo $numero; ?>" class="CampoOculto" >
<input type="text" name="localidad" id="localidad" value="<?php echo $localidad; ?>" class="CampoOculto" >
<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" class="CampoOculto">
<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" class="CampoOculto">
<input type="text" name="grupo" id="grupo" value="<?php echo $grupo; ?>" class="CampoOculto">
<input type="text" name="especialidad" id="especialidad" value="<?php echo $especialidad; ?>" class="CampoOculto">
<?php
$grupo=$grupo;
$especialidad=($especialidad);
$query=mysql_query("
SELECT
a.desc_area,
a.desc_serv,
a.cont_AGCIS,
a.cod_AGCIS,
a.cod_AGCIS_715,
a.categoria,
a.esp_der,
a.gpo,
a.sub_gpo,
a.cod_inst,
a.unidad_medida,
a.gpo_serv,
a.esp_tron_o_serv,
a.producto,
b.excedentea,
b.excedenteh,
b.faltantea,
b.faltanteh,
b.causa, 
b.pacientes
FROM
cat_id_sec_issste_2022  a LEFT JOIN requerimiento_issste_2022  b ON a.producto=b.producto AND clp='$clp'
WHERE
/*gpo_serv='$grupo'*/
gpo_serv='$grupo' AND
esp_tron_o_serv='$especialidad'
ORDER BY 
producto
");
?>
<br>
		<table <?php if(mysql_num_rows($query)>20) echo 'width="1360"';?> id="customers" align="center" border="0" style="border-collapse:collapse;" >
	<tr>
	<td style="border:hidden">
	<div align="left" style="background-color:#FFF; border:0; color:#000; font-size:12px;">
<strong>Nota 1: </strong> cantidad m&iacute;nima 1. En caso de no tener excedente o faltante de algún producto, dejar cuadros de texto vacíos.<br>
<strong>Nota 2: </strong> para mayor información, contacte al Enlace Estatal para el intercambio de Servicios.<br>

	</td>
	</tr>
	<div id="contenido">
	<tr>
	<td style="border:hidden">
	<img id="cargando" src="Imagenes/cargando2.gif" width="">
	<label id="porcentaje" style="display:block"></label>
	</td>
	</tr>
  <tr>
    <td style="border:hidden">
	<table name='tabla1' align="center" border="0" <?php if(mysql_num_rows($query)>20) echo 'id="tabla1"'; if($grupo=='Hemodiálisis' || $grupo=="Cuidados Intensivos" || $grupo=="Producto y Pruebas de Banco de Sangre" || $grupo=="Pruebas físicas" || $grupo=="Quimioterapia" || $grupo=="Audiología y Foniatria") echo 'width="1360"'; ?> style="border-collapse:collapse;">    
        <thead>          
          <tr>
            <th width="32" rowspan="2" style="vertical-align:middle"><div align="center">No.</div></th>
            <th width="374" rowspan="2" style="vertical-align:middle">
			<div align="center">
			Producto<br>
            Buscar <input type="text" name="buscar" id="buscar" size="40" onKeyPress="if (event.keyCode == 13 || event.keyCode == 59) event.returnValue = false;" onKeyUp="fbuscar(this.value)">
			</div></th>
			 <th colspan="3" style="vertical-align:middle" ><div align="center"> Faltante <br>
            Cantidad  de Eventos Mensuales </div></th>
            <th colspan="2" style="vertical-align:middle" ><div align="center">Excedente<br>
            Cantidad de Eventos Mensuales </div></th>           
            <th width="106" style="vertical-align:middle" rowspan="2"><div align="center">Pacientes<br>
            Mensuales</div></th>
            <th width="106" style="vertical-align:middle" rowspan="2"><div align="center">Unidad de<br>Medida</div></th>
            <th width="11">&nbsp;</th>
          </tr>
          <tr>
            <th width="100" style="vertical-align:middle"><div align="center"> Ambulatoria</div></th>
            <th width="107" style="vertical-align:middle"><div align="center">Hospitalaria</div></th>
            <th width="167" style="vertical-align:middle"><div align="center">Causa</div></th>			
            <th width="126" style="vertical-align:middle"><div align="center">Ambulatoria</div></th>
            <th width="132" style="vertical-align:middle"><div align="center">Hospitalaria</div></th>
            <th width="11" style="vertical-align:middle"><div align="center">&nbsp;</div></th>			
          </tr>
		  </thead>
<?php 
$causas=array('Carencia de Servicio','Falta de Equipo','Falta de Insumos','Falta de Personal');
while($row=mysql_fetch_array($query))
{
	++$i;
	$gpo= $row["gpo"];
	$unidad_medida= $row["unidad_medida"];
	?>
<tbody>
<tr id="<?php echo "fila".$i;?>" onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')">
<td style="vertical-align:middle"><div align="right"><?php echo $i;?></div></td>
<td width="374" style="vertical-align:middle">
<div align="left"><?php echo $row["producto"];?></div>
<input type="text" name="<?php echo "producto".$i;?>" id="<?php echo "producto".$i;?>" value="<?php echo $row["producto"];?>" class="CampoOculto"></td>

<td style="vertical-align:middle" id="<?php echo "tdfaltantea".$i;?>">
<input type="text" name="<?php echo "faltantea".$i;?>" id="<?php echo "faltantea".$i;?>" size="8" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format(this,<?php echo $i;?>); block('faltantea',<?php echo $i;?>)" style="text-align:right" value="<?php if($row["faltantea"]>0) echo number_format($row["faltantea"],0);?>"></td>
<td style="vertical-align:middle">
<input type="text" name="<?php echo "faltanteh".$i;?>" id="<?php echo "faltanteh".$i;?>" size="8" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format(this,<?php echo $i;?>); block('faltanteh',<?php echo $i;?>)" style="text-align:right" value="<?php if($row["faltanteh"]>0) echo number_format($row["faltanteh"],0);?>"></td>

<td style="vertical-align:middle">
<span id="<?php echo "spryselect".$i;?>">
<select name="<?php echo "causa".$i;?>" id="<?php echo "causa".$i;?>" style="background-color:#FFFFFF" onChange="validacombo('select',this,<?php echo $i;?>)">
<?php
if($row["causa"]=="")
{
	echo '<option value="-1">Seleccione causa principal</option>';
	foreach ($causas as $valor) 
	{
		echo '<option value="'.$valor.'">'.$valor.'</option>';		
	}
}
else 
{
	echo '<option value="'.$row["causa"].'">'.$row["causa"].'</option>';
	foreach ($causas as $valor) 
	{
		if($valor!=$row["causa"])
		{
			echo '<option value="'.$valor.'">'.$valor.'</option>';
		}
	}
	echo '<option value="-1">Seleccione causa principal</option>';
}
?>
</select>
<br>
<span id="<?php echo "selectInvalidMsg".$i;?>" class="selectRequiredMsg" style="display:none">Obligatorio</span></span>
</td>
<td style="vertical-align:middle">
<input type="text" name="<?php echo "excedentea".$i;?>" id="<?php echo "excedentea".$i;?>" size="8" onKeyPress="if(event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format(this,<?php echo $i;?>); block('excedentea',<?php echo $i;?>)" style="text-align:right" value="<?php if($row["excedentea"]>0) echo number_format($row["excedentea"],0);?>"></td>
<td style="vertical-align:middle">
<input type="text" name="<?php echo "excedenteh".$i;?>" id="<?php echo "excedenteh".$i;?>" size="8" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format(this,<?php echo $i;?>); block('excedenteh',<?php echo $i;?>)" style="text-align:right" value="<?php if($row["excedenteh"]>0) echo number_format($row["excedenteh"],0);?>"></td>

<td style="vertical-align:middle">
<span id="<?php echo "sprypacientes".$i;?>">
<input type="text" name="<?php echo "pacientes".$i;?>" id="<?php echo "pacientes".$i;?>" size="8" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format(this,<?php echo $i;?>); block('pacientes',<?php echo $i;?>); validacombo('text',this,<?php echo $i;?>)" style="text-align:right" value="<?php if($row["pacientes"]>0) echo number_format($row["pacientes"],0);?>">
<span id="<?php echo "textfieldRequiredMsg".$i;?>" class="textfieldRequiredMsg" style="display:none">Obligatorio</span></span>
</td>
<td style="vertical-align:middle"><div align="center"><?php echo $unidad_medida; ?></div></td>
</tr>
<?php }?>
<tr id="sincoincidencias" style="display:none">
<td colspan="9" style="color:#FF0000; font-size:15px">Sin coincidencias</td>
</tr>
</tbody>
</table>
	</td>
  </tr>
  </div>
  <tr>
<td colspan="7" align="center" style="background-color:#EAF2D3; border:0">
<input type="text" name="nregistros" id="nregistros" value="<?php echo mysql_num_rows($query);?>" class="CampoOculto">
<input type="submit" name="guardar" id="btnsubmit" value="Guardar" onClick="return gregistro()">
<div id="etiquetaguardar" class="CampoOculto">Espere un momento, guardando información</div>
</td>
</tr>
</table>
</form>
<script language="JavaScript" type="text/javascript">
window.onload=function()
{
	document.getElementById("buscar").focus();
	
	var nregistros=document.getElementById("nregistros").value;
	var excedentea;
	var excedenteh;
	var faltantea;
	var faltanteh;
	var totale;
	var totalf;
	
	var spryselect=[];
	var sprypacientes=[];
	
	for(i=1; i<=nregistros; i++)
	{
		spryselect[i]=new Spry.Widget.ValidationSelect("spryselect"+i, {invalidValue:"-1", validateOn:["blur", "change"]});		
		sprypacientes[i]=new Spry.Widget.ValidationTextField("sprypacientes"+i, "none", {validateOn:["blur", "change"]});
		
		excedentea=document.getElementById('excedentea'+i).value;
		excedenteh=document.getElementById('excedenteh'+i).value;		
		faltantea=document.getElementById('faltantea'+i).value;
		faltanteh=document.getElementById('faltanteh'+i).value;
		totale=excedentea+excedenteh;	
		totalf=faltantea+faltanteh;
		
		if(totale=="" && totalf=="")
		{
			document.getElementById('excedentea'+i).style.backgroundColor="white";
			document.getElementById('excedentea'+i).disabled='';						
			document.getElementById('excedenteh'+i).style.backgroundColor="white";
			document.getElementById('excedenteh'+i).disabled='';			
			document.getElementById('faltantea'+i).style.backgroundColor="white";
			document.getElementById('faltantea'+i).disabled='';						
			document.getElementById('faltanteh'+i).style.backgroundColor="white";
			document.getElementById('faltanteh'+i).disabled='';
			
			document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).style.display='none';
			
			document.getElementById('pacientes'+i).disabled='disabled';
			document.getElementById('pacientes'+i).style.display='none';			
		}
		else if(totale!="")
		{
			document.getElementById('faltantea'+i).style.backgroundColor="#CCC";
			document.getElementById('faltantea'+i).disabled='disabled';
			
			document.getElementById('faltanteh'+i).style.backgroundColor="#CCC";
			document.getElementById('faltanteh'+i).disabled='disabled';		
	
			document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).style.display='none';
					
			document.getElementById('pacientes'+i).disabled='';
			document.getElementById('pacientes'+i).style.display='';
		}
		else if(totalf!="")
		{
			document.getElementById('excedentea'+i).style.backgroundColor="#CCC";
			document.getElementById('excedentea'+i).disabled='disabled';
			
			document.getElementById('excedenteh'+i).style.backgroundColor="#CCC";
			document.getElementById('excedenteh'+i).disabled='disabled';			
		
			document.getElementById('causa'+i).disabled='';
			document.getElementById('causa'+i).style.display='';
			
			document.getElementById('pacientes'+i).disabled='';
			document.getElementById('pacientes'+i).style.display='';			
		}		
	}
	
	document.getElementById('cargando').style.display='none';	
}
function pintar(objeto,col)
{objeto.bgColor=col;}
</script>
</body>
</html>