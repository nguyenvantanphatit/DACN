<?php
    require "../../ConnectDB.php";
    require_once './PHPExcel/Classes/PHPExcel.php';
    $filename = $_FILES["excel"]["name"];
    $fileExtension= explode('.',$filename);
    $fileExtension=strtolower(end($fileExtension));
    $newFileName = date("Y.m.d")."-".date("h-i-sa").".".$fileExtension;
    $targetDirectory= "upload/".$newFileName;
    move_uploaded_file($_FILES["excel"]["tmp_name"], $targetDirectory);
    $file=$targetDirectory;
    $objFile = PHPExcel_IOFactory::identify($file);
    $objData = PHPExcel_IOFactory::createReader($objFile);
    $objData->setReadDataOnly(true);
    $objPHPExcel = $objData->load($file);
   
     $sheet = $objPHPExcel->setActiveSheetIndex(0);
    $Totalrow = $sheet->getHighestRow();
    $LastColumn = $sheet->getHighestColumn();
    $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
    $data = [];
    for ($i = 2; $i <= $Totalrow; $i++) {
     for ($j = 0; $j < $TotalCol; $j++) {
           $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
           
        }
    }
    echo '<pre>';
    var_dump($data);
    for($i = 0; $i < count($data); $i++){
        
        $sql="INSERT INTO `schedule`( `Subjects`, `Day`, `Room`, `Lesson`, `startStudying`, `endStudying`, `idTeacher`, `IdUser`) 
        VALUES ('".$data[$i][0]."','".$data[$i][1]."','".$data[$i][2]."','".$data[$i][3]."','".$data[$i][4]."','".$data[$i][5]."','".$data[$i][6]."','".$data[$i][7]."')";
        $conn->query($sql);
    }
?>
