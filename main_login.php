<html>

<head>
<title>Login</title>
	 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
	 <style>
	 body {
        padding-top: 40px; 
      }
	 </style>
</head>
<body>
	<div class="container" style='width:350px';>
		<h2>Entrar</h2>
		<div class="well" style='background-color: #fff'>
			<form class = "well" action="checklogin.php" method="post" style="text-align: center">
				<input  name="myusername" type="text" id="myusername" PlaceHolder = "Username">	<br>	
				<input name="mypassword" type="password" id="mypassword" PlaceHolder = "Password"><br>
				<input class="btn btn-primary" type="submit" name="Submit" value="Login">
			</form>
		</div>
	</div>
	<div id='copyrightDiv' style="text-align:center">
		&copy; <a>Francisco Couceiro</a><br>
		&copy; <a href='http://www.miroelectronics.com/'>Miroelectronics</a><br>
		<a href='http://site.onetag.pt/'>Powered by onetag</a>
	</div>
</body>
</html>


