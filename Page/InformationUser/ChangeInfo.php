<?php
    require '../../ConnectDB.php';
    try {
        $name=$_POST['name'];
        $class=$_POST['class'];
        $faculty=$_POST['faculty'];
        $phoneNumber=$_POST['phoneNumber'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $idUser=$_COOKIE['checkLogin'];
        $newImageName=uniqid();
        $imageExtension=explode('.',$_FILES["avatar"]["name"]);
        $imageExtension=strtolower(end($imageExtension));
        $tmpName=$_FILES["avatar"]["tmp_name"];
        $newImageName .='.'.$imageExtension;
        move_uploaded_file($tmpName,'../../img/'.$newImageName);
        print_r($newImageName);
        $sql = "UPDATE `userinformation` SET `nameUser`='$name', `class`='$class',
        `faculty`='$faculty', `phoneNumber`='$phoneNumber', `email`='$email', `address`='$address', `avatar`='$newImageName'
        WHERE `IdUser`='$idUser'";
            if($conn->query($sql)){
                echo("Successfully make change!!");
                echo("<script>location='InformationUser.php'</script>");    
            }else{
                echo("Failed to make change!!");
                echo("<script>location='InformationUser.php'</script>");        
            }
        }
       catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }     
?>