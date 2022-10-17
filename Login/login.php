<?php
    require '../ConnectDB.php';
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if(!empty($user) || !empty($pass)){
        $sql='SELECT * FROM taikhoan';
        $result=$conn->query($sql);
        while ($row=$result->fetch_assoc()){
            if($row['username']==$user)
            {
                if($row['password']==$pass)
                    {   
                        setcookie("checkLogin",$row['username'],time()+(83000*30),"/");
                        setcookie("checkGV",$row['authority'],time()+(83000*30),"/");
                        echo("<script>alert('Login successful');</script>");
                        echo("<script>location='../homepage/main.php'</script>");
                    }
            }
        }
    }

?>