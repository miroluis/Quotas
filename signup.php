<?php

  
  $nova_db_name = $_POST['nova_db_s'];
  $novo_user = $_POST['novo_user_s'];
  $password_user = $_POST['novo_user_pass_s'];
  $novo_user_email = $_POST['novo_user_email_s'];

	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

  criarDB($nova_db_name);

  $adicionar_user = "INSERT into users.users (username, password, email, database_name) values ('".$novo_user."','".$password_user."','".$novo_user_email."','".$nova_db_name."');";
  $r_dois = mysql_query($adicionar_user);

  $select_db = "UPDATE  users.curDB SET database_name='".$nova_db_name."' WHERE id='0';";
  $r_tres = mysql_query($select_db);

  header('location:index_quotas.php');

  function criarDB($new_db)
  {


      $q_1 = "CREATE DATABASE `".$new_db."` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
      $q_2 = "USE `".$new_db."`";

      // Table structure for table `ano_activo`


      $q_3 = "CREATE TABLE `ano_activo` (
        `id` int(11) DEFAULT NULL,
        `ano` varchar(100) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


      // Dumping data for table `ano_activo`


      $q_4 = "INSERT INTO `ano_activo` (`id`, `ano`) VALUES
      (0, 'exemplo\n');";



      // Table structure for table `exemplo`


      $q_5 = "CREATE TABLE `exemplo` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `nome` varchar(100) DEFAULT NULL,
        `email` varchar(100) DEFAULT NULL,
        `seccao` varchar(100) DEFAULT NULL,
        `quota` float DEFAULT NULL,
        `recibo` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";



      // Table structure for table `guarda_email`

      $q_6 = "CREATE TABLE `guarda_email` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `email` varchar(35) NOT NULL,
        `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `body` varchar(1000) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

      mysql_query($q_1);
      mysql_query($q_2);
      mysql_query($q_3);
      mysql_query($q_4);
      mysql_query($q_5);
      mysql_query($q_6);
  } 
?>