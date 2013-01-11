<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
session_start();
//if($_SESSION["Login"]="No"){
if(!isset($_SESSION['myusername']) ){
	//!session_is_registered(myusername)){
	header("location:main_login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Quotas</title>

	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">  

	<style>
		body .teste4
		{

			background-color: green; 
		}
	</style>

	
</head>
<body class="preview" >
	<h1 style='text-align:center'>Gestor de quotas</h1>

		

	<?php
		
		include('DBModel.php');
		LigaBD();
		ProcuraAnos();
		setTable();
		closedb();
	?>

    
		 
		<a class="btn btn-primary span2" rel="tooltip" title="Adiciona um de cada vez" data-placement="right" id="addbtn" type="button"  onclick='insnewRow(this);'>Adicionar elemento</a>
		<a class="btn btn-small span2 offset4" type="button" onclick='mostraReciboOuFactura("recibo");'>Aviso de recibo</a>
		<a class="btn btn-small  span2" type="button" onclick='mostraReciboOuFactura("quota");'>Aviso de quota</a>
		
		
	</div>
	<br><br>
         

	<div class='container' style="text-align:center">
    	
      	Escreva aqui o e-mail a ser enviado:
    
    	<form>
	    	<textarea class="field span12" id="textareaemail" rows="5" placeholder="Introduza o texto a enviar..."></textarea>
	    	<br>
	    	<div class="alert alert-success alert-block" id='alertaDiv' style='visibility:hidden'>
    		</div>
    		
	    	<button class="btn btn-info btn-large" onclick='sendemail();' type="button">Send</button>
    	</form>

    	
    	
	</div>

	<div id='copyrightDiv' style="text-align:center">
		<button class="btn btn-error btn-mini" onclick='window.location.assign("logout.php");' type="button">Log out!</button>
		<a class="btn btn-error btn-mini inline" href="newuser.html" type="button"><i class="icon-user"></i>Adicionar novo utilizador</a><br>
		
		<br><div class='well container' id='copyrightDiv' style="text-align:center">
		&copy; <a>Francisco Couceiro</a><br>
		&copy; <a href='http://www.miroelectronics.com/'>Miroelectronics</a><br>
		<a href='http://site.onetag.pt/'>Powered by onetag</a>
	</div>
	</div>

 	<br>
	


	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/bootstrap-tooltip.js"></script>

	<script type="text/javascript">
		var appendMsg = true;
		var checkgeral = true;
		var canAdd = true;

	  function checkUpdate(btn)
	  {
	  	var tablerows = document.getElementById('tabela').rows;
	
	  	switch(btn)
	  	{
	  		case 0://geral
			  	for(var i=1; i<tablerows.length; i++)
			  	{
			  		var inputs = tablerows[i].cells[0];
			  		
	  				if(checkgeral)
	  				{
	  					if(inputs.childNodes[0] != undefined)
	  					inputs.childNodes[0].checked = true;
	  					appendMessage(false);
	  				}
	  				else
	  				{
	  					if(inputs.childNodes[0] != undefined)
	  					inputs.childNodes[0].checked = false;
	  					appendMessage(false);
	  				}
			  		
			  	} 
		  	break;
		  	case 1://devedores
		  		for(var i=1; i<tablerows.length; i++)
			  	{
			  		var cells = tablerows[i].cells;
			

	  				if((cells[5].innerHTML == "0") || (cells[5].innerHTML == null))
	  				{
	  					if(cells[0].childNodes[0] != undefined)
	  					cells[0].childNodes[0].checked = true;
	  				}
	  				else
	  				{
	  					if(cells[0].childNodes[0] != undefined)
	  					cells[0].childNodes[0].checked = false;
	  					
	  				}
			  		
			  	} 
			  //	document.getElementById('alertaDiv').innerHTML = "<a class='btn close' onclick='appendMessage(false);'>&times;</a>O senhor 'Exemplo' deve a quota 'quota-exemplo' referentes ao 'ano-exemplo'.";
			  //		appendMessage(true);
			  			  	 mostraReciboOuFactura("quota");
		  	break;
		  	case 2://com recibo
		  		for(var i=1; i<tablerows.length; i++)
			  	{
			  		var cells = tablerows[i].cells;
			

	  				if((cells[5].innerHTML != "0") && (cells[5].innerHTML != null))
	  				{
	  					if(cells[0].childNodes[0] != undefined)
	  					cells[0].childNodes[0].checked = true;
	  				}
	  				else
	  				{
	  					if(cells[0].childNodes[0] != undefined)
	  					cells[0].childNodes[0].checked = false;
	  					
	  				}
			  		
			  		
			  	} 
			 // 	document.getElementById('alertaDiv').innerHTML = "<a class='btn close' onclick='appendMessage(false);'>&times;</a>O senhor 'Exemplo' pagou as quotas referentes ao 'ano-exemplo' e o recibo tem o numero: 'recibo-exemplo'.";
			  //		appendMessage(true);
			  					  	 mostraReciboOuFactura("recibo");
		  	break;
	  	}
	  	
	  	if(checkgeral) checkgeral = false;
	  	else checkgeral = true;
	  }

	  function mostraReciboOuFactura(ele)
	  {
	  	if(ele!='quota')
	  	{
	  	  	document.getElementById('alertaDiv').innerHTML = "<a class='btn close' onclick='appendMessage(false);'>&times;</a>O senhor 'nome-exemplo' pagou as quotas referentes ao ano 'ano-exemplo' e o recibo tem o numero: 'recibo-exemplo'.";
			  	
	  	}
	  	else
	  	{
	  		document.getElementById('alertaDiv').innerHTML = "<a class='btn close' onclick='appendMessage(false);'>&times;</a>O senhor 'nome-exemplo' deve uma quota no valor de 'quota-exemplo' (EUROS) referente ao ano 'ano-exemplo'.";
	  	}
		appendMessage(true);
	  }

	  function appendMessage(ele)
	  {
	  	if(!ele)
	  	{
	  		document.getElementById('alertaDiv').style.visibility = 'hidden'; 
	  		
	  	}
	  	else
	  	{
	  		document.getElementById('alertaDiv').style.visibility = 'visible'; 
	  	}
	  	appendMsg = ele;
	  }

		function sendemail()
		{
				

				var table=document.getElementById("tabela");
				var tablerows = table.rows;
				var cells;

				for(var i=1;i<(tablerows.length);i++ )
				{
					cells = tablerows[i].cells;
					
					if(cells[0].childNodes[0].id == document.getElementById('entryCheckbox').id)
					{
						if(cells[0].childNodes[0].checked)
						{
							var name = cells[1].innerHTML;
							var email = cells[2].innerHTML;
							var quota = cells[4].innerHTML;
							var recibo = cells[5].innerHTML;

							var text = getEmailText();
							var temp = document.getElementById('tabela').getAttribute('name');
							//send e-mail code block here
							if(appendMsg)
							{
								var append = document.getElementById('alertaDiv').innerHTML;
								 var il = append.indexOf('</a>') + 4;
             					var prev = append.substring(il);

             					if(prev.indexOf("'nome-exemplo'") != -1);
             					{
             						prev = prev.replace("'nome-exemplo'",name);
             					}
             					if(prev.indexOf("'ano-exemplo'") != -1);
             					{
             						prev = prev.replace("'ano-exemplo'",temp);
             					}
             					if(prev.indexOf("'quota-exemplo'") != -1);
             					{
             						prev = prev.replace("'quota-exemplo'",quota);
             					}
             					if(prev.indexOf("'recibo-exemplo'") != -1);
             					{
             						prev = prev.replace("'recibo-exemplo'",recibo);
             					}

								text = text + "\n" + prev;
							
							}
							$.post("email_man.php", { to : email, subject : name, body : text},
							function(data) {
					
							
							});

							
						}
					}
				
					
				}
		}

		function insnewRow(ele)
		{
			if(canAdd)
			{
			var x=document.getElementById('tabela').insertRow(document.getElementById('tabela').rows.length);
			var a=x.insertCell(0);
			var b=x.insertCell(1);
			var c=x.insertCell(2);
			var d=x.insertCell(3);
			var e=x.insertCell(4);
			var f=x.insertCell(5);
			var g=x.insertCell(6);
			
			a.innerHTML="<td></td>";
			b.innerHTML="<td><input type='text' id='txtNome' style='width:100px' placeholder='Nome...'></td>";
			c.innerHTML="<td><input type='text' id='txtEmail' style='width:100px' placeholder='Email...'></td>";
			d.innerHTML="<td><select id='comboSeccao'><option>Lobitos</option><option>Exploradores</option><option>Pioneiros</option><option>Caminheiros</option><option>Chefes</option></select></td>";
			e.innerHTML="<td><input type='text' id='txtQuota' style='width:100px' placeholder='Quota...'></td>";
			f.innerHTML="<td><input type='text' id='txtRecibo' style='width:100px' placeholder='Recibo...'></td>";
			g.innerHTML="<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='teste1' onclick='fixontable(this);'><i class='icon-ok'></i></button><button class='btn btn-mini btn-danger' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
			
			canAdd = false;
			document.getElementById('addbtn').className += " disabled";
			}
		}
		


		function getEmailText()
		{
			var text = document.getElementById('textareaemail').value;
			return text;
		}

		function fixontable(ele)
		{
			var elem = ele;
			var currow = elem.parentNode.parentNode.parentNode;
			var cells_row = currow.cells;

			var curcells = currow.getElementsByTagName('td');
			var a = curcells[1].childNodes[0].value;
			var b = curcells[2].childNodes[0].value;
			var c = curcells[3].childNodes[0].value;
			var d = curcells[4].childNodes[0].value;
			var e = curcells[5].childNodes[0].value;

			cells_row[1].innerHTML = a;
			cells_row[2].innerHTML = b;
			cells_row[3].innerHTML = c;
			cells_row[4].innerHTML = d;
			cells_row[5].innerHTML = e;
			cells_row[6].innerHTML = "<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i><button class='btn btn-mini btn-danger' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
			var temp = document.getElementById('tabela').getAttribute('name');
			var query = "INSERT into "+temp+" (nome,email,seccao,quota,recibo) values ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"');";
				$.post("managedb.php", { sql_query : query},
					function(data) {
						canAdd = true;
						document.getElementById("addbtn").className = document.getElementById("addbtn").className.replace( /(?:^|\s)disabled(?!\S)/g , '' )
						window.location.reload();
					});
		}

		function updateontable(ele)
		{
			var elem = ele;
			var currow = elem.parentNode.parentNode.parentNode;
			var ident = currow.getAttribute('id');
		
			var cells_row = currow.cells;

			var curcells = currow.getElementsByTagName('td');
			var a = curcells[1].childNodes[0].value;
			var b = curcells[2].childNodes[0].value;
			var c = curcells[3].childNodes[0].value;
			var d = curcells[4].childNodes[0].value;
			var e = curcells[5].childNodes[0].value;

			cells_row[1].innerHTML = a;
			cells_row[2].innerHTML = b;
			cells_row[3].innerHTML = c;
			cells_row[4].innerHTML = d;
			cells_row[5].innerHTML = e;
			cells_row[6].innerHTML = "<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i></button><button class='btn btn-mini btn-danger' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
			var temp = document.getElementById('tabela').getAttribute('name');

			var query = "UPDATE "+temp+" SET nome='"+a+"',email='"+b+"',seccao='"+c+"',quota='"+d+"',recibo='"+e+"' WHERE id='"+ident+"';";
				$.post("managedb.php", { sql_query : query},
					function(data) {
					
					});
		}

		function moveRow(trigger, up)
		{
			var curRow = trigger.parentNode.parentNode.parentElement;
			var index = curRow.rowIndex;

			var x = null;

			if(up)
			{
				if(--index != 0)
				{
					x=document.getElementById('tabela').insertRow(index);
				
				}
			}
			else
			{
				if((++index) != (curRow.parentElement.length - 1))
				{
					
					x=document.getElementById('tabela').insertRow(++index);
				
				}
			}

			if(x != null)
			{
				var a=x.insertCell(0);
				var b=x.insertCell(1);
				var c=x.insertCell(2);
				var d=x.insertCell(3);
				var e=x.insertCell(4);
				var f=x.insertCell(5);
				var g=x.insertCell(6);
				
				var cells_row = curRow.cells;
				
				a.innerHTML=cells_row[0].innerHTML;
				b.innerHTML=cells_row[1].innerHTML;
				c.innerHTML=cells_row[2].innerHTML;
				d.innerHTML=cells_row[3].innerHTML;
				e.innerHTML=cells_row[4].innerHTML;
				f.innerHTML=cells_row[5].innerHTML;
				g.innerHTML=cells_row[6].innerHTML;
				curRow.parentElement.deleteRow(curRow.rowIndex);

				saveTable();
			}
			
			
		}

		function removeRow(ele)
		{
			var row = ele.parentNode.parentNode.parentNode;
			var id_row = row.id;
			
			var table =document.getElementById('tabela');

			if(id_row == "")
			{
				table.deleteRow(row.rowIndex);
				
				return;
			}

																	
			var cells = row.getElementsByTagName('td');
			var nome = cells[1].innerHTML;
			var email = cells[2].innerHTML;
			
			
			table.deleteRow(row.rowIndex);
			var temp = document.getElementById('tabela').getAttribute('name');
			var query = "DELETE FROM "+temp+" WHERE nome = '"+nome+"' AND email = '"+email+"' AND id='"+id_row+"';";
				$.post("managedb.php", { sql_query : query},
					function(data) {
					
			
					});
			
		}
		

		function changeYear(ele)
		{
			var new_ano = ele.innerHTML;
			
			var query = "UPDATE ano_activo SET ano='"+new_ano+"' WHERE id='0';";
			$.post("managedb.php", { sql_query : query},
				function(data) {
				
					window.location.reload();
				});
		}



		function editRow(ele)
		{
				var cur_row = ele.parentNode.parentNode.parentElement;
				var cells_r = cur_row.cells;
			
				var nome = cells_r[1].innerHTML;
				var email = cells_r[2].innerHTML;
				var quota = cells_r[4].innerHTML;
				var recibo = cells_r[5].innerHTML;

				cells_r[1].innerHTML="<td><input type='text' id='txtNome' style='width:100px' placeholder='"+nome+"'></td>";
				cells_r[2].innerHTML="<td><input type='text' id='txtEmail' style='width:100px' placeholder='"+email+"'></td>";
				cells_r[3].innerHTML="<td><select id='comboSeccao'><option>Lobitos</option><option>Exploradores</option><option>Pioneiros</option><option>Caminheiros</option><option>Chefes</option></select></td>";
				cells_r[4].innerHTML="<td><input type='text' id='txtQuota' style='width:100px' placeholder='"+quota+"'></td>";
				cells_r[5].innerHTML="<td><input type='text' id='txtRecibo' style='width:100px' placeholder='"+recibo+"'></td>";
				cells_r[6].innerHTML="<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='teste1' onclick='updateontable(this);'><i class='icon-ok'></i></button><button class='btn btn-mini btn-danger' onclick='removeRowfromedit(this,\""+nome+"\",\""+email+"\");'><i class='icon-remove'></i></button></div></td>";
		
		}

		function removeRowfromedit(ele, nome,email)
		{
			var row = ele.parentNode.parentNode.parentNode;
			var id_row = row.id;
		
			var table =document.getElementById('tabela');
			
			
			table.deleteRow(row.rowIndex);
			var temp = document.getElementById('tabela').getAttribute('name');
			var query = "DELETE FROM "+temp+" WHERE nome = '"+nome+"' AND email = '"+email+"' AND id='"+id_row+"';";
				$.post("managedb.php", { sql_query : query},
					function(data) {
					
			
					});
			
		}

		window.onload = function()
		{
			$('#addbtn').tooltip('hide');
		}
	</script>

	<!--http://localhost-->
</body>
</html>
