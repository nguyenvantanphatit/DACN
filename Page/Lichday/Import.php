<?php
        require '../../ConnectDB.php';
        if(isset($_POST["import"])){
        $filename = $_FILES["excel"]["name"];
        $fileExtension= explode('.',$filename);
        $fileExtension=strtolower(end($fileExtension));
        $newFileName = date("Y.m.d")."-".date("h-i-sa").".".$fileExtension;
        $targetDirectory= "upload/".$newFileName;
        move_uploaded_file($_FILES["excel"]["tmp_name"], $targetDirectory);
        error_reporting(0);
        ini_set('display_errors',0);
        require "ExcelReader/excel_reader2.php";
        require "ExcelReader/SpreadsheetReader.php";
        $reader = new SpreadsheetReader($targetDirectory);
        $i=0;
        foreach($reader as $key => $row){
            echo("<pre>");  
            print_r($row);
            if($i!=0){
            $subject=$row[1];
            $day=$row[2];
            $room=$row[3];
            $lesson=$row[4];
            $stStudy=$row[5];
            $enStudy=$row[6];
            $idTeacher=$row[7];
            $IdUser=$row[8];
            $sql="INSERT INTO `schedule`(`ID`, `Subjects`, `Day`, `Room`, `Lesson`, `startStudying`, `endStudying`, `idTeacher`, `IdUser`) 
            VALUES ('8','$subject','$day','$room','$lesson','$stStudy','$enStudy','$idTeacher','$IdUser')";
            $result=$conn->query($sql);
            if($conn->query($sql)==true);
            }
            $i++;
        }
        print_r($subject);
        if(!unlink("./".$targetDirectory)){
            header("location: Lichday.php");
        }
        echo('<script>alert("Successfully Imported!!")<script/>');
    }
