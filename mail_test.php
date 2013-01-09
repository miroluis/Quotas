<?php
 $to = "miroluis@gmail.com";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you? Teste de from 3";
 $headers = "From: programacao@onetag.pt";
 if (mail($to, $subject, $body, $headers)) {
   echo("<p>Message successfully sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
  }
 ?>