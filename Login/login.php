<?php
    require '../ConnectDB.php';
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if(!empty($user) || !empty($pass)){
        $sql='SELECT * FROM taikhoan';
        $result=$conn->query($sql);
        $flag=0;
        while ($row=$result->fetch_assoc()){    
            if($row['username']==$user)
            {
                if($row['password']==$pass)
                    {   
                        setcookie("checkLogin",$row['id'],time()+(83000*30),"/");
                        setcookie("checkGV",$row['authority'],time()+(83000*30),"/");
                        echo("<script>alert('Login successful');</script>");
                        $flag=1;
                        if($row['authority']==0)
                        {
                            echo("<script>location='../homepage/main.php'</script>");
                        }
                        else{
                            echo("<script>location='../homepage/giaovien.php'</script>");
                        }
                        
                    }
            }
        }
        if($flag!=0)
        {
        /* echo("<script> var a=confirm('Login False! Please Check Your Input!');
                if(a==true)
                {
                    location='login.html';
                }
                else{
                    location='login.html';
                }
                </script>");*/
        }
    }
    else{
                /*echo("<script> var a=confirm('Login False! Please Check Your Input!');
                if(a==true)
                {
                    location='login.html';
                }
                else{
                    location='login.html';
                }
                </script>");*/
            
    }

?>