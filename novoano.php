<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8" />
    <title>Iniciar um novo ano</title>
    

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
        width: 350px;
      }

    </style>

</head>
<body>
	<div class="container">
		<div class="well" style='background-color: #fff'>
					<h2>Iniciar um novo ano</h2>
					<div>
						
							
								<input type="text" id='txtAno' placeholder="Ano">
						
								<input type="text" id='qLobitos' placeholder="Quota lobitos">
                <input type="text" id='qExploradores' placeholder="Quota exploradores">
                <input type="text" id='qPioneiros' placeholder="Quota pioneiros">
                <input type="text" id='qCaminheiros' placeholder="Quota caminheiros">
                <input type="text" id='qChefes' placeholder="Quota chefes">
                <label class="radio">
                  <input type="checkbox" name="optionsRadios" id="replicar_id" value="option1">
                  Replicar ano selecionado?
                </label>
                
              
							<button class="btn btn-primary" onclick='checkForm();'>Criar</button>
						   <a class="btn btn-primary inline offset2" href="index.php">Voltar</a>
					</div>
				</div>
			</div>

  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
          function checkForm()
          {
             var ano = document.getElementById('txtAno').value;
             var qLobitos = document.getElementById('qLobitos').value;
             var qExploradores = document.getElementById('qExploradores').value;
             var qPioneiros = document.getElementById('qPioneiros').value;
             var qCaminheiros = document.getElementById('qCaminheiros').value;
             var qChefes = document.getElementById('qChefes').value;
             var replicar = document.getElementById('replicar_id').checked;
             
             var link = new String(window.location);
             var il = link.indexOf('=') + 1;
             var prevAno = link.substring(il);
             
             if(replicar)
             {
              var query = "CREATE TABLE "+ano+" LIKE "+prevAno+";";
              $.post("managedb.php", { sql_query : query},
                function(data){
                  alert(data);
                  var query_a = "INSERT into "+ano+" SELECT * from "+prevAno+";";
                  $.post("managedb.php", { sql_query : query_a},
                    function(data) {
                      
                           var query_a = "UPDATE "+ano+" SET `quota` = ''";
                          $.post("managedb.php", { sql_query : query_a},
                    function(data) {
                              var query_a = "UPDATE "+ano+" SET `recibo` = ''";
                             $.post("managedb.php", { sql_query : query_a},
                              function(data) {
                      

                      //
                            });

                      //
                    });
                      
                    });
                });

             }
          }
    </script>
</body>
</html>
