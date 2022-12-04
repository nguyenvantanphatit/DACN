<?php
require "../../ConnectDB.php";
    echo("<pre>");
    print_r($_POST);
    $list=array();
    $tam1 =round(( $_POST['1a']+$_POST['1b']+$_POST['1c']+$_POST['1d']+$_POST['1e'])/5); 
    $tam2= round(($_POST['2a']+$_POST['2b']+$_POST['2c']+$_POST['2d'])/4); 
    $tam3=round( ($_POST['3a']+$_POST['3b']+$_POST['3c']+$_POST['3d'])/4);
    $tam4= round(($_POST['4a']+$_POST['4b'])/2);
    $tam5=round( ($_POST['5a']+$_POST['5b']+$_POST['5c'])/3);
    $tam6 =round(($_POST['6a']+$_POST['6b']+$_POST['6c']+$_POST['6d'])/4);
    $idUser= $_COOKIE['checkLogin'];
    $idTeacher=$_POST['idTeacher'];
    $sql="INSERT INTO `surveyresults`(`IdUser`, `IdUserTeacher`, `Tprepare`, `TContent`, `TMethod`, `testingMethod`, `TRules`, `professionalManner`) 
    VALUES ('$idUser','$idTeacher','$tam1',' $tam2',' $tam3',' $tam4',' $tam5',' $tam6')";
    if($conn->query($sql))
    {
        
        echo("<script>a= confirm('THANKS YOU!!');
        if(a==true)
        {
            location='./saveCMDG.php?comment=".$_POST['comment']."&idU=$idUser&idT=$idTeacher';
        }
        else{
            location='./saveCMDG.php?comment=".$_POST['comment']."&idU=$idUser&idT=$idTeacher';
        } </script>");
    }
?>