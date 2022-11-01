<?php
require "../../ConnectDB.php";
$min=0;
$max=100;
  $a =random_int($min, $max);
  $b =random_int($min, $max);
  $c =random_int($min, $max);
  $d =random_int($min, $max);
  $e =random_int($min, $max);
  $f =random_int($min, $max);
  $sql="INSERT INTO `surveyresults`(`IdUser`, `IdUserTeacher`, `Tprepare`, `TContent`, `TMethod`, `testingMethod`, `TRules`, `professionalManner`) 
  VALUES ('1','1','$a',' $b',' $c',' $d',' $e', '$f')";
  if($conn->query($sql))
  {
    echo('ok');
  }
?>