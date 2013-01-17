<!DOCTYPE html>
<html>

<head>
<title>Bem-vindo - Quotas</title>
	<meta charset="UTF-8" />
	 <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> 
	 <style>
	 body {
	 	padding-top: 30px;
         


      }

      body .test2{
      	background-color: transparent; 
            background-image:url('signup.jpg');
            background-repeat:no-repeat;
      }
	 </style> 
</head>
<body>



	<div class='well container' id='cointaner_geral' style="height:320px;width:500px;">
		

		<div class='container'>
			<h2 > Bem-vindo ao gestor de quotas!</h2>
			<div class="well test2" style="height:216px;width:460px;">
				<button class='btn btn-success' onclick='window.location.assign("index_quotas.php");' type="button">Entrar</button>
				<button class='btn btn-success inline' onclick='window.location.assign("signup.html");' type="button">Sign up</button>
			</div>
		</div>
		<div class="alert alert-error alert-block" id='alertaDiv' style='visibility:hidden'></div>
	</div>
	<div class="well container" style=" text-align: center;">
		Esta aplicação permite a gestão de quotas de associados e respectivos recibos.
		Com ela pode informar por email, quem tem quotas em atraso ou informar que as mesmas já estão pagas.
		Pode entrar e exprimentar com user: demo pass: demo

		Qualquer sugestão ou critica não exite em contactar pelo email de suporte
	</div>

<?php
 require($DOCUMENT_ROOT . "./copyright.html");
 ?>
<!-- <iframe id="extFrame" src="copyright.html"></iframe>

<include src = "copyright.html" type = "text/html" />

<object name="foo" type="text/html" data="copyright.html"></object>

 -->

	<br>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    	var appendMsg = false;

    	 function appendMessage(ele)
	  	{
	  	if(!ele)
	  	{
	  		document.getElementById('alertaDiv').style.visibility = 'hidden'; 
	  		
	  		document.getElementById('cointaner_geral').style.height = '320px'; 
	  	}
	  	else
	  	{
	  		document.getElementById('alertaDiv').style.visibility = 'visible'; 
	  		document.getElementById('cointaner_geral').style.height = '390px'; 
	  	}
	  	appendMsg = ele;
	  	}

    	window.onload = function()
    	{
    		 var link = new String(window.location);
             var il = link.indexOf('=') + 1;
             var erro_signup = link.substring(il);
             if(erro_signup == "failed")
             {
             	appendMessage(true);
             	document.getElementById('alertaDiv').innerHTML = "<a class='btn close' onclick='appendMessage(false);'>&times;</a>Username ou password errada!";
             }
    	}
    </script>
</body>
</html>