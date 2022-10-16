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
                        echo("<script>alert('Login successful')'</script>");
                        echo("<script>location='../homepage/main.php'</script>");
                    }
            }
        }
    }

?>