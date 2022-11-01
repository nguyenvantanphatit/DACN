<?php
require "../../ConnectDB.php";
$id=$_COOKIE['checkLogin'];
echo("<script> console_log('$id')</script>");
$sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND b.`idUser`='$id'";
$result=$conn->query($sql);
$list=array();
while($row=$result->fetch_assoc())
{
    $arraytam= array($row['Tprepare'],$row['TContent'],$row['TMethod'],$row['testingMethod'],$row['TRules'],$row['professionalManner']);
    array_push($list,$arraytam);
}
$arraygiatri=array();

for($j=0;$j<6;$j++)
{
    $count0=0;
    $count10=0;
    $count25=0;
    $count50=0;
    $count80=0;
    for($i=0;$i<count($list);$i++)
    {
        if($list[$i][$j]>0)
        {
            if($list[$i][$j]>10)
            {
                if($list[$i][$j]>25)
                {
                    if($list[$i][$j]>50)
                    {
                            $count80++;
                    }
                    else{
                        $count50++;
                    }
                }
                else{
                    $count25++;
                }
            }
            else{
                $count10++;
            }
        }
        else{
            $count0++;
        }
    }
    $arraytam=array($count0,$count10,$count25,$count50,$count80);
    array_push($arraygiatri,$arraytam);
}
echo("<pre>");
print_r($arraygiatri);
?>