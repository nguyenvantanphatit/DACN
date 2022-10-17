<?php
$ten= $_COOKIE['checkLogin'];
$quyen= $_COOKIE['checkGV'];
setcookie("checkLogin",$ten,time()+(0),"/");
setcookie("checkGV",$quyen,time()+(0),"/");
echo("<script>location='/DACN/homepage/giaovien.php'</script>")
?>