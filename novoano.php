<?php
  session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }
  ?>
  
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
	<div class="container" >
		<div class="well" style='background-color: #fff'>
					<h2>Iniciar um novo ano</h2>
					<div>
						
							
								<input type="text" id='txtAno' placeholder="Ano">
						
								<input type="text" id='qLobitos' placeholder="Quota lobitos">
                <input type="text" id='qExploradores' placeholder="Quota exploradores">
                <input type="text" id='qPioneiros' placeholder="Quota pioneiros">
                <input type="text" id='qCaminheiros' placeholder="Quota caminheiros">
                <input type="text" id='qChefes' placeholder="Quota chefes">
                <div  style='text-align:center'>
                  
                  <?php

                  include('DBModel.php');
                  LigaBD();
                  getLabel();
                  closedb();
                  ?>
                
              </div>
                <br>
              
							<button class="btn btn-primary" onclick='checkForm();'>Criar</button>
						   <a class="btn btn-primary inline offset2" href="index_quotas.php">Voltar</a>
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
           
             
             var prevAno = document.getElementById('curanoLabel').getAttribute('name');
            //alert(prevAno);

              var nomeBD = prevAno.substr(0,prevAno.indexOf("_"));

             // alert("o nome da base de dados é: "+nomeBD);
             
              var query = "CREATE TABLE "+nomeBD+"_"+ano+" LIKE "+prevAno+";";
              $.post("managedb.php", { sql_query : query},
                function(data){

                  if(data == "")
                  {
                    alert("Coloque o ano neste formato: 2012_2013 (exemplo)");
                    return ;
                  }
                  var query_a = "INSERT into "+nomeBD+"_"+ano+" SELECT * from "+prevAno+";";
                  $.post("managedb.php", { sql_query : query_a},
                    function(data) {
                      
                           var query_a = "UPDATE "+nomeBD+"_"+ano+" SET `quota` = ''";
                          $.post("managedb.php", { sql_query : query_a},
                    function(data) {
                              var query_a = "UPDATE "+nomeBD+"_"+ano+" SET `recibo` = ''";
                             $.post("managedb.php", { sql_query : query_a},
                              function(data) {
                                ano = nomeBD+"_"+ano;
                              // alert(ano);
                                  $.post("atribui_quotas.php", { qLobitos : qLobitos, qExploradores : qExploradores, qPioneiros : qPioneiros, qCaminheiros : qCaminheiros, qChefes : qChefes, ano : ano},
                              function(data) {
                                 //alert("sai");
                                  window.location.assign("index_quotas.php");
                      //
                            });
                      //
                            });

                      //
                    });
                      
                    });
                });

            
          }
    </script>

    <?php
 require($DOCUMENT_ROOT . "copyright.html");
 ?>
</body>
</html>
