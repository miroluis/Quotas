<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8" />
    <title>Sign Up</title>
    

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }

    </style>

</head>
<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="login-form">
					<h2>Sign up</h2>
					<div>
						
							
								<input type="text" id='txtUsername' placeholder="Username">
						
								<input type="password" id='txtPassword' placeholder="Password">
						
                <input type="password" id='txtPasswordConf' placeholder="Confirm password">
              
             
                <input type="email" id='txtEmail' placeholder="Email address">
              
							<button class="btn btn-primary" onclick='checkSignUp();'>Submit</button>
						
					</div>
				</div>
			</div>
		</div>
	</div> <!-- /container -->

  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
          function checkSignUp()
          {
              var pass = document.getElementById('txtPassword').value;
              var confpass = document.getElementById('txtPasswordConf').value;
              if(pass != confpass) return false;

              var user = document.getElementById('txtUsername').value;
              var email = document.getElementById('txtEmail').value;
            
             var query = "INSERT into users (username,password,email) values ('"+user+"','"+pass+"','"+email+"');";
        $.post("managedb.php", { sql_query : query},
          function(data) {
          alert("Insert return: " + data);
          window.location.href = "index.php";
          });
          }
    </script>
</body>
</html>
