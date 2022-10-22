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
        if(!empty($name) && !empty($class) && !empty($faculty) && !empty($phoneNumber) && !empty($email) && !empty($address)){
            if(!empty($imageExtension)){
                $sql = "UPDATE `userinformation` SET `nameUser`='$name', `class`='$class',
                `faculty`='$faculty', `phoneNumber`='$phoneNumber', `email`='$email', `address`='$address', `avatar`='$newImageName'
                WHERE `IdUser`='$idUser'";
                move_uploaded_file($tmpName,'../../img/'.$newImageName);
                if($conn->query($sql)){ 
                    echo("<script>alert('Successfully make change!! Reload page to see yur change!')</script>");
                    echo("<script>location='/DACN/Page/InformationUser/InformationUser.php'</script>");  
                }else{
                    echo("<script>Failed to make change!!</script>");
                    echo("<script>location='/DACN/Page/InformationUser/InformationUser.php'</script>");
                }
            }else{
                $sql = "UPDATE `userinformation` SET `nameUser`='$name', `class`='$class',
                `faculty`='$faculty', `phoneNumber`='$phoneNumber', `email`='$email', `address`='$address'
                WHERE `IdUser`='$idUser'";
                if($conn->query($sql)){
                    echo("<script>alert('Successfully make change!! Reload page to see yur change!')</script>");
                    echo("<script>location='/DACN/Page/InformationUser/InformationUser.php'</script>");  
                }else{
                    echo("<script>Failed to make change!!</script>");
                    echo("<script>location='/DACN/Page/InformationUser/InformationUser.php'</script>");
                }
            }
        }else{
            echo("<script>alert('Please type every information!!!')</script>");
            echo("<script>location='/DACN/Page/InformationUser/InformationUser.php'</script>");
        }
    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }     
?>