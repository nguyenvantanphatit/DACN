<?php

require '../../ConnectDB.php';
echo ("<pre>");
//print_r($_COOKIE['ketqua']);
$b= $_GET['comment'];
$c= $_GET['idU'];
$d= $_GET['idT'];
$a=explode("-",$_COOKIE['ketqua'] );
$sql="INSERT INTO `feedback`( `IdUser`, `IdUserTeacher`, `Feedback`, `good`, `bad`, `nomal`)
 VALUES ('$c','$d','$b','".$a[0]."','".$a[1]."','".$a[2]."')";
if($conn->query($sql)==true)
{  echo("<script>
    location='./Danhgia.php';
</script>");
}
  
else{
    echo("<script>
    location='./Danhgia.php';
</script>");

}

// function float_rand($Min, $Max, $round=0){
//     //validate input
//     $min=0;$max=0;
//     if ($Min>$Max)
//     { $min=$Max; $max=$Min;}
//     else { $min=$Min; $max=$Max; }
//     $randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
//     if($round>0)
//         $randomfloat = round($randomfloat,$round);

//     return $randomfloat;}
//     $i=4;
// while($i<=120)
// {
//     $a = float_rand(0,1);
//     $b = float_rand(0,1);
//     $c = float_rand(0,1);   
//     print_r($a);
//     $sql="UPDATE `feedback` SET `good`='$a',`bad`='$b',`nomal`='$c' WHERE `ID_FB`='$i' ";
//     $conn->query($sql);
//     $i++;
// }

?>