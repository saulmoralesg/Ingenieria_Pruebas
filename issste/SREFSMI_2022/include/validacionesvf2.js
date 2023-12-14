function mascara(o,f,c,i)
{  
		v_obj=o;  
		v_fun=f; 
		v_caja=c+i;
		var oculto=0;
		setTimeout("execmascara()",1);  
	}  
	function execmascara(){   
		v_obj.value=v_fun(v_obj.value);
	}  
	function cpf(v){ 
		v=v.replace(/([^0-9\.]+)/g,''); 
		v=v.replace(/^[\.]/,''); 
		v=v.replace(/[\.][\.]/g,''); 
		v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2'); 
		v=v.replace(/\.(\d{1,2})\./g,'.$1'); 
		v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');    
		v = v.split('').reverse().join('').replace(/^[\,]/,''); 
		
		oculto=v.replace(/\,/g,'');
		oculto=oculto.replace(/\,/g,'');	
		parseFloat(document.form1.elements[v_caja+'g'].value=(oculto));				
		
		return v;  
}

function number_format(c,i)
{
	var id=c.id;
	//asio estaba var num= document.form1.elements[j].value.replace(/\,/g,'');
	var num= document.getElementById(id).value.replace(/([^0-9]+)/g,''); 
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');       				
	num = num.split('').reverse().join('').replace(/^[\,]/,'');
	document.getElementById(id).style.textAlign='right';
	document.getElementById(id).value=num;	
}

function fopcion(c)
{
	var respuesta = c.options[c.selectedIndex].value;		
	if(respuesta=="SI")	
	{
		/*document.getElementById("contenido").style.display='none';*/
		document.getElementById("guardar").style.display='block';
	}
	else if(respuesta=="NO")	
	{
		/*document.getElementById("contenido").style.display='none';*/
		document.getElementById("guardar").style.display='block';	
		document.getElementById('pwd').focus();
	}
	else
	{
		/*document.getElementById("contenido").style.display='none';*/
		document.getElementById("guardar").style.display='none';		
	}
	
}

function valida()
{
	var agree; 
	agree=confirm("¿Datos correctos?");	
	if(agree)	
	return true;		
	else
	return false;
}

function gregistro()
{
	var agree, excedentea, excedenteh, faltantea, faltanteh, pacientesxfila=0, totalxfila=0, causasxfila=0, filassindatos=0, txt="", sumaexcyfalt=0, sumapacientes=0;	
	var nregistros=document.getElementById("nregistros").value;	
	
	for(i=1; i<=nregistros; i++)
	{
		excedentea=document.getElementById('excedentea'+i).value;
		excedenteh=document.getElementById('excedenteh'+i).value;
		faltantea=document.getElementById('faltantea'+i).value;
		faltanteh=document.getElementById('faltanteh'+i).value;
		
		pacientesxfila=document.getElementById('pacientes'+i).value;
		totalxfila=excedentea+excedenteh+faltantea+faltanteh;
		
		causasxfila=document.getElementById('causa'+i).value;
		
		sumaexcyfalt+=totalxfila;
		sumapacientes+=pacientesxfila;		
		
		if((faltantea!="" || faltanteh!="") && (causasxfila==-1 || pacientesxfila==""))
		{
			++filassindatos;
			txt += "" + i+", ";
		}
		else if((excedentea!="" || excedenteh!="") && (pacientesxfila==""))
		{
			++filassindatos;
			txt += "" + i+", ";
		}
		
		
		//else if(totalxfila=="" && pacientesxfila>0)
		{
			//++filassindatos;
			//txt += "" + i+", ";
		}		
		//else if(totalxfila>0 && pacientesxfila=="")
		{
			//++filassindatos;
			//txt += "" + i+", ";
		}		

	}		
	
	if(sumaexcyfalt==0)
	{
		alert("SIN DATOS QUE GUARDAR");
		return false;
	}	
	else if(sumaexcyfalt==0 && sumapacientes==0)
	{
		alert("SIN DATOS QUE GUARDAR");
		return false;
	}
	else if(filassindatos<1)
	{
		agree=confirm("¿DATOS CORRECTOS?");	
		if(agree)
		{
			var guardar=document.getElementById('btnsubmit').style.display='none';
			window.setInterval (BlinkIt, 500);
			var color = "red";
			function BlinkIt ()
			{
				var blink = document.getElementById('etiquetaguardar');
				color = (color == "#ffffff") ? "red" : "#ffffff";
				blink.style.display='block';
				blink.style.color = color;
				blink.style.fontSize='18px';
			}
			return true;
		}
		else
		return false;
	}
	else
	{
		if(filassindatos>1)
		alert("INFORMACIÓN INCOMPLETA \n\nLas filas "+txt+" ESTAN INCOMPLETAS. REVISE INFORMACIÓN.");
		else
		alert("INFORMACIÓN INCOMPLETA \n\nLa fila "+txt+" ESTA INCOMPLETA. REVISE INFORMACIÓN.");
		
		return false;	
	}
}

function block(o,i)
{
	var total=0;
	var pacientexfila=document.getElementById('pacientes'+i).value;
	var causaxfila=document.getElementById('causa'+i).value;
	
	if(o=='excedentea' || o=='excedenteh')
	{	
		var excedentea=document.getElementById('excedentea'+i).value;
		var excedenteh=document.getElementById('excedenteh'+i).value;
		total=excedentea+excedenteh;		
		
		if(total=="" || total==0)
		{
			document.getElementById('faltantea'+i).style.backgroundColor="white";
			document.getElementById('faltantea'+i).disabled='';
			
			document.getElementById('faltanteh'+i).style.backgroundColor="white";
			document.getElementById('faltanteh'+i).disabled='';	
			
			//document.getElementById('causa'+i).style.backgroundColor="CCC";
			//document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).style.display='none';			
			document.getElementById('selectInvalidMsg'+i).style.display='none';
			
			//document.getElementById('pacientes'+i).style.backgroundColor="CCC";
			//document.getElementById('pacientes'+i).disabled='disabled';
			document.getElementById('pacientes'+i).disabled='disabled';
			document.getElementById('pacientes'+i).style.display='none';
			document.getElementById('textfieldRequiredMsg'+i).style.display='none';			
		}
		else
		{
			document.getElementById('faltantea'+i).style.backgroundColor="#CCC";
			document.getElementById('faltantea'+i).disabled='disabled';
			
			document.getElementById('faltanteh'+i).style.backgroundColor="#CCC";
			document.getElementById('faltanteh'+i).disabled='disabled';	
			
			//document.getElementById('causa'+i).style.backgroundColor="CCC";
			//document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).style.display='none';			
			document.getElementById('selectInvalidMsg'+i).style.display='none';
			
			//document.getElementById('pacientes'+i).style.backgroundColor="white";
			//document.getElementById('pacientes'+i).disabled='';			
			document.getElementById('pacientes'+i).disabled='';
			document.getElementById('pacientes'+i).style.display='';
			if(pacientexfila!="")			
			document.getElementById('textfieldRequiredMsg'+i).style.display='none';
			else
			document.getElementById('textfieldRequiredMsg'+i).style.display='';
		}
	}
	else if(o=='faltantea' || o=='faltanteh')
	{
		var faltantea=document.getElementById('faltantea'+i).value;
		var faltanteh=document.getElementById('faltanteh'+i).value;
		total=faltantea+faltanteh;		
		
		if(total=="" || total==0)
		{
			document.getElementById('excedentea'+i).style.backgroundColor="white";
			document.getElementById('excedentea'+i).disabled='';
			
			document.getElementById('excedenteh'+i).style.backgroundColor="white";
			document.getElementById('excedenteh'+i).disabled='';		
			
			//document.getElementById('causa'+i).style.backgroundColor="CCC";
			//document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).disabled='disabled';
			document.getElementById('causa'+i).style.display='none';
			document.getElementById('selectInvalidMsg'+i).style.display='none';			
			
			//document.getElementById('pacientes'+i).style.backgroundColor="CCC";
			//document.getElementById('pacientes'+i).disabled='disabled';
			document.getElementById('pacientes'+i).disabled='disabled';
			document.getElementById('pacientes'+i).style.display='none';
			document.getElementById('textfieldRequiredMsg'+i).style.display='none';			
		}
		else
		{
			document.getElementById('excedentea'+i).style.backgroundColor="#CCC";
			document.getElementById('excedentea'+i).disabled='disabled';
			
			document.getElementById('excedenteh'+i).style.backgroundColor="#CCC";
			document.getElementById('excedenteh'+i).disabled='disabled';
			
			//document.getElementById('causa'+i).style.backgroundColor="white"; ayer
			//document.getElementById('causa'+i).disabled='';		hoy	
			document.getElementById('causa'+i).disabled='';
			document.getElementById('causa'+i).style.display='';
			if(causaxfila==-1)
			{
				document.getElementById('selectInvalidMsg'+i).style.display='';
				//document.getElementById('causa'+i).style.backgroundColor="white"; hoy
			}
			else
			document.getElementById('selectInvalidMsg'+i).style.display='none';
			
			//document.getElementById('pacientes'+i).style.backgroundColor="white";
			//document.getElementById('pacientes'+i).disabled='';
			document.getElementById('pacientes'+i).disabled='';
			document.getElementById('pacientes'+i).style.display='';
			if(pacientexfila!="")
			document.getElementById('textfieldRequiredMsg'+i).style.display='none';
			else
			document.getElementById('textfieldRequiredMsg'+i).style.display='';			
		}
	}	
}

function fdels(i)
{
	var dd=document.getElementById("del"+i).value;
	var dl=document.getElementById("delegoumae"+i).value;	
	
	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", "indexunidades.php");
	var params = {del:dd, delegoumae:dl};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

function ums(i)
{
	var dd=document.getElementById("del").value;
	var dl=document.getElementById("delegoumae").value;
	var c=document.getElementById("clp"+i).value;
	var cls=document.getElementById("clues"+i).value;
	var ns=document.getElementById("nom_sec"+i).value;
	var ni=document.getElementById("nom_imss"+i).value;
	
	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", "grupoyespecialidad2.php");
	var params = {del:dd, delegoumae:dl, clp:c, clues:cls,  nom_sec:ns, nom_imss:ni, opcion:"SI"};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

/*function xyz(i,d)
{
	var dd=document.getElementById("del").value;
	var dl=document.getElementById("delegoumae").value;
	var c=document.getElementById("clp").value;
	var cls=document.getElementById("clues").value;
	var ns=document.getElementById("nom_sec").value;
	var ni=document.getElementById("nom_imss").value;
	var g=document.getElementById("grupo"+i).value;
	var e=document.getElementById("esp"+d).value;

	var php = "registro.php";

	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", php);
	var params = {del:dd, delegoumae:dl, clp:c, clues:cls,  nom_sec:ns, nom_imss:ni, grupo:g, especialidad:e, opcion:"SI"};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}*/

function xyz(i)
{
	var dd=document.getElementById("del").value;
	var dl=document.getElementById("delegoumae").value;
	var c=document.getElementById("clp").value;
	var cls=document.getElementById("clues").value;
	var ns=document.getElementById("nom_sec").value;
	var ni=document.getElementById("nom_imss").value;
	var g=document.getElementById("grupo"+i).value;

	var php = "registro.php";

	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", php);
	var params = {del:dd, delegoumae:dl, clp:c, clues:cls,  nom_sec:ns, nom_imss:ni, grupo:g, opcion:"SI"};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

function xyz2(i)
{
	var dd=document.getElementById("del").value;
	var dl=document.getElementById("delegoumae").value;
	var c=document.getElementById("clp").value;
	var cls=document.getElementById("clues").value;
	var ns=document.getElementById("nom_sec").value;
	var ni=document.getElementById("nom_imss").value;
	var g=document.getElementById("grupo"+i).value;

	var php = "grupoyespecialidad2.php";

	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", php);
	var params = {del:dd, delegoumae:dl, clp:c, clues:cls,  nom_sec:ns, nom_imss:ni, grupo:g, opcion:"SI"};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}



function pdf(ver, statusquo,d)
{
	/*document.getElementById("reportepdf"+i).style.display='none';	
	window.setInterval (BlinkIt, 300);
			var color = "red";
			function BlinkIt () 
			{
				var blink = document.getElementById('etiquetapdf'+i);
				color = (color == "#ffffff") ? "red" : "#ffffff";
				blink.style.display='block';
				blink.style.color = color;
				//blink.style.fontSize='18px';
			}		
	*/		
	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", "reporte/reportexdel.php");
	var params = {del:d, version:ver, status:statusquo};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

function cerrar(d,dlg)
{
	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", "cerrar.php");
	var params = {del:d, delegoumae:dlg};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

function fbuscar(o)
{	
	var obj=o.toUpperCase();
	obj=obj.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
	
	var nregistros=document.getElementById("nregistros").value;
	var arreglo=Array();
	var coinciden=Array();
	var indices=Array();
	var indice;

	var string="";	
	var valor;
	var elemento;
	
	coinciden[0]="";
	document.getElementById('sincoincidencias').style.display='none';	
	
	for(i=1; i<=nregistros; i++)
	{
		document.getElementById('fila'+i).style.display='none';	
		elemento=document.getElementById("producto"+i).value.toUpperCase();
		arreglo[i]=elemento.normalize("NFD").replace(/[\u0300-\u036f]/g, "");		
	}	

	coinciden = arreglo.filter(word => word.includes(obj));
	
	for(i=0; i<=coinciden.length; i++)
	{	
		valor=coinciden[i];		
		if(arreglo.indexOf(valor)!=-1)
		{
			indice=arreglo.indexOf(valor);			
			indices.push(indice);
		}		
	}	
	
	if(coinciden.length>0)
	{	
		for(i=0; i<=indices.length; i++)
		{					
			valor=indices[i];		
			document.getElementById('fila'+valor).style.display='';
			//document.getElementById('fila'+valor).replace(obj, `<mark>$&</mark>`);
		}
	}
	else
	document.getElementById('sincoincidencias').style.display='';	
}

function fcerrar(c)
{
	var respuesta = c.options[c.selectedIndex].value;			
	if(respuesta=="SI")	
	{
		document.getElementById("contenido").style.display='none';
		document.getElementById("guardar").style.display='block';
		document.getElementById('pwd').focus();
	}
	else
	{
		document.getElementById("contenido").style.display='none';
		document.getElementById("guardar").style.display='none';		
	}
}

function subir(ver, statusquo,d)
{
	var form = document.createElement("form");
    form.setAttribute("method", "POST");
	
    form.setAttribute("action", "pwdu.php");
	var params = {del:d, version:ver, status:statusquo};
    for(var key in params) {
    if(params.hasOwnProperty(key)) 
	{
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();	
}

function validaf()
{
	var agree="";
	var filascondatos=0;
	var fullPath = document.getElementById('upload').value;

	if (fullPath) 
	{
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);		

	    const lastDot = filename.lastIndexOf('.');
		const fileName = filename.substring(0, lastDot);
  		const ext = filename.substring(lastDot + 1);
  
		if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) 
		{filename = filename.substring(1);}    
		
		//if(filename && ext=='pdf')
		if(filename)
		++filascondatos;	
		else		
		filascondatos=0;
		//alert("FORMATO INVÁLIDO. SOLO SE ACEPTAN ARCHIVOS EN FORMATO PDF.");	
	}

	if(filascondatos>0)
	{
		agree=confirm("¿DESEA GUARDAR EL ARCHIVO SELECCIONADO?");
		if(agree)
		{
			var guardar=document.getElementById('btnsubmit').style.display='none';
			var archivo=document.getElementById('upload').style.display = 'none';		
			var archivo=document.getElementById('uploadb').style.display = 'block';
			window.setInterval (BlinkIt, 500);
			var color = "red";
			function BlinkIt ()
			{
				var blink = document.getElementById('etiquetaguardar');
				color = (color == "#ffffff") ? "red" : "#ffffff";
				blink.style.display='block';
				blink.style.color = color;
				blink.style.fontSize='18px';
			}		
			return true;
		}
		else
		return false;
	}
	else 
	{
		alert("SIN ARCHIVO QUE GUARDAR");
		return false;		
	}
}

function validacombo(e,obj,i)
{
	if(e=='select')
	{
		if(obj.value!=-1)
		document.getElementById('selectInvalidMsg'+i).style.display='none';
		else
		document.getElementById('selectInvalidMsg'+i).style.display='';
	}
	else if(e=='text')
	{
		if(obj.value!='')
		document.getElementById('textfieldRequiredMsg'+i).style.display='none';
		else
		document.getElementById('textfieldRequiredMsg'+i).style.display='';
	}	
}