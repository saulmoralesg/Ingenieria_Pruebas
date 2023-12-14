<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Instituto Mexicano del Seguro Social</title>
<script src="include/cajas.js" type="text/javascript"></script>
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>


<script type="text/javascript" src="jquery.min_1.7.2.js"></script>
<script type="text/javascript" src="jquery.fixedheadertable.min.js"></script>
<script type="text/javascript" src="demo.js"></script>
<link rel="stylesheet" href="defaultTheme.css" media="screen" />
<style type="text/css">
* {font-family: Segoe UI;}
body {font-size: 80%;}
table {}
th {text-align: left;}
</style>

<style type="text/css">
textarea {
    text-align:left;
 }
</style>
<style type="text/css">
#customers
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
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
padding-top:4px;
padding-bottom:4px;
background-color:#669900;
color:#fff;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
.Estilo6 {font-size: 11pt}
</style>
</head>
<body>
<form name="form1" method="post" action="Guardar.php">
<?php
$del=$_REQUEST['del'];
$delegoumae=$_REQUEST['delegoumae'];
$clp=$_REQUEST["clp"];
$tipo=$_REQUEST["tipo"];
$numero=$_REQUEST["numero"];
$localidad=$_REQUEST["localidad"];
$pdf=$_REQUEST["pdf"];

$query = mysql_query("SELECT jefe_ser_lb,matricula FROM  lab_gas.jefserlab WHERE jefserlab.clp = '$clp' ");
$unidad=mysql_fetch_array($query);  $jefe=$unidad["jefe_ser_lb"]; $matricula=$unidad["matricula"]; 

//datos de unidad
$query = mysql_query("SELECT respuesta, evidencia FROM captura WHERE clp='$clp' ORDER BY id");
$i=1;
while ($rows = mysql_fetch_array($query, MYSQL_ASSOC)) 
{			
	/*foreach($rows as $k=>$v){
	echo $r[$i]=$v;
	$i++;	
	} */
	$r[$i]=$rows["respuesta"];
	$e[$i]=$rows["evidencia"];	
	++$i;
}
?>
<input name="del" type="text" id="del" value="<?php echo $del;?>" class="CampoOculto">
<input name="delegoumae" type="text" id="delegoumae" value="<?php echo $delegoumae;?>" class="CampoOculto">   
<input name="clp" type="text" id="clp" value="<?php echo $clp;?>" class="CampoOculto">
<input name="tipo" type="text" id="tipo" value="<?php echo $tipo;?>" class="CampoOculto">
<input name="numero" type="text" id="numero" value="<?php echo $numero;?>" class="CampoOculto">
<input name="localidad" type="text" id="localidad" value="<?php echo $localidad;?>" class="CampoOculto">
           
<table width="1226" border="0" align="center" id="customers">      
	<thead>    
    <tr style="background-color:#EAF2D3; font-weight:bold">
      <th width="28"><div align="center">No.</div></th>
      <th width="226"><div align="center">Cl&aacute;usula del Contrato</div></th>
      <th width="226"><div align="center">Anexo/Apartado</div></th>
      <th width="265"><div align="center">Obligaci&oacute;n</div></th>
      <th width="148"><div align="center">Respuesta</div></th>
      <th width="293"><div align="center">&iquest;Cu&aacute;l evidencia tienes?</div></th>
    </tr>
    </thead>
    <tbody>
     <tr onmouseover="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')">
     <td><div align="right"><?php echo 1;?>&nbsp;</div></td>
     <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
     <td><div align="left">Anexo T&eacute;cnico 1A para el Paquete 5 Pruebas Especiales, apartado <strong>&quot;T&eacute;rminos y Condiciones del Servicio&quot;</strong>, primer p&aacute;rrafo.</div></td>
	<td><div align="left">&iquest;El proveedor inici&oacute; el servicio en la Unidad M&eacute;dica a partir del d&iacute;a 61 posterior al fallo?</div></td>
	<td><div align="center"><span id="<?php echo "spryr1";?>">
          <select name="<?php echo "r1";?>" size="1" id="<?php echo "r1";?>" onChange="validacombo(this,1)">
            <?php 
	   if($r[1]==NULL || $r[1]=="")
	   {
		?>  
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[1]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[1];?>"><?php echo $r[1];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[1]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[1];?>"><?php echo $r[1];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
	<td><div align="center">
	  <span id="<?php echo "spryevidencia1";?>">
	    <select name="<?php echo "evidencia1";?>" size="1" id="<?php echo "evidencia1";?>" onChange="validacombo2(this,1)" style="width:200px">
	      <?php 
	   if($e[1]==NULL || $e[1]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option> 
	      <option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>
	      <option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
          <option value="4">4. Sin evidencia</option>            
	      <option value="Otra">5. Otra</option>             
	      <?php 
	  }
	  else if($e[1]==1)
	  {
	  ?>
	   	<option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option> 
	    <option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>
	    <option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
        <option value="4">4. Sin evidencia</option>            
	    <option value="Otra">5. Otra</option>
	    <option value="-1">Seleccione opci&oacute;n</option>                      	      
	      <?php 
		  } 
	  else if($e[1]==2)  
	  {
		?>
		<option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>
		<option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
        <option value="4">4. Sin evidencia</option>  
	    <option value="Otra">5. Otra</option>
   	   	<option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option>           
	    <option value="-1">Seleccione opci&oacute;n</option>                      	      
	  <?php } 
	  else if($e[1]==3)	  
	  {
		  ?>
  		<option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
        <option value="4">4. Sin evidencia</option>  
	    <option value="Otra">5. Otra</option>
   	   	<option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option>           
		<option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>        <option value="-1">Seleccione opci&oacute;n</option>                      	      		  
	  <?php } 
	  else if($e[1]==4)	   
	  {
	  ?>		  
        <option value="4">4. Sin evidencia</option>  
	    <option value="Otra">5. Otra</option>
   	   	<option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option>           
		<option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>        <option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
        <option value="-1">Seleccione opci&oacute;n</option>  
      <?php 	  
	  }	  
       else if(substr($e[1],0,4)=='Otra')	   
	  {
	  ?>		  
	    <option value="Otra">5. Otra</option>
   	   	<option value="1">1. Acta circunstanciada de Entrega Recepci&oacute;n.</option>           
		<option value="2">2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.</option>        <option value="3">3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.</option> 
        <option value="4">4. Sin evidencia</option>  
        <option value="-1">Seleccione opci&oacute;n</option>  
      <?php } ?>
		 </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div><div align="center" id="<?php echo "sugerencia1";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Acta circunstanciada de Entrega Recepci&oacute;n. <br>
      2. Oficio y/o correo de notificaci&oacute;n al proveedor solicitando la entrega.<br>
      3. Oficio de notificaci&oacute;n al proveedor solicitando la entrega.<br>      
 </div>
 <div align="center">
      <span id="<?php echo "spryotra1";?>">        
        <textarea name="<?php echo "otra1";?>" id="<?php echo "otra1";?>" cols="40" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[1]==NULL || $e[1]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[1],5);?></textarea>
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
 </td>
	</tr>  
    <tr>
      <td rowspan="3"><div align="right">2</div></td>
      <td rowspan="3"><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;/ Cl&aacute;usula D&eacute;cima Cuarta: &quot;Deducciones&quot;, segunda fila de la tabla.<br>
      </div></td>
      <td rowspan="3">Anexo T&eacute;cnico 1A para el Paquete 5 Pruebas Especiales, apartado &quot;<strong>Traslado de Muestras&quot;</strong>, sexto p&aacute;rrafo. <strong></strong></td>
      <td>&iquest;El Laboratorio de la Unidad cuenta con un calendario espec&iacute;fico establecido con el proveedor para cada una de las pruebas especiales del paquete 5?</td>
      <td><div align="center"><span id="<?php echo "spryr2a";?>">
          <select name="<?php echo "r2a";?>" size="1" id="<?php echo "r2a";?>" onChange="validacombo(this,'2a')">
            <?php 
	   if($r[2]==NULL || $r[2]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[2]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[2];?>"><?php echo $r[2];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[2]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[2];?>"><?php echo $r[2];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia2a";?>">
	    <select name="<?php echo "evidencia2a";?>" size="1" id="<?php echo "evidencia2a";?>" onChange="validacombo2(this,'2a')" style="width:200px">
	      <?php 
	   if($e[2]==NULL || $e[2]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5.</option> 
	      <option value="2">2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option> 
	      <?php 
	  }
	  else if($e[2]==1)
	  {
	  ?>
	      <option value="1">1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5.</option> 
	      <option value="2">2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option> 
	      <option value="-1">Seleccione opci&oacute;n</option> 	     
	      <?php } 
		  else if($e[2]==2)	  
		  {
			  ?>
	      <option value="2">2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option> 
          <option value="1">1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5.</option>           
	      <option value="-1">Seleccione opci&oacute;n</option>			  
		  <?php } 
		  else if($e[2]==3)	  
		  {		  
		  ?>
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option> 
          <option value="1">1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5.</option>           
          <option value="2">2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.</option> 
	      <option value="-1">Seleccione opci&oacute;n</option>          
          <?php }
          else if(substr($e[2],0,4)=='Otra')		  	  
		  {		  
		  ?>
		  <option value="Otra">4. Otra</option> 
          <option value="1">1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5.</option>           
          <option value="2">2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.</option> 
   	      <option value="3">3. Sin evidencia</option>
	      <option value="-1">Seleccione opci&oacute;n</option>          		 
          <?php } ?>          
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>	  
	  </div>
      <div align="center" id="<?php echo "sugerencia2a";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Calendario espec&iacute;fico establecido con el provedor para cada una de las pruebas del paquete 5. <br>
      2. Minuta de Trabajo conjunta entre personal usuario/administrador del contrato y del proveedor en la que se establezca Calendario espec&iacute;fico.<br>
 </div> <div align="center">
      <span id="<?php echo "spryotra2a";?>">        
        <textarea name="<?php echo "otra2a";?>" id="<?php echo "otra2a";?>" cols="40" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[2]==NULL || $e[2]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[2],5);?></textarea>  
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
      </td>
    </tr>
    <tr>
      <td>&iquest;Las Muestras son recolectadas de manera oportuna conforme al calendario establecido?</td>
      <td><div align="center"><span id="<?php echo "spryr2b";?>">
          <select name="<?php echo "r2b";?>" size="1" id="<?php echo "r2b";?>" onChange="validacombo(this,'2b')">
            <?php 
	   if($r[3]==NULL || $r[3]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[3]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[3];?>"><?php echo $r[3];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[3]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[3];?>"><?php echo $r[3];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia2b";?>">
	    <select name="<?php echo "evidencia2b";?>" size="1" id="<?php echo "evidencia2b";?>" onChange="validacombo2(this,'2b')" style="width:200px">
	      <?php 
	   if($e[3]==NULL || $e[3]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
	      <option value="2">2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
	      <option value="3">3. Sin evidencia</option>  
          <option value="Otra">4. Otra</option> 
	      <?php 
	  }
	  else if($e[3]==1)
	  {?>        
	
	      <option value="1">1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
	      <option value="2">2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
	      <option value="3">3. Sin evidencia</option>  
          <option value="Otra">4. Otra</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php } 
		   else if($e[3]==2)
	  {?>        
	
	      <option value="2">2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
	      <option value="3">3. Sin evidencia</option>  
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
		   <?php } 
		   else if($e[3]==3)
	  {?>           
	      <option value="3">3. Sin evidencia</option>  
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
          <option value="2">2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
            <?php } 
		   else if(substr($e[3],0,4)=='Otra')
	  {?>           
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option> 
          <option value="2">2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</option>
          <option value="3">3. Sin evidencia</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
           <?php } 
		   ?>  
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div><div align="center" id="<?php echo "sugerencia2b";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor. <br>
      2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
 </div>
  <div align="center">
      <span id="<?php echo "spryotra2b";?>">        
        <textarea name="<?php echo "otra2b";?>" id="<?php echo "otra2b";?>" cols="40" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[3]==NULL || $e[3]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[3],5);?></textarea>
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><p>&iquest;Los resultados de laboratorio son entregados de acuerdo a los tiempos establecidos para cada prueba ?</p></td>
      <td><div align="center"><span id="<?php echo "spryr2c";?>">
          <select name="<?php echo "r2c";?>" size="1" id="<?php echo "r2c";?>" onChange="validacombo(this,'2c')">
            <?php 
	   if($r[4]==NULL || $r[4]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[4]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[4];?>"><?php echo $r[4];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[4]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[4];?>"><?php echo $r[4];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia2c";?>">
	    <select name="<?php echo "evidencia2c";?>" size="1" id="<?php echo "evidencia2c";?>" onChange="validacombo2(this,'2c')" style="width:200px">
	      <?php 
	   if($e[4]==NULL || $e[4]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
	      <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option>   
	      <?php 
	  }
	  else  if($e[4]==1)
	  {
	  ?>    
	     
	      <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
	      <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option>  
           <option value="-1">Seleccione opci&oacute;n</option>  
		  <?php } 
		   else  if($e[4]==2)
	  {
	  ?>        
	      <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option> 
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option>  
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
           <option value="-1">Seleccione opci&oacute;n</option> 
		  <?php } 
		   else  if($e[4]==3)
	  {
	  ?>   
	      <option value="3">3. Sin evidencia</option>
		  <option value="Otra">4. Otra</option>  
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option> 
           <option value="-1">Seleccione opci&oacute;n</option> 
         <?php } 
		   else  if(substr($e[4],0,4)=='Otra')
	  {
	  ?>   
	      <option value="Otra">4. Otra</option>  
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option> 
           <option value="3">3. Sin evidencia</option>
           <option value="-1">Seleccione opci&oacute;n</option>  
         <?php 
		 }
           ?>        
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div><div align="center" id="<?php echo "sugerencia2c";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n. <br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).<br>
 </div>
  <div align="center">
      <span id="<?php echo "spryotra2c";?>">        
        <textarea name="<?php echo "otra2c";?>" id="<?php echo "otra2c";?>" cols="40" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[4]==NULL || $e[4]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[4],5);?></textarea>        
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">3</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>Anexo T&eacute;cnico 1A para el Paquete 5 Pruebas Especiales, apartado &quot;Calidad&quot;, tercero y cuarto p&aacute;rrafo.</td>
      <td>&iquest;El proveedor durante la vigencia del contrato, ha proporcionado a la Unidad M&eacute;dica, cuando as&iacute; se le haya requerido:                                                               *Copia del comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA                                                                          *Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero? <br>
(Para acreditar el incumplimiento se debe probar que no se recibieron los documentos descritos y se cuenta con evidencia idonea para acreditar que la Unidad M&eacute;dica recibi&oacute; muestras procesadas sin que el proveedor contara con los documentos) </td>
      <td><div align="center"><span id="<?php echo "spryr3";?>">
          <select name="<?php echo "r3";?>" size="1" id="<?php echo "r3";?>" onChange="validacombo(this,3)">
            <?php 
	   if($r[5]==NULL || $r[5]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[5]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[5];?>"><?php echo $r[5];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[5]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[5];?>"><?php echo $r[5];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia3";?>">
	    <select name="<?php echo "evidencia3";?>" size="1" id="<?php echo "evidencia3";?>" onChange="validacombo2(this,3)" style="width:200px">
	      <?php 
	   if ($e[5]==NULL || $e[5]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
	      <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
	      <option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         
          <option value="4">4. Sin evidencia</option>
          <option value="Otra">5. Otra</option>
              
	      <?php 
	  }
	  else if ($e[5]==1)
	  { ?> 
	      <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
	      <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
	      <option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         
          <option value="4">4. Sin evidencia</option> 
          <option value="Otra">5. Otra</option>           
         <option value="-1">Seleccione opci&oacute;n</option>   
	 
	       <?php 
	  }
	  else if ($e[5]==2)
	  { ?> 
	       <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
	      <option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         <option value="4">4. Sin evidencia</option>  
          <option value="4">4. Sin evidencia</option>  
          <option value="Otra">5. Otra</option>          
          <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
         <option value="-1">Seleccione opci&oacute;n</option> 
         <?php 
	  }
	  else if ($e[5]==3)
	  { ?> 
	       
	      <option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         <option value="4">4. Sin evidencia</option>  
          <option value="4">4. Sin evidencia</option>
          <option value="Otra">5. Otra</option>            
          <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
          <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
         <option value="-1">Seleccione opci&oacute;n</option>     
         <?php 
	  	}
	  	else if ($e[5]==4)
	  	{ ?> 	       
          <option value="4">4. Sin evidencia</option>
          <option value="Otra">5. Otra</option>            
          <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
          <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
			<option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         <option value="4">4. Sin evidencia</option>  
         <option value="-1">Seleccione opci&oacute;n</option>     
          <?php 
	  	}
	  	else if (substr($e[5],0,4)=='Otra')
	  	{ ?> 	       
          <option value="Otra">5. Otra</option>            
          <option value="1">1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option> 
          <option value="2">2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.</option> 
			<option value="3">3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</option>         <option value="4">4. Sin evidencia</option> 
	     <option value="4">4. Sin evidencia</option> 
         <option value="-1">Seleccione opci&oacute;n</option>     
          <?php
		   }
		   ?>
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div> <div align="center" id="<?php echo "sugerencia3";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA y Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero. <br>
      2. Comprobante de la certificaci&oacute;n vigente de la NMX-EC-15189-IMNC-2015 expedido por la EMA.<br>
      3. Copia de acreditaci&oacute;n de la CAP a nombre del Laboratorio al cual ser&aacute;n enviadas las muestras, en el caso de que sean enviadas al extranjero.</div>
      <div align="center">
      <span id="<?php echo "spryotra3";?>">        
        <textarea name="<?php echo "otra3";?>" id="<?php echo "otra3";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[5]==NULL || $e[5]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[5],5);?></textarea>         
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">4</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>En relaci&oacute;n con la Respuesta a la repregunta 429 de la Junta de Aclaraciones <strong>(2.1 Objeto de la Contrataci&oacute;n/Condiciones de la Prestaci&oacute;n del Servicio)</strong></td>
      <td>&iquest;El proveedor durante la vigencia del contrato,  ha proporcionado  material para la toma de muestra( aguja, ligadura y dem&aacute;s insumos necesarios, adem&aacute;s de  lo necesario para el correcto transporte de la muestra hasta la unidad de procesamiento (separaci&oacute;n de suero, centrifugaci&oacute;n, congelaci&oacute;n, refrigeraci&oacute;n, adici&oacute;n de alg&uacute;n preservador o medio de transporte, as&iacute; como etiquetas, embalajes) garantizando siempre la red fr&iacute;a cuando  aplique?</td>
      <td><div align="center"><span id="<?php echo "spryr4";?>">
          <select name="<?php echo "r4";?>" size="1" id="<?php echo "r4";?>" onChange="validacombo(this,4)">
            <?php 
	   if($r[6]==NULL || $r[6]==" ")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[6]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[6];?>"><?php echo $r[6];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[6]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[6];?>"><?php echo $r[6];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia4";?>">
	    <select name="<?php echo "evidencia4";?>" size="1" id="<?php echo "evidencia4";?>" onChange="validacombo2(this,4)" style="width:200px">
	      <?php 
	   if($e[6]==NULL || $e[6]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo.</option> 
	      <option value="2">2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.</option> 
	      <option value="3">3. Sin evidencia</option>         
          <option value="Otra">4. Otra</option>    
	      <?php 
	  }
	  else if($e[6]==1)
	  {
	  ?>
	     <option value="1">1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo.</option> 
	      <option value="2">2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.</option> 
	      <option value="3">3. Sin evidencia</option>         
          <option value="Otra">4. Otra</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php } 
           else if($e[6]==2)
	  {
	  ?>
	       <option value="2">2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.</option> 
	      <option value="3">3. Sin evidencia</option>         
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo.</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
          
	      <?php }
           else if($e[6]==3)
	  {
	  ?>
	      <option value="3">3. Sin evidencia</option>         
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo.</option> 
          <option value="2">2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
          
	      <?php }
           else if(substr($e[6],0,4)=='Otra')
	  {
	  ?>     
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo.</option> 
          <option value="2">2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.</option> 
          <option value="3">3. Sin evidencia</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
          
	      <?php } ?>
          
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div> <div align="center" id="<?php echo "sugerencia4";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Hoja de Remisi&oacute;n de Insumos con fecha y firma de recepci&oacute;n de los mismo. <br>
      2. Formato libre de entrega recepci&oacute;n de insumos con fecha y firma de recepci&oacute;n de los mismos.
      
 </div>
 <div align="center">
      <span id="<?php echo "spryotra4";?>">        
        <textarea name="<?php echo "otra4";?>" id="<?php echo "otra4";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[6]==NULL || $e[6]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[6],5);?></textarea>     
        <span class="textareaRequiredMsg"><br>Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">5</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>Anexo T&eacute;cnico 1A , apartado <strong>&quot;Condiciones M&iacute;nimas de env&iacute;o de muestras biol&oacute;gicas a los laboratorios propiedad del Licitante&quot;, </strong>primer p&aacute;rrafo.<strong></strong></td>
      <td>El proveedor durante la vigencia del contrato debe garantizar siempre la red fr&iacute;a para el transporte de las muestras en el sistema b&aacute;sico de triple embalaje, seg&uacute;n la Gu&iacute;a para el Transporte Seguro de Substancias Infecciosas y Espec&iacute;menes Diagn&oacute;sticos emitido por la OMS, la NOM 007-SSA3-2011 &iquest;El proveedor ha garantizado  el transpore de red fria?</td>
      <td><div align="center"><span id="<?php echo "spryr5";?>">
          <select name="<?php echo "r5";?>" size="1" id="<?php echo "r5";?>" onChange="validacombo(this,5)">
            <?php 
	   if($r[7]==NULL || $r[7]==" ")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[7]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[7];?>"><?php echo $r[7];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[7]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[7];?>"><?php echo $r[7];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia5";?>">
	    <select name="<?php echo "evidencia5";?>" size="1" id="<?php echo "evidencia5";?>" onChange="validacombo2(this,5)" style="width:200px">
	      <?php 
	   if($e[7]==NULL || $e[7]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Documento en el cual se asiente que el proveedor utiliza un sistema b&aacute;sico de triple embalaje de red fr&iacute;a para el transporte de las muestras.</option> 
	      <option value="2">2. Sin evidencia</option>            
          <option value="Otra">3. Otra</option>  
	      <?php 
	  }
	  else  if($e[7]==1)
	  {
	  ?>
          
	      <option value="1">1. Documento en el cual se asiente que el proveedor utiliza un sistema b&aacute;sico de triple embalaje de red fr&iacute;a para el transporte de las muestras.</option> 
	      <option value="2">2. Sin evidencia</option>            
          <option value="Otra">3. Otra</option>
          <option value="-1">Seleccione opci&oacute;n</option>   
	      <?php 
	      } 
           else  if($e[7]==2)
	  {
	  ?>   
	      <option value="2">2. Sin evidencia</option>            
          <option value="Otra">3. Otra</option>
          <option value="1">1. Documento en el cual se asiente que el proveedor utiliza un sistema b&aacute;sico de triple embalaje de red fr&iacute;a para el transporte de las muestras.</option> 
          <option value="-1">Seleccione opci&oacute;n</option>   
	      <?php 
	      } 
           else  if(substr($e[7],0,4)=='Otra')
	  {
	  ?>   
	              
          <option value="Otra">3. Otra</option>
          <option value="1">1. Documento en el cual se asiente que el proveedor utiliza un sistema b&aacute;sico de triple embalaje de red fr&iacute;a para el transporte de las muestras.</option> 
          <option value="2">2. Sin evidencia</option>    
          <option value="-1">Seleccione opci&oacute;n</option> 
            
	      <?php 
	      } ?>
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div> <div align="center" id="<?php echo "sugerencia5";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Documento en el cual se asiente que el proveedor utiliza un sistema b&aacute;sico de triple embalaje de red fr&iacute;a para el transporte de las muestras.
 </div>
 <div align="center">
      <span id="<?php echo "spryotra5";?>">        
        <textarea name="<?php echo "otra5";?>" id="<?php echo "otra5";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[7]==NULL || $e[7]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[7],5);?></textarea>      
        <span class="textareaRequiredMsg"><br>Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">6</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>Anexo T&eacute;cnico 1A, apartado <strong>&quot;Sistema de Informaci&oacute;n&quot;</strong>, tercer p&aacute;rrafo.</td>
      <td>El proveedor durante la vigencia del contrato deber&aacute; proporcionar una herramienta cuya funcionalidad permita la Extracci&oacute;n, Transformaci&oacute;n y Carga de Datos, que incluya motores de visualizaci&oacute;n y de presentaci&oacute;n de la informaci&oacute;n para simplificar el proceso de analisis y la consulta de la Jefatura de Laboratorio, para todas las unidades adjudicadas.</td>
      <td><div align="center"><span id="<?php echo "spryr6";?>">
          <select name="<?php echo "r6";?>" size="1" id="<?php echo "r6";?>" onChange="validacombo(this,6)">
            <?php 
	   if($r[8]==NULL || $r[8]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[8]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[8];?>"><?php echo $r[8];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[8]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[8];?>"><?php echo $r[8];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia6";?>">
	    <select name="<?php echo "evidencia6";?>" size="1" id="<?php echo "evidencia6";?>" onChange="validacombo2(this,6)" style="width:200px">
	      <?php 
	   if($e[8]==NULL || $e[8]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.</option> 
	      <option value="2">2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.</option>             
          <option value="3">3. Sin evidencia</option>
           <option value="Otra">4. Otra</option>
	      <?php 
	  }
	  else if($e[8]==1)
	  {
	  ?>
	      <option value="1">1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.</option> 
	      <option value="2">2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.</option>             
          <option value="3">3. Sin evidencia</option>
          <option value="Otra">4. Otra</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php 
	  }
	  else if($e[8]==2)
	  {
	  ?>
	       <option value="2">2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.</option>             
          <option value="3">3. Sin evidencia</option>
            <option value="Otra">4. Otra</option>
          <option value="1">1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.</option> 
          <option value="-1">Seleccione opci&oacute;n</option>
	     
          <?php 
	  }
	  else if($e[8]==3)
	  {
	  ?>          
          <option value="3">3. Sin evidencia</option>
          <option value="Otra">4. Otra</option>
          <option value="1">1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.</option> 
          <option value="2">2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.</option>  
           <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php 
	  }
	  else if(substr($e[8],0,4)=='Otra')
	  {
	  ?>          
          <option value="Otra">4. Otra</option>
          <option value="1">1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.</option> 
          <option value="2">2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.</option>  
          <option value="3">3. Sin evidencia</option>
           <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php } ?>
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div>  <div align="center" id="<?php echo "sugerencia6";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Acta de entrega recepci&oacute;n y puesta en operaci&oacute;n del Sistema de Informaci&oacute;n y Actas de Capacitaci&oacute;n del personal para uso del sistema de informaci&oacute;n.<br>
      2. Minuta de trabajo en la cual se constae que el proveedor instal&oacute;  y puso en operaci&oacute;n el sistema de operaci&oacute;n y brind&oacute; la capacitaci&oacute;n al personal.      
 </div>
 <div align="center">
      <span id="<?php echo "spryotra6";?>">        
        <textarea name="<?php echo "otra6";?>" id="<?php echo "otra6";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[8]==NULL || $e[8]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[8],5);?></textarea>      
        <span class="textareaRequiredMsg"><br>Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">7</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;, apartado &quot;Condiciones de la Prestaci&oacute;n del Servicio&quot;, noveno p&aacute;rrafo.</div></td>
      <td> Anexo T&eacute;cnico 1A, apartado <strong>&quot;Control de Calidad&quot;</strong>, primer p&aacute;rrafo.<strong></strong></td>
      <td>&iquest;El proveedor durante la vigencia del contrato ha proporcionado  a la Unidad M&eacute;dica los resultados derivados del Control Externo de la Calidad, dando cumplimiento a la NOM-007-SSA3-2011?.</td>
      <td><div align="center"><span id="<?php echo "spryr7";?>">
          <select name="<?php echo "r7";?>" size="1" id="<?php echo "r7";?>" onChange="validacombo(this,7)">
            <?php 
	   if($r[9]==NULL || $r[9]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[9]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[9];?>"><?php echo $r[9];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[9]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[9];?>"><?php echo $r[9];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia7";?>">
	    <select name="<?php echo "evidencia7";?>" size="1" id="<?php echo "evidencia7";?>" onChange="" style="width:200px">
	      <?php 
	   if($e[9]==NULL || $e[9]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Resultados derivados del control Externo de la Calidad.</option> 
          <option value="2">2. Sin evidencia</option>                   
	      <?php 
	  }
	  else if($e[9]==1)
	  {
	  ?>
	     <option value="1">1. Resultados derivados del control Externo de la Calidad.</option> 
          <option value="2">2. Sin evidencia</option>
           <option value="-1">Seleccione opci&oacute;n</option>    
	      
           <?php 
	  }
	  else if($e[9]==2)
	  {
	  ?>
	       <option value="2">2. Sin evidencia</option>
           <option value="1">1. Resultados derivados del control Externo de la Calidad.</option> 
           <option value="-1">Seleccione opci&oacute;n</option>    
	      <?php } ?>
	      </select>
	    <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div> <div align="center" id="<?php echo "sugerencia7";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Resultados derivados del control Externo de la Calidad.
      
     
 </div></td>
    </tr>
    <tr>
      <td><div align="right">8</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>Anexo T&eacute;cnico 1A para el Paquete 5 Pruebas Especiales, p&aacute;gina 2, primer p&aacute;rrafo</td>
      <td>La toma de las muestras (Capacitaci&oacute;n Esperm&aacute;tica y Agregaci&oacute;n plaquetaria) se obtiene directamente en las instalaciones de los licitantes.  previa por lo que dichos licitantes deber&aacute;n contemplar que recibir&aacute;n una solicitud de estudio del paciente, validada por el Jefe de Laboratorio y orden m&eacute;dica. &iquest; Ha enviado  su Delegaci&oacute;n o UMAE estudios de este tipo a las instalaciones de los licitantes?</td>
      <td><div align="center"><span id="<?php echo "spryr8";?>">
          <select name="<?php echo "r8";?>" size="1" id="<?php echo "r8";?>" onChange="validacombo(this,8)">
            <?php 
	   if($r[10]==NULL || $r[10]=="")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option>  
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php 
	  }
	  else if($r[10]=="SI")
	  {
	  ?>
            <option value="<?php echo $r[10];?>"><?php echo $r[10];?></option>
            <option value="NO">NO</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php 
	  }
	  else if($r[10]=="NO")
	  {		  
	  ?>
            <option value="<?php echo $r[10];?>"><?php echo $r[10];?></option>
            <option value="SI">SI</option>
            <option value="-1">Seleccione opci&oacute;n</option>  
            <?php } ?>
          </select>
         <span class="selectInvalidMsg"><br>
Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
	  <span id="<?php echo "spryevidencia8";?>">
      <select name="<?php echo "evidencia8";?>" size="1" id="<?php echo "evidencia8";?>" onChange="validacombo2(this,8)" style="width:200px">
	      <?php 
	   if($e[10]==NULL || $e[10]==" ")
	   {
		?>        
	      <option value="-1">Seleccione opci&oacute;n</option> 
	      <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option>
          <option value="3">3. Sin evidencia</option>
  		  <option value="Otra">4. Otra</option>
	      <?php 
	  }
	  else if($e[10]==1)
	   {
	  
	  ?>
	      <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option> 
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option>
          <option value="3">3. Sin evidencia</option>
  		  <option value="Otra">4. Otra</option> 
          <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php 
	  }
	  else if($e[10]==2)
	   {
	  
	  ?> 
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option>
          <option value="3">3. Sin evidencia</option>
  		  <option value="Otra">4. Otra</option> 
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
	     <?php 
	  }
	  else if($e[10]==3)
	   {
	  
	  ?> 
          <option value="3">3. Sin evidencia</option>
  		  <option value="Otra">4. Otra</option> 
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option>
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
	     <?php 
	  }
	  else if(substr($e[10],0,4)=='Otra')
	   {
	  
	  ?> 
          <option value="Otra">4. Otra</option> 
          <option value="1">1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.</option>
          <option value="2">2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).</option>
          <option value="3">3. Sin evidencia</option>
          <option value="-1">Seleccione opci&oacute;n</option> 
	      <?php } ?>
	      </select>
      <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
	  
	  </div> <div align="center" id="<?php echo "sugerencia8";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
      1. Reporte total de Hojas de Resultados de Estudios de Laboratorio identificables en el Sistema de Informaci&oacute;n.<br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente).
 </div>
 <div align="center">
      <span id="<?php echo "spryotra8";?>">        
        <textarea name="<?php echo "otra8";?>" id="<?php echo "otra8";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[10]==NULL || $e[10]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[10],5);?></textarea>   
        <span class="textareaRequiredMsg"><br>Obligatorio</span></span>
    </div> 
 </td>
    </tr>
    <tr>
      <td><div align="right">9</div></td>
      <td><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;</div></td>
      <td>Anexo T&eacute;cnico 1A para el Paquete 5 Pruebas Especiales, apartado <strong>&quot;Realizaci&oacute;n de Pruebas Efectivas para efecto de pago&quot;</strong>,  tercer p&aacute;rrafo.</td>
      <td><p>&iquest;El proveedor realiza la  conciliaci&oacute;n de pruebas en los plazos se&ntilde;alados en el Anexo T&eacute;cnico 1A?</p>
        <p>* Deber&aacute; ser realizada por el proveedor a partir del d&iacute;a 26 de cada mes, y junto a la factura correspondiente, ser&aacute;n cotejadas, conciliadas y aprobadas a m&aacute;s tardar el &uacute;ltimo d&iacute;a h&aacute;bil del mes y deber&aacute;n estar firmadas por el Jefe del Servicio de Laboratorio Cl&iacute;nico, el Subdirector de la Unidad M&eacute;dica y el proveedor.</p></td>
      <td><div align="center"><span id="<?php echo "spryr9";?>">
        <select name="<?php echo "r9";?>" size="1" id="<?php echo "r9";?>" onChange="validacombo(this,9)">
          <?php 
	   if($r[11]==NULL || $r[11]=="")
	   {
		?>        
          <option value="-1">Seleccione opci&oacute;n</option>  
          <option value="SI">SI</option>
          <option value="NO">NO</option>
          <?php 
	  }
	  else if($r[11]=="SI")
	  {
	  ?>
          <option value="<?php echo $r[11];?>"><?php echo $r[11];?></option>
          <option value="NO">NO</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php 
	  }
	  else if($r[11]=="NO")
	  {		  
	  ?>
          <option value="<?php echo $r[11];?>"><?php echo $r[11];?></option>
          <option value="SI">SI</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php } ?>
          </select>
        <span class="selectInvalidMsg"><br>
        Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">
        <span id="<?php echo "spryevidencia9";?>">
          <select name="<?php echo "evidencia9";?>" size="1" id="<?php echo "evidencia9";?>" onChange="validacombo2(this,9)" style="width:200px">
            <?php 
	   if($e[11]==NULL || $e[11]==" ")
	   {
		?>        
            <option value="-1">Seleccione opci&oacute;n</option> 
            <option value="1">1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>          
            <option value="2">2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>
            <option value="3">3. Sin evidencia</option>
            <option value="Otra">4. Otra</option>
            <?php 
	  }
	  else if($e[11]==1)
	  {
	  ?>
            
            <option value="1">1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>          
            <option value="2">2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>
            <option value="3">3. Sin evidencia</option>  
            <option value="Otra">4. Otra</option>           
            <option value="-1">Seleccione opci&oacute;n</option>   
       
             <?php 
	  }
	  else if($e[11]==2)
	  {
	  ?>
            <option value="2">2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>
            <option value="3">3. Sin evidencia</option> 
            <option value="Otra">4. Otra</option>
            <option value="1">1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>    
            <option value="-1">Seleccione opci&oacute;n</option>   
             <?php 
	  }
	  else if($e[11]==3)
	  {
	  ?>
            <option value="3">3. Sin evidencia</option> 
            <option value="Otra">4. Otra</option>            
            <option value="1">1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>    
            <option value="2">2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>
            <option value="-1">Seleccione opci&oacute;n</option>   
            <?php }
		  else if(substr($e[11],0,4)=='Otra')
	  {
	  ?>
            <option value="Otra">4. Otra</option>            
            <option value="1">1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>    
            <option value="2">2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</option>
            <option value="3">3. Sin evidencia</option> 
            <option value="-1">Seleccione opci&oacute;n</option>   
            <?php } ?>
            </select>
          <span class="selectInvalidMsg">Seleccione opci&oacute;n</span></span>
        
        </div> <div align="center" id="<?php echo "sugerencia9";?>">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
          1. Reporte mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.<br>
          2.  Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.
          
        </div>
        <div align="center">
      <span id="<?php echo "spryotra9";?>">        
        <textarea name="<?php echo "otra9";?>" id="<?php echo "otra9";?>" cols="40" rows="9" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php if($e[11]==NULL || $e[11]==" ") echo "Mencione a detalle cual es la evidencia con la que cuenta: "; else echo substr($e[11],5);?></textarea>       
        <span class="textareaRequiredMsg">Obligatorio</span></span>
    </div> 
        </td>
    </tr>
    <tr>
      <td><div align="right">10</div></td>
      <td><div align="center">
        <p>Cl&aacute;usula D&eacute;cima Tercera: &quot;Penas Convencionales&quot;</p>
        <p>Cl&aacute;usula D&eacute;cima Cuarta: &quot;Deducciones&quot;, segunda fila de la tabla.<br>
          </p>
        </div></td>
      <td colspan="2"><div align="center">De las Penas y Deductivas. &iquest;Est&aacute;n aplicando conforme lo indica en la licitaci&oacute;n y contrato?</div></td>
      <td><div align="center"><span id="<?php echo "spryr10";?>">
        <select name="<?php echo "r10";?>" size="1" id="<?php echo "r10";?>" onChange="validacombo(this,10)">
          <?php 
	   if($r[12]==NULL || $r[12]=="")
	   {
		?>        
          <option value="-1">Seleccione opci&oacute;n</option>  
          <option value="SI">SI</option>
          <option value="NO">NO</option>
          <?php 
	  }
	  else if($r[12]=="SI")
	  {
	  ?>
          <option value="<?php echo $r[12];?>"><?php echo $r[12];?></option>
          <option value="NO">NO</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php 
	  }
	  else if($r[12]=="NO")
	  {		  
	  ?>
          <option value="<?php echo $r[12];?>"><?php echo $r[12];?></option>
          <option value="SI">SI</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php } ?>
          </select>
        <span class="selectInvalidMsg"><br>
        Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td>
        <div align="center" id="<?php echo "sugerencia10";?>">Se sugiere</div></td>
    </tr>
    <tr>
      <td><div align="right">11</div></td>
      <td rowspan="8"><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;/ Cl&aacute;usula D&eacute;cima Cuarta: &quot;Deducciones&quot;, segunda fila de la tabla.</div></td>
      <td rowspan="8">Cl&aacute;usula Cuarta: <strong>PLAZO, LUGAR Y CONDICIONES DE LA PRESTACI&Oacute;N DEL SERVICIO / TRASLADO DE MUESTRAS p&aacute;rrafo sexto/CONDICIONES DE LA PRESTACI&Oacute;N DEL SERVICIO</strong></td>
      <td><p>A partir del inicio de Operaciones del proveedor <strong>(19 de Septiembre 2016) a la fecha.</strong></p>
        <p><strong>Nota:</strong> en un archivo en Excel env&iacute;e la relaci&oacute;n de estudios que no ha recibido por parte del proveedor, con los siguientes datos: NOMBRE COMPLETO ,NSS, FECHA DE ENV&Iacute;O, ESTUDIOS SOLICITADOS, FECHA DE SOLICITUD Y FECHA DE RECOLECCI&Oacute;N.</p></td>
      <td><div align="center">¿Cuántos estudios ha enviado?<br><div align="center">
        <span id="<?php echo "spryr11a";?>">
          <input type="text" name="<?php echo "r11a";?>" id="<?php echo "r11a";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r11a'); porcentaje(this,'11')" style="text-align:right" value="<?php if($r[13]>0) {echo number_format($r[13],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de pruebas</span></span>
        <input name="<?php echo "r11ag";?>" type="text" id="<?php echo "r11ag"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[13];?>">
        </div></div>
        <div align="center">
          &iquest;De cuantos estudios ha recibido resultados?
          <br>
          <span id="<?php echo "spryr11b";?>">
            <input type="text" name="<?php echo "r11b";?>" id="<?php echo "r11b";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r11b'); porcentaje(this,'11')" style="text-align:right" value="<?php if($r[14]>0) {echo number_format($r[14],0);} else echo "";?>">
            <span class="textfieldRequiredMsg">Ingrese cantidad de pruebas</span></span>  <input name="<?php echo "r11bg";?>" type="text" id="<?php echo "r11bg"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[14];?>"><br>
          Porcentaje de Cumplimiento: 
          <input type="text" name="porcentaje11" id="porcentaje11" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[13]>0 && $r[14]>0) echo number_format((($r[14]/$r[13])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.<br>
        2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
        
        </div></td>
    </tr>
    <tr>
      <td><div align="right">12</div></td>
      <td bgcolor="#FFFFFF">De los estudios entregados &iquest;Cu&aacute;ntos fueron entregados en los tiempos establecidos en los t&eacute;rminos y condiciones de la contrataci&oacute;n? </td>
      <td><div align="center"> &iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr12";?>">
          <input type="text" name="<?php echo "r12";?>" id="<?php echo "r12";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r12');porcentaje(this,'12')" style="text-align:right" value="<?php if($r[15]>0) {echo number_format($r[15],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br>
        <input name="<?php echo "r12g"; ?>" type="text" id="<?php echo "r12g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[15];?>">
        <br>
        Porcentaje de Cumplimiento:
  <input type="text" name="porcentaje12" id="porcentaje12" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[14]>0 && $r[15]>0) echo number_format((($r[15]/$r[14])*100),2).'%'; else echo "";?>">
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</div></td>
    </tr>
    <tr>
      <td><div align="right">13</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos cuentan con la firma del Responsable Sanitario del proveedor?</td>
      <td><div align="center">
        ¿Cuántos?<br>
          <span id="<?php echo "spryr13";?>">
         <input type="text" name="<?php echo "r13";?>" id="<?php echo "r13";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r13');porcentaje(this,'13')" style="text-align:right" value="<?php if($r[16]>0) {echo number_format($r[16],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br><input name="<?php echo "r13g";?>" type="text" id="<?php echo "r13g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[16];?>"><br>
Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje13" id="porcentaje13" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[16]>0 && $r[14]>0) echo number_format((($r[16]/$r[14])*100),2).'%'; else echo "";?>">        
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
     1. Hojas de Resultados de Estudios de Laboratorio sin firma del Responsable Sanitario del Proveedor identificados en el Sistema de Informaci&oacute;n.<br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) sin firma del Responsable Sanitario del Proveedor.<br>
          
 </div></td>
    </tr>
    <tr>
      <td><div align="right">14</div></td>
      <td>De los estudios  entregados &iquest; Cu&aacute;ntos presentan duplicidad en los resultados con unidad de medidas diferentes?</td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr14";?>">
         <input type="text" name="<?php echo "r14";?>" id="<?php echo "r14";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r14'); porcentaje(this,'14')" style="text-align:right" value="<?php if($r[17]>0) {echo number_format($r[17],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br> <input name="<?php echo "r14g";?>" type="text" id="<?php echo "r14g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[17];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje14" id="porcentaje14" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[14]>0 && $r[17]>0) echo number_format((($r[17]/$r[14])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
     1. Hojas de Resultados de Estudios de Laboratorio duplicados identificados y/o con unidad de medida diferente en el Sistema de Informaci&oacute;n.<br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) duplicados y/o con unidad de medida diferente.<br>
          
 </div></td>
    </tr>
    <tr>
      <td><div align="right">15</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos identific&oacute; que fueron estudios no solicitados al paciente enviado?</td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr15";?>">
         <input type="text" name="<?php echo "r15";?>" id="<?php echo "r15";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r15');porcentaje(this,'15')" style="text-align:right" value="<?php if($r[18]>0) {echo number_format($r[18],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br> <input name="<?php echo "r15g";?>" type="text" id="<?php echo "r15g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[18];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje15" id="porcentaje15" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[14]>0 && $r[18]>0) echo number_format((($r[18]/$r[14])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
     1. Hojas de Resultados de Estudios de Laboratorio con estudios distintos a los solicitados o no solicitados al paciente enviado.<br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) con estudios distintos a los solicitados o no solicitados al paciente enviado.<br>
          
 </div></td>
    </tr>
    <tr>
      <td><div align="right">16</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos tienen registrado el valor de referencia y unidad de medida? </td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr16";?>">
         <input type="text" name="<?php echo "r16";?>" id="<?php echo "r16";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r16'); porcentaje(this,'16')" style="text-align:right" value="<?php if($r[19]>0) {echo number_format($r[19],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de pruebas</span></span><br> <input name="<?php echo "r16g";?>" type="text" id="<?php echo "r16g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[19];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje16" id="porcentaje16" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[14]>0 && $r[19]>0) echo number_format((($r[19]/$r[14])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
    1. Hojas de Resultados de Estudios de Laboratorio que no tienen registrado el valor de referencia y unidad de medida.<br>
      2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) sin firma del Responsable Sanitario del Proveedor.<br>
 </div></td> </tr>
    <tr>
      <td><div align="right">17</div></td>
      <td bgcolor="#FFFFFF">De los estudios solicitados &iquest;Cu&aacute;ntos fueron recolectados?</td>
      <td><div align="center">&iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr17";?>">
          <input type="text" name="<?php echo "r17";?>" id="<?php echo "r17";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r17'); porcentaje(this,'17')" style="text-align:right" value="<?php if($r[20]>0) {echo number_format($r[20],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de pruebas</span></span><br>
        <input name="<?php echo "r17g"; ?>" type="text" id="<?php echo "r17g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[20];?>">
        <br>
        Porcentaje de Cumplimiento:
  <input type="text" name="porcentaje17" id="porcentaje17" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[14]>0 && $r[20]>0) echo number_format((($r[20]/$r[14])*100),2).'%'; else echo "";?>">
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.<br>
      </div></td>
    </tr>
    <tr>
      <td><div align="right">18</div></td>
      <td bgcolor="#FFFFFF">De los estudios recolectados &iquest;Cu&aacute;ntos fueron recolectados en los tiempos establecidos en los t&eacute;rminos y condiciones de la contrataci&oacute;n?</td>
      <td><div align="center">&iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr18";?>">
          <input type="text" name="<?php echo "r18";?>" id="<?php echo "r18";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r18'); porcentaje(this,'18')" style="text-align:right" value="<?php if($r[21]>0) {echo number_format($r[21],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de pruebas</span></span><br>
        <input name="<?php echo "r18g"; ?>" type="text" id="<?php echo "r18g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[21];?>">
        <br>
        Porcentaje de Cumplimiento:
        <input type="text" name="porcentaje18" id="porcentaje18" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[20]>0 && $r[21]>0) echo number_format((($r[21]/$r[20])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
        2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor. <br>
        </div></td>
    </tr>
    <tr>
      <td><div align="right">19</div></td>
      <td rowspan="8"><div align="center">Cl&aacute;usula Cuarta &quot;Plazo, Lugar y Condiciones de la Prestaci&oacute;n del Servicio&quot;/ Cl&aacute;usula D&eacute;cima Cuarta: &quot;Deducciones&quot;, segunda fila de la tabla.</div></td>
      <td rowspan="8">Clausula Cuarta: <strong>PLAZO, LUGAR Y CONDICIONES DE LA PRESTACI&Oacute;N DEL SERVICIO / TRASLADO DE MUESTRAS p&aacute;rrafo sexto/CONDICIONES DE LA PRESTACI&Oacute;N DEL SERVICIO</strong></td>
      <td><strong>En el mes de Noviembre capture:</strong></td>
      <td><div align="center">¿Cuántos estudios ha enviado?<br><div align="center">
        <span id="<?php echo "spryr19a";?>">
          <input type="text" name="<?php echo "r19a";?>" id="<?php echo "r19a";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r19a'); porcentaje(this,'19')" style="text-align:right" value="<?php if($r[22]>0) {echo number_format($r[22],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span>
        <input name="<?php echo "r19ag";?>" type="text" id="<?php echo "r19ag"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[22];?>">
        </div></div>
        <div align="center">
          &iquest;De cu&aacute;ntos estudios ha recibido resultados?
          <br>
          <span id="<?php echo "spryr19b";?>">
            <input type="text" name="<?php echo "r19b";?>" id="<?php echo "r19b";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r19b'); porcentaje(this,'19')" style="text-align:right" value="<?php if($r[23]>0) {echo number_format($r[23],0);} else echo "";?>">
            <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><input name="<?php echo "r19bg";?>" type="text" id="<?php echo "r19bg"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[23];?>"><br>
          Porcentaje de Cumplimiento: 
          <input type="text" name="porcentaje19" id="porcentaje19" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[23]>0) echo number_format((($r[23]/$r[22])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.<br>
        2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
        </div></td>
    </tr>
    <tr>
      <td><div align="right">20</div></td>
      <td bgcolor="#FFFFFF">De los estudios entregados &iquest;Cu&aacute;ntos fueron entregados en los tiempos establecidos en los t&eacute;rminos y condiciones de la contrataci&oacute;n? </td>
      <td><div align="center">&iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr20";?>">
          <input type="text" name="<?php echo "r20";?>" id="<?php echo "r20";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r20');porcentaje(this,'20')" style="text-align:right" value="<?php if($r[24]>0) {echo number_format($r[24],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span> <br>
        <input name="<?php echo "r20g";?>" type="text" id="<?php echo "r20g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[24];?>">
        <br>
        Porcentaje de Cumplimiento:
  <input type="text" name="porcentaje20" id="porcentaje20" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[24]>0) echo number_format((($r[24]/$r[22])*100),2).'%'; else echo "";?>">
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.  </div></td>
    </tr>
    <tr>
      <td><div align="right">21</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos cuentan con la firma del Responsable Sanitario del proveedor?</td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr21";?>">
         <input type="text" name="<?php echo "r21";?>" id="<?php echo "r21";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r21');porcentaje(this,'21')" style="text-align:right" value="<?php if($r[25]>0) {echo number_format($r[25],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span>        
         <br><input name="<?php echo "r21g";?>" type="text" id="<?php echo "r21g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[25];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje21" id="porcentaje21" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[25]>0 && $r[22]>0) echo number_format((($r[25]/$r[22])*100),2).'%'; else echo "";?>">        
</div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Hojas de Resultados de Estudios de Laboratorio sin firma del Responsable Sanitario del Proveedor identificados en el Sistema de Informaci&oacute;n.<br>
        2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) sin firma del Responsable Sanitario del Proveedor.</div></td>
    </tr>
    <tr>
      <td><div align="right">22</div></td>
      <td>De los estudios  entregados &iquest;Cu&aacute;ntos presentan duplicidad en los resultados con unidad de medidas diferentes?</td>

      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr22";?>">
         <input type="text" name="<?php echo "r22";?>" id="<?php echo "r22";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r22');porcentaje(this,'22')" style="text-align:right" value="<?php if($r[26]>0) {echo number_format($r[26],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br> <input name="<?php echo "r22g";?>" type="text" id="<?php echo "r22g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[26];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje22" id="porcentaje22" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[26]>0) echo number_format((($r[26]/$r[22])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Hojas de Resultados de Estudios de Laboratorio duplicados identificados y/o con unidad de medida diferente en el Sistema de Informaci&oacute;n.<br>
        2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) duplicados y/o con unidad de medida diferente.</div></td>
    </tr>
    <tr>
      <td><div align="right">23</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos identific&oacute; que fueron estudios no solicitados al paciente enviado?</td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr23";?>">
         <input type="text" name="<?php echo "r23";?>" id="<?php echo "r23";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r23'); porcentaje(this,'23')" style="text-align:right" value="<?php if($r[27]>0) {echo number_format($r[27],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br> <input name="<?php echo "r23g";?>" type="text" id="<?php echo "r23g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[27];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje23" id="porcentaje23" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[27]>0) echo number_format((($r[27]/$r[22])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Hojas de Resultados de Estudios de Laboratorio con estudios distintos a los solicitados o no solicitados al paciente enviado.<br>
        2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) con estudios distintos a los solicitados o no solicitados al paciente enviado.</div></td>
    </tr>
    <tr>
      <td><div align="right">24</div></td>
      <td>De los estudios entregados &iquest;Cu&aacute;ntos tienen registrado el valor de referencia y unidad de medida? </td>
      <td><div align="center">¿Cuántos?<br>
          <span id="<?php echo "spryr24"?>">
         <input type="text" name="<?php echo "r24";?>" id="<?php echo "r24";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r24');porcentaje(this,'24')" style="text-align:right" value="<?php if($r[28]>0) {echo number_format($r[28],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br> <input name="<?php echo "r24g";?>" type="text" id="<?php echo "r24g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[28];?>"><br>
         Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje24" id="porcentaje24" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[28]>0) echo number_format((($r[28]/$r[22])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Hojas de Resultados de Estudios de Laboratorio que no tienen registrado el valor de referencia y unidad de medida.<br>
        2. Hojas de Resultados de Estudios de Laboratorio (f&iacute;sicamente) sin firma del Responsable Sanitario del Proveedor.</div></td>
    </tr>
    <tr>
      <td><div align="right">25</div></td>
      <td bgcolor="#FFFFFF">De los estudios solicitados &iquest;Cu&aacute;ntos fueron recolectados?</td>
      <td><div align="center">&iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr25";?>">
          <input type="text" name="<?php echo "r25";?>" id="<?php echo "r25";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r25'); porcentaje(this,'25')" style="text-align:right" value="<?php if($r[29]>0) {echo number_format($r[29],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br>
        <input name="<?php echo "r25g";?>" type="text" id="<?php echo "r25g";?>" size="12" class="style4 CampoOculto" value="<?php echo $r[29];?>">
        <br>
        Porcentaje de Cumplimiento:
  <input type="text" name="porcentaje25" id="porcentaje25" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[22]>0 && $r[29]>0) echo number_format((($r[29]/$r[22])*100),2).'%'; else echo "";?>">
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor. </div></td>
    </tr>
    <tr>
      <td><div align="right">26</div></td>
      <td bgcolor="#FFFFFF">De los estudios recolectados &iquest;Cu&aacute;ntos fueron recolectados en los tiempos establecidos en los t&eacute;rminos y condiciones de la contrataci&oacute;n?</td>
      <td><div align="center">&iquest;Cu&aacute;ntos?<br>
        <span id="<?php echo "spryr26"?>">
          <input type="text" name="<?php echo "r26";?>2" id="<?php echo "r26";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r26');porcentaje(this,'26')" style="text-align:right" value="<?php if($r[30]>0) {echo number_format($r[30],0);} else echo "";?>">
          <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br>
        <input name="<?php echo "r26g"; ?>" type="text" id="<?php echo "r26g"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[30];?>">
        <br>
        Porcentaje de Cumplimiento:
  <input type="text" name="porcentaje26" id="porcentaje26" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[29]>0 && $r[30]>0) echo number_format((($r[30]/$r[29])*100),2).'%'; else echo "";?>">
      </div></td>
      <td><div align="center">Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Orden de Servicio con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.
2. Formato libre con detalle de muestras para su recolecci&oacute;n dirigido y firmado por el proveedor.</div></td>
      </tr>
    <tr>
      <td><div align="right">27</div></td>
      <td colspan="3">&iquest;Considera usted amigable la plataforma PASNET (donde consultan resultados de estudios enviados)?</td>
      <td><div align="center"><span id="<?php echo "spryr27";?>">
        <select name="<?php echo "r27";?>" size="1" id="<?php echo "r27";?>">
          <?php 
	   if($r[31]==NULL || $r[31]=="")
	   {
		?>        
          <option value="-1">Seleccione opci&oacute;n</option>  
          <option value="SI">SI</option>
          <option value="NO">NO</option>
          <?php 
	  }
	  else if($r[31]=="SI")
	  {
	  ?>
          <option value="<?php echo $r[31];?>"><?php echo $r[31];?></option>
          <option value="NO">NO</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php 
	  }
	  else if($r[31]=="NO")
	  {		  
	  ?>
          <option value="<?php echo $r[31];?>"><?php echo $r[31];?></option>
          <option value="SI">SI</option>
          <option value="-1">Seleccione opci&oacute;n</option>  
          <?php } ?>
          </select>
        <span class="selectInvalidMsg"><br>
        Seleccione opci&oacute;n</span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></div></td>
      <td><div align="center">Comentarios:<br>
	  <span id="<?php echo "spryevidencia27";?>">
	    <textarea name="<?php echo "evidencia27";?>" id="<?php echo "evidencia27";?>" cols="40" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php echo $e[31];?></textarea>      
	    <span class="textareaRequiredMsg"><br>Ingrese Justificaci&oacute;n</span></span>
	  </div></td>
      </tr>
    <tr>
      <td><div align="right">28</div></td>
      <td colspan="3">De las pruebas solicitadas al proveedor para realizar en sitio, </td>
      <td><div align="center">¿Cuántas pruebas solicitaron?<br>
          <div align="center">
       <span id="<?php echo "spryr28a";?>">
         <input type="text" name="<?php echo "r28a";?>" id="<?php echo "r28a";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r28a'); porcentaje(this,'28')" style="text-align:right" value="<?php if($r[32]>0) {echo number_format($r[32],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span>
       <input name="<?php echo "r28ag";?>" type="text" id="<?php echo "r28ag"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[32];?>">
       </div></div>
        <div align="center">
          &iquest;Cu&aacute;ntas pruebas ya se realizan en sitio? <br>
          <span id="<?php echo "spryr28b";?>">
         <input type="text" name="<?php echo "r28b";?>" id="<?php echo "r28b";?>" size="13" onKeyPress="if (event.keyCode &lt; 48 || event.keyCode &gt; 57) event.returnValue = false;" onKeyUp="number_format('r28b');porcentaje(this,'28')" style="text-align:right" value="<?php if($r[33]>0) {echo number_format($r[33],0);} else echo "";?>">
         <span class="textfieldRequiredMsg">Ingrese cantidad de estudios</span></span><br>
         <input name="<?php echo "r28bg";?>" type="text" id="<?php echo "r28bg"; ?>" size="12" class="style4 CampoOculto" value="<?php echo $r[33];?>">
        Porcentaje de Cumplimiento: 
        <input type="text" name="porcentaje28" id="porcentaje28" size="3" onKeyPress="falso()" style="background-color:#CCC; text-align:right" readonly value="<?php if($r[32]>0 && $r[33]>0) echo number_format((($r[33]/$r[32])*100),2).'%'; else echo "";?>">
        </div></td>
      <td><div align="center">        
        Se sugiere contar con cualquiera de las siguientes evidencias:<br>
        1. Reporte mensual de pruebas efectivas realizadas en sitio debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico conciliadas debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico. <br>
        2. Formato libre de conciliaci&oacute;n  mensual de pruebas efectivas realizadas en sitio debidamente firmado por el Jefe del Servicio de Laboratorio Cl&iacute;nico.</div></td>
    </tr>
    <tr>
    <td><div align="right">29</div></td>
    <td colspan="3"><div align="center">Describa otras irregularidades detectadas  <br>      
      <strong>(Anexe copia de evidencia de estas)</strong></div></td>
    <td colspan="2"><div align="center">
      <span id="<?php echo "spryr29";?>">        
        <textarea name="<?php echo "r29";?>" id="<?php echo "r29";?>" cols="60" rows="4" onkeypress="if (event.keyCode == 13) event.returnValue = false;"><?php echo $r[34];?></textarea>      
        <span class="textareaRequiredMsg"><br>Ingrese informaci&oacute;n</span></span>
    </div>    </td>
    </tr>
    <tr>
    <td><div align="right">30</div></td>
    <td colspan="3"><div align="center">&iquest;Considera usted que el servicio que el paquete 5 est&aacute; prestando a su Delegaci&oacute;n o UMAE debe considerarse una rescisi&oacute;n de contrato?</div></td>
    <td><div align="center"></div></td>
        <td><div align="center"></div></td>
    </tr>
      <tr>    
    <td colspan="6" style="background-color:#FFF; border:0; color:#000; font-size:18px"><div align="center">
          <input type="submit" name="Submit" value="Guardar" onClick="return valida();">
        </div>
        </td></tr>
    </tbody>
</table>
</form>
<script type="text/javascript">
window.onload=function()
{	
var spryr=[];
var spryevidencia=[];
var spryotra=[];

//inicio para activar sprys
	for(i=1;i<=10;i++) 	
	{	
		if(i==2)
		{
		spryr[i]=new Spry.Widget.ValidationSelect("spryr"+i+"a", {invalidValue:"-1", validateOn:["blur", "change"]});
		spryr[i]=new Spry.Widget.ValidationSelect("spryr"+i+"b", {invalidValue:"-1", validateOn:["blur", "change"]});
		spryr[i]=new Spry.Widget.ValidationSelect("spryr"+i+"c", {invalidValue:"-1", validateOn:["blur", "change"]});		
		spryotra[i] = new Spry.Widget.ValidationTextarea("spryotra2a", {validateOn:["blur", "change"]});
		spryotra[i] = new Spry.Widget.ValidationTextarea("spryotra2b", {validateOn:["blur", "change"]});
		spryotra[i] = new Spry.Widget.ValidationTextarea("spryotra2c", {validateOn:["blur", "change"]});				
		}		
		else		
		{
		spryr[i]=new Spry.Widget.ValidationSelect("spryr"+i, {invalidValue:"-1", validateOn:["blur", "change"]});			
		if(i==1 || i==3 || i==4 || i==5 || i==6 || i==8 || i==9)
		spryotra[i] = new Spry.Widget.ValidationTextarea("spryotra"+i,	 {validateOn:["blur", "change"]});
		}
	}
	
		spryr[i]=new Spry.Widget.ValidationSelect("spryr27", {invalidValue:"-1", validateOn:["blur", "change"]});

	for(i=11;i<=26;i++) 	
	{
		if(i==11 || i==19)
		{
		spryr[i] = new Spry.Widget.ValidationTextField("spryr"+i+"a", "none", {validateOn:["blur", "change"]});	
		spryr[i] = new Spry.Widget.ValidationTextField("spryr"+i+"b", "none", {validateOn:["blur", "change"]});	
		}
		else	
		spryr[i] = new Spry.Widget.ValidationTextField("spryr"+i, "none", {validateOn:["blur", "change"]});
	}
	
	spryr[i] = new Spry.Widget.ValidationTextField("spryr28"+"a", "none", {validateOn:["blur", "change"]});	
	spryr[i] = new Spry.Widget.ValidationTextField("spryr28"+"b", "none", {validateOn:["blur", "change"]});	
	spryr[i] = new Spry.Widget.ValidationTextarea("spryr29", {validateOn:["blur", "change"]});

	
	for(i=1;i<=9;i++)
	{
		if(i==2)
		{
		spryevidencia[i]=new Spry.Widget.ValidationSelect("spryevidencia"+i+"a", {invalidValue:"-1", validateOn:["blur", "change"]});
		spryevidencia[i]=new Spry.Widget.ValidationSelect("spryevidencia"+i+"b", {invalidValue:"-1", validateOn:["blur", "change"]});
		spryevidencia[i]=new Spry.Widget.ValidationSelect("spryevidencia"+i+"c", {invalidValue:"-1", validateOn:["blur", "change"]});	
		}
		else		
		spryevidencia[i]=new Spry.Widget.ValidationSelect("spryevidencia"+i, {invalidValue:"-1", validateOn:["blur", "change"]});
	}	
	
	spryevidencia[i] = new Spry.Widget.ValidationTextarea("spryevidencia27", {validateOn:["blur", "change"]});
	}
//	//fin para activar sprys

//document.getElementById("jefe").focus();
//inicio para ocultar o mostrar elementos de acuerdo a respuest
for(i=1;i<=10;i++) 	
{	
	var r=document.getElementById('r'+i);			;		
	var evidencia=document.getElementById('evidencia'+i);			
	var spryevidencia=document.getElementById('spryevidencia'+i);	
	var sugerencia=document.getElementById('sugerencia'+i);	
	var otra=document.getElementById('otra'+i);	
	var spryotra=document.getElementById('spryotra'+i);	
	


	if(i!=2)
	{
		//alert(sugerencia.value);
		if(r.value=='SI')
		{
			sugerencia.style.display='block';
			sugerencia.disabled='';
			if(i!=10)
			{
			evidencia.style.display='none';
			evidencia.disabled='disabled';
			spryevidencia.style.display='none';
			spryevidencia.disabled='disabled';			
			}
			else 
			{
				sugerencia.innerHTML="Se sugiere contar con la siguiente evidencia: <br>1. Nota de crédito en las que se verifique la aplicación de dicha sanción.";
			}			

			if(i==1 || i==3 || i==4 || i==5 || i==6 || i==8 || i==9)
			{
			otra.style.display='none';
			otra.disabled='disabled';
			spryotra.style.display='none';
			spryotra.disabled='disabled';
			}			
		}
		else if(r.value=='NO')
		{
			//alert(i);
			if(i!=10)
			{
				evidencia.style.display='block';
				evidencia.disabled='';
				spryevidencia.style.display='block';
				spryevidencia.disabled='';
				sugerencia.style.display='none';
				sugerencia.disabled='disabled';				
			}
			else
			{
				sugerencia.style.display='block';
				sugerencia.disabled='';	
				sugerencia.innerHTML='Se sugiere: <br>1. Identificar las causales de incumplimiento:<br><strong>a.</strong> Expresar claramente las causas, motivos o hechos que constituyen el incumplimiento de las obligaciones. <br><strong>b.</strong> Vincular el incumplimiento del proveedor con las causales de rescisión previstas en el contrato. <br><strong>c.</strong> En su caso, citar los comunicados que se hubieren generado entre las partes, relacionados con el incumplimiento en cuestión. <br>2. Nota de crédito en las que se verifique la aplicación de dicha sanción.';
			}
			
			if(i==1 || i==3 || i==4 || i==5 || i==6 || i==8 || i==9)
			{				
				if(evidencia.value=='Otra')
				{
					otra.style.display='block';
					otra.disabled='';
					spryotra.style.display='block';
					spryotra.disabled='';
				}
				else
				{
					otra.style.display='none';
					otra.disabled='disabled';
					spryotra.style.display='none';
					spryotra.disabled='disabled';
				}
			}
		}
		else if(r.value==-1)
		{
			//alert(i);
			//if(i!=10)
			{
			evidencia.style.display='none';
			evidencia.disabled='disabled';
			spryevidencia.style.display='none';
			spryevidencia.disabled='disabled';
			}
			sugerencia.style.display='none';
			sugerencia.disabled='disabled';
			
			if(i==1 || i==3 || i==4 || i==5 || i==6 || i==8 || i==9)
			{
				otra.style.display='none';
				otra.disabled='disabled';
				spryotra.style.display='none';
				spryotra.disabled='disabled';
			}
		}
			
	}
	else
	{
		for(a=1; a<=3; a++)
		{
			if(a==1)
			{

			var r=document.getElementById('r2a');
			var evidencia=document.getElementById('evidencia2a');
			var spryevidencia=document.getElementById('spryevidencia2a');
			var sugerencia=document.getElementById('sugerencia2a');
			var otra=document.getElementById('otra2a');	
			var spryotra=document.getElementById('spryotra2a');	
 
			}
			if(a==2)
			{
			var r=document.getElementById('r2b');
			var evidencia=document.getElementById('evidencia2b');
			var spryevidencia=document.getElementById('spryevidencia2b');
			var sugerencia=document.getElementById('sugerencia2b');
			var otra=document.getElementById('otra2b');	
			var spryotra=document.getElementById('spryotra2b');	
			}
			if(a==3)
			{		
			var r=document.getElementById('r2c');
			var evidencia=document.getElementById('evidencia2c');
			var spryevidencia=document.getElementById('spryevidencia2c');
			var sugerencia=document.getElementById('sugerencia2c');
			var otra=document.getElementById('otra2c');	
			var spryotra=document.getElementById('spryotra2c');	
			}
		
			if(r.value=='SI')
			{
				evidencia.style.display='none';
				evidencia.disabled='disabled';
				spryevidencia.style.display='none';
				spryevidencia.disabled='disabled';
				sugerencia.style.display='block';
				sugerencia.disabled='';
				otra.style.display='none';
				otra.disabled='disabled';
				spryotra.style.display='none';
				spryotra.disabled='disabled';
			}
			else	
			{				
				if(r.value=='NO')
				{
					//alert(4);
					evidencia.style.display='block';
					evidencia.disabled='';
					spryevidencia.style.display='block';
					spryevidencia.disabled='';
					sugerencia.style.display='none';
					sugerencia.disabled='disabled';	
					if(evidencia.value=='Otra')
					{
						//alert(5);
						otra.style.display='block';
						otra.disabled='';
						spryotra.style.display='block';
						spryotra.disabled='';
					}
					else
					{
						otra.style.display='none';
						otra.disabled='disabled';
						spryotra.style.display='none';
						spryotra.disabled='disabled';
					}					
				}
				else if(r.value==-1)
				{
					evidencia.style.display='none';
					evidencia.disabled='disabled';
					spryevidencia.style.display='none';
					spryevidencia.disabled='disabled';
					sugerencia.style.display='none';
					sugerencia.disabled='disabled';	
					otra.style.display='none';
					otra.disabled='disabled';
					spryotra.style.display='none';
					spryotra.disabled='disabled';			
				}
			}
		}
	}
	
//inicio de porcentajes

}//fin de porcentajes
//fin para ocultar o mostrar elementos de acuerdo a respuest
</script>
<?php if($pdf==1)
{
	?>
<script>
alert('Información registrada correctamente\n\nPaso 5: Consultar/Imprimir Reporte (el cual se encuentra en la parte superior de la página).');
</script>	
	<?php 	
} ?>
</body>
</html>