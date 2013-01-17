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
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/bootstrap-tooltip.js"></script>
  <meta charset="UTF-8" />
  <title>Configura email</title>


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
  <script>
  function load()
  {
    document.getElementById('curanoLabel').style.visibility='hidden';
  }
  </script>

</head>
<body onload="load()">
	<div class="container" >
		<div class="well" style='background-color: #fff'>
     <h2>Configuração de email para envio</h2>
     <div>


      <input type="text" id='smtp' rel="toltip" data-placement="right" title="exemplo smtp.gmail.com" placeholder="smtp" >

      <input type="text" id='username' placeholder="username do email">
      <input type="text" id='password' placeholder="password do email">

      <div  style='text-align:center'>

        <?php
        include('DBModel.php');
        LigaBD();
        getLabel();
        closedb();



        ?>

      </div>
      <br>

      <button  class="btn btn-primary" onclick='checkForm();'>Guardar</button>
      <a class="btn btn-primary inline offset1" href="index_quotas.php">Voltar</a>
    </div>
  </div>
</div>


<script type="text/javascript">

function onLoad(){

}

function checkForm()
{

//.style.display = 'none';

var qsmtp = document.getElementById('smtp').value;
var qusername = document.getElementById('username').value;
var qpassword = document.getElementById('password').value;


var prevAno = document.getElementById('curanoLabel').getAttribute('name');
//alert(prevAno);

var nomeBD = prevAno.substr(0,prevAno.indexOf("_"));

  var query_a = "UPDATE "+nomeBD+"_"+"configura_email SET `smtp` = '"+qsmtp+"'";
  $.post("managedb.php", { sql_query : query_a},
    function(data) {
      var query_a = "UPDATE "+nomeBD+"_"+"configura_email SET `username` = '"+qusername+"'";
      $.post("managedb.php", { sql_query : query_a},
        function(data) {
          var query_a = "UPDATE "+nomeBD+"_"+"configura_email SET `password` = '"+qpassword+"'";
          $.post("managedb.php", { sql_query : query_a},
            function(data) {
              window.location.assign("index_quotas.php");
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
