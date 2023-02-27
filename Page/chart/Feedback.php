<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="/DACN/css/chart.css" rel="stylesheet">

    <link href="../../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
    require "../../ConnectDB.php";
    ?></head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <img src="../../img/logohutech.png" alt="" style="width: 200px; height: 45px;">
                </a>
                <div class="navbar-nav w-100">
                <a href="/DACN/homepage/giaovien.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Trang Chủ</a>
                    <a href="/DACN/Page/Lichday/Lichday.php?id=0" class="nav-item nav-link"><i class="fa fa-calendar me-2"></i>Lịch dạy</a>
                    <a href="./Chart.php?idTeacher=?&name=?&class=?&subject=?" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Biểu đồ</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bars me-2"></i> Khác</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/DACN/Login/logoutgiaovien.php" class="dropdown-item"><i class="fa fa-table me-2"></i>Đăng xuất</a>
                            <a href="/DACN/Login/logoutgiaovien.php" class="dropdown-item"><i class="fa fa-chart-bar me-2"></i>Thoát</a>
                        </div>
                    </div>
                    <a href="/DACN/Page/Support/Support.php" class="nav-item nav-link"><i class="fa fa-phone me-2"></i>Hỗ trợ</a>
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Thông Báo</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <?php require '../../ConnectDB.php';
                     $id=$_COOKIE['checkLogin'];
                     $sql="SELECT * FROM `notification` WHERE `IdUser`=$id ORDER BY `notification`.`id` DESC";
                     $result=$conn->query($sql);
                    
                     while($row = $result->fetch_assoc())
                     {
                        
                     echo('
                     <a href="'.$row['Link'].'" class="dropdown-item">
                         <h6 class="fw-normal mb-0">'.$row['content'].'</h6>
                         <small>15 phút trước</small>
                     </a>
                     <hr class="dropdown-divider">
                 ');
                     }
                     ?>
                        </div>
                    </div>
                    <?php
                     require "../../ConnectDB.php";
                     if(!empty($_COOKIE['checkLogin']))
                     {
                         
                         $id=$_COOKIE['checkLogin'];
                         $sql="SELECT * FROM `userInformation` WHERE `idUser`=$id";
                         $result=$conn->query($sql);
                         $row=$result->fetch_assoc();
                         if($row!=null)
                         {
                         echo('<div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                             <img class="rounded-circle me-lg-2" src="/DACN/img/'.$row['avatar'].'" alt=""
                                 style="width: 40px; height: 40px;">
                             <span class="d-none d-lg-inline-flex">'.$row['nameUser'].'</span>
                         </a>
                         <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                             <a href="/DACN/Page/informationUser/InformationUser.php" class="dropdown-item">Thông tin tài khoản</a>
                             <a href="#" class="dropdown-item">Cài đặt</a>
                             <a href="/DACN/Login/logout.php" class="dropdown-item">Đăng xuất</a>
                         </div>
                         </div>');
                         }
                         else{
                             echo("<script> var a=confirm('Login False! Please Check Your Input!');
                                 if(a==true)
                                 {
                                     location='../../Login/logout.php';
                                 }
                                 else{
                                     location='../../Login/logout.php';
                                 }
                                 </script>");
                         }
                    }
                   else{
                    echo('<div class="nav-item dropdown"  style="display:flex;">
                        <a href="" class="nav-link" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="/DACN/img/profile-42914_960_720.png" alt=""
                                style="width: 40px; height: 40px;">
                            <a href="../Login/login.html" class="d-none d-lg-inline-flex" style="margin-top:20px">Đăng nhập</a>
                        </a>    
                    </div>');
                   }
                    ?>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row">
                <?php
                 require "../../connectDB.php";
                 $id=$_COOKIE['checkLogin'];
                 $sql="SELECT nameUser,avatar,`address`,phoneNumber FROM `userInformation` WHERE `idUser`=$id";
                 $result=$conn->query($sql);
                 $row = $result->fetch_assoc();
                    echo('
                    <div class="circle col-3">
                        <img src="/DACN/img/'.$row['avatar'].'" alt="">
                    </div>
                    <div class="col-9">
                        <h1 id="nameTeacher">Thầy/Cô : 
                    ');
                       
                        echo($row['nameUser']."</h1>
                        <hr>
                        <h5>Số Điện Thoại: ".$row['phoneNumber']."</h5>
                        <h5>Địa Chỉ: ".$row['address']."</h5>

                        "); 
                        ?>
                    </div>
                </div>
                <hr>
                <?php
                 require "../../connectDB.php";
                 $id=$_COOKIE['checkLogin'];
                 if($_COOKIE['checkGV']==1)
                 {
                
              
                    echo("<h1  style='text-align:center; color:Red;'> Bạn Không Đủ Thẩm Quyền Để Xem Nội Dung Này!!!</h1>
                    <h3  style='text-align:center'>Xin Vui Lòng Thử Lại Sau</h3>");
                
                }
            else{
                if($_COOKIE['checkGV']==2)
                {
                    
                    $sql="SELECT b.`ID`,`nameUser` FROM `userInformation`b,`taikhoan` a WHERE a.`id`= b.`idUser` AND a.`authority`=1 AND b.faculty=(SELECT faculty FROM `userinformation` c WHERE c.IdUser='$id');";
                    $result=$conn->query($sql);
                    $get_idTeacher = $_GET['idTeacher'];
                    $get_name=$_GET['name'];
                    $get_class=$_GET['class'];
                    $get_subject=$_GET['subject'];
                    $count=0;
                    echo('  <div style="display:flex; margin-top:10px">
                    <button style="width:14%" type="button" class="btn btn-secondary">
                        Chọn GV
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo('<li><a class="dropdown-item" href="?idTeacher='.$row['ID'].'&name='.$row['nameUser'].'&class=?&subject=?" type="button">'.$row['nameUser'].'</a></li>');
                    }
                
                     echo('
                     
                    </ul>           
                </div>');
                $sql="SELECT a.`Class` FROM `surveyresults` a,`userInformation` b WHERE a.`idUserTeacher`='$get_idTeacher'  AND b.faculty=(SELECT faculty FROM `userinformation` c WHERE c.IdUser='$id') GROUP BY `Class`;";
                $result=$conn->query($sql);
            echo('
             <div style="display:flex; margin-top:10px">
                    <button style="width:14%" type="button" class="btn btn-secondary">
                        Chọn lớp
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo(' <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class='.$row['Class'].'&subject='.$get_subject.'" type="button">'.$row['Class'].'</a></li>');
                       
                    }
                    echo('  
                    <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class=?&subject=?" type="button">Tất Cả</a></li>
                    </ul>
                </div>
                ');
                $sql="SELECT a.`nameSubject` FROM `surveyresults` a,`userInformation` b WHERE a.`idUserTeacher`='$get_idTeacher'  AND b.faculty=(SELECT faculty FROM `userinformation` c WHERE c.IdUser='$id') GROUP BY `nameSubject`;";
                $result=$conn->query($sql);
                echo('
                    <div style="display:flex; margin-top:10px">
                    <button style="width:14%" type="button" class="btn btn-secondary">
                        Chọn Môn
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo(' <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class='.$get_class.'&subject='.$row['nameSubject'].'" type="button">'.$row['nameSubject'].'</a></li>');
                       
                    }
                    echo('  
                    <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class=?&subject=?" type="button">Tất Cả</a></li>
                    </ul>
                </div>
                ');
                echo('
                <hr> 
                  ');
                  $idTeacher=$_GET['idTeacher'];
                  $sql="SELECT * FROM `surveyresults`a,`userInformation` b WHERE a.`IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`= '$idTeacher'";
                  $id=$_COOKIE['checkLogin'];
                    $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND b.`idUser`='$id'";
                    if($_COOKIE['checkGV']==2)
                    {
                        $getId= $_GET['idTeacher'];
                        if($_GET['class']=="?" && $_GET['subject']=="?")
                        {
                            $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId'";
                        }
                        else{
                            if($_GET['class']=="?" && $_GET['subject']!="?")
                            {
                                $subject= $_GET['subject'];
                                $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`nameSubject`= '$subject' ";
                            }
                            else{
                                if($_GET['class']!="?" && $_GET['subject']=="?")
                                {
                                    $class=$_GET['class'];
                                    $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`Class`= '$class' ";
                                }else{
                                $class=$_GET['class'];
                                $subject= $_GET['subject'];
                                $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`nameSubject`= '$subject' AND a.`Class`='$class' ";
                                                    
                                }
                            }
                        
                        }
                    }
                  $result=$conn->query($sql);
                  $count=0;
                  while($row=$result->fetch_assoc()){
                      $count++;
                  }
                  if($count>=10){
                      echo('
                      <div algin="center"><h3>Giảng Viên:'.$_GET['name'].'</h3></div>
                      <h5 style="color:Gray">Đánh Giá Được Dựa Trên: '.$count.' Đánh Giá</h5>
                      ');
                      if(!empty($_GET['class']))
                      {
                        echo(' <h5 style="color:Black">Lớp '.$_GET['class'].'</h5>');
                        
                      }
                      //add feedback here
                      echo("
                    <div class='row' align='center' >
                            <div class='col-6' style='border:3px solid gray'>
                                <h3 style ='margin-top:10px' >
                                    Tích Cực
                                </h3>
                            </div>
                            <div class='col-6' style='border:3px solid gray'>
                                <h3 style ='margin-top:10px'>
                                    Tiêu Cực
                                </h3>
                            </div>
                      </div>
                    <div class='row' align='center' >
                        <div class='col-6' style='border:3px solid gray'>
                            <h5>
                                ");
                            $sqlSe="SELECT * FROM `feedback` WHERE `idUserTeacher`=$idTeacher";
                            $result1= $conn->query($sqlSe);
                        
                            $i=0;
                            $variable=array();
                            $variable1=array();
                            while($row=$result1->fetch_assoc())
                            {
                                if($row['good']>=0.3)
                                {
                                    array_push($variable, $row['Feedback']);
                                }
                                else
                                {
                                if($row['bad']>=0.7)
                                {
                                    array_push($variable1, $row['Feedback']);
                                }
                                else{
                                    array_push($variable, $row['Feedback']);
                                }
                                }
                            }
                            for($i=0;$i<count($variable);$i++)
                            {
                                echo("<h5>".$variable[$i]."</h5>");
                                echo("<hr>"); 
                            }
                            echo("<hr>"); 
                           
                            echo("
                            </h5>
                            </div>
                            <div class='col-6' style='border:3px solid gray'>
                            
                            ");
                            for($i=0;$i<count($variable1);$i++)
                            {
                                echo("<h5 style='margin-top:10px'>".$variable1[$i]."</h6>");
                                echo("<hr>"); 
                            }
                        echo("
                            
                        </div>
                    </div>
                      ");
                      
                  }
                }  
                else{
                    if($_COOKIE['checkGV']==3 )
                    {
                        $sql="SELECT b.`ID`,`nameUser` FROM `userInformation`b,`taikhoan` a WHERE a.`id`= b.`idUser` AND a.`authority`=1 ";
                        $result=$conn->query($sql);
                        $get_idTeacher = $_GET['idTeacher'];
                        $get_name=$_GET['name'];
                        $get_class=$_GET['class'];
                        $get_subject=$_GET['subject'];
                        $count=0;
                        echo('  <div style="display:flex; margin-top:10px">
                        <button style="width:14%" type="button" class="btn btn-secondary">
                            Chọn GV
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropright</span>
                        </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo('<li><a class="dropdown-item" href="?idTeacher='.$row['ID'].'&name='.$row['nameUser'].'&class=?&subject=?" type="button">'.$row['nameUser'].'</a></li>');
                    }
                
                     echo('
                     
                    </ul>           
                </div>');
                $sql="SELECT a.`Class` FROM `surveyresults` a,`userInformation` b WHERE a.`idUserTeacher`='$get_idTeacher'  GROUP BY `Class`;";
                $result=$conn->query($sql);
            echo('
             <div style="display:flex; margin-top:10px">
                    <button style="width:14%" type="button" class="btn btn-secondary">
                        Chọn lớp
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo(' <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class='.$row['Class'].'&subject='.$get_subject.'" type="button">'.$row['Class'].'</a></li>');
                       
                    }
                    echo('  
                    <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class=?&subject=?" type="button">Tất Cả</a></li>
                    </ul>
                </div>
                ');
                $sql="SELECT a.`nameSubject` FROM `surveyresults` a,`userInformation` b WHERE a.`idUserTeacher`='$get_idTeacher'  AND b.faculty=(SELECT faculty FROM `userinformation` c WHERE c.IdUser='$id') GROUP BY `nameSubject`;";
                $result=$conn->query($sql);
                echo('
                    <div style="display:flex; margin-top:10px">
                    <button style="width:14%" type="button" class="btn btn-secondary">
                        Chọn Môn
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo(' <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class='.$get_class.'&subject='.$row['nameSubject'].'" type="button">'.$row['nameSubject'].'</a></li>');
                       
                    }
                    echo('  
                    <li><a class="dropdown-item" href="?idTeacher='.$get_idTeacher.'&name='.$get_name.'&class=?&subject=?" type="button">Tất Cả</a></li>
                    </ul>
                </div>
                ');
                echo('
                <hr> 
                  ');
                      $idTeacher=$_GET['idTeacher'];
                      $sql="SELECT * FROM `surveyresults`a,`userInformation` b WHERE a.`IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`= '$idTeacher'";
                      if($_COOKIE['checkGV']==2 ||$_COOKIE['checkGV']==3)
                      {
                          $getId= $_GET['idTeacher'];
                          if($_GET['class']=="?" && $_GET['subject']=="?")
                          {
                              $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId'";
                          }
                          else{
                              if($_GET['class']=="?" && $_GET['subject']!="?")
                              {
                                  $subject= $_GET['subject'];
                                  $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`nameSubject`= '$subject' ";
                              }
                              else{
                                  if($_GET['class']!="?" && $_GET['subject']=="?")
                                  {
                                      $class=$_GET['class'];
                                      $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`Class`= '$class' ";
                                  }else{
                                  $class=$_GET['class'];
                                  $subject= $_GET['subject'];
                                  $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId' AND a.`nameSubject`= '$subject' AND a.`Class`='$class' ";
                                                      
                                  }
                              }
                          
                          }
                      }
                      $result=$conn->query($sql);
                      $count=0;
                      while($row=$result->fetch_assoc()){
                          $count++;
                      }
                      if($count>=10){
                        echo('
                        <div algin="center"><h3>Giảng Viên:'.$_GET['name'].'</h3></div>
                        <h5 style="color:Gray">Đánh Giá Được Dựa Trên: '.$count.' Đánh Giá</h5>
                        ');
                        if(!empty($_GET['class']))
                        {
                          echo(' <h5 style="color:Black">Lớp '.$_GET['class'].'</h5>');
                          
                        }
                        //add feedback here
                        echo("
                      <div class='row' align='center' >
                              <div class='col-6' style='border:3px solid gray'>
                                  <h3 style ='margin-top:10px' >
                                      Tích Cực
                                  </h3>
                              </div>
                              <div class='col-6' style='border:3px solid gray'>
                                  <h3 style ='margin-top:10px'>
                                      Tiêu Cực
                                  </h3>
                              </div>
                        </div>
                      <div class='row' align='center' >
                          <div class='col-6' style='border:3px solid gray'>
                              <h5>
                                  ");
                              $sqlSe="SELECT * FROM `feedback` WHERE `idUserTeacher`=$idTeacher";
                              $result1= $conn->query($sqlSe);
                          
                              $i=0;
                              $variable=array();
                              $variable1=array();
                              while($row=$result1->fetch_assoc())
                              {
                                  if($row['good']>=0.4)
                                  {
                                      array_push($variable, $row['Feedback']);
                                  }
                                  else
                                  {
                                  if($row['bad']>=0.7)
                                  {
                                      array_push($variable1, $row['Feedback']);
                                  }
                                  else{
                                      array_push($variable, $row['Feedback']);
                                  }
                                  }
                              }
                              for($i=0;$i<count($variable);$i++)
                              {
                                  echo("<h5>".$variable[$i]."</h5>");
                                  echo("<hr>"); 
                              }
                              echo("<hr>"); 
                             
                              echo("
                              </h5>
                              </div>
                              <div class='col-6' style='border:3px solid gray'>
                              
                              ");
                              for($i=0;$i<count($variable1);$i++)
                              {
                                  echo("<h5 style='margin-top:10px'>".$variable1[$i]."</h6>");
                                  echo("<hr>"); 
                              }
                          echo("
                              
                          </div>
                      </div>
                        ");
                        
                          
                      }
                  }
                }
             }
                ?>
                
            </div>
           
            <!-- Footer Start -->
            <footer class="bg-lighskyblue text-center text-black">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a href="https://www.facebook.com/profile.php?id=100010757443088">
                    <img src="/image/iconSocial1.jpg" width="50" alt=""></a>

                <a href="#">
                    <img src="/image/iconSocial2.png" width="55" alt=""></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(204, 229, 255, 0.8);">
            © 2022 Copyright:
            <a class="text-black" href="">QTP</a>
        </div>
        <div class="text-center p-3" style="background-color: rgba(204, 229, 255, 0.8);">
            Design by:
            <a class="text-white" href="">QTP </a>
            <a>Contact: dragonhatgame@gmail.com</a>
            , quytrup775@gmail.com, Phat
        </div>

        <!-- Copyright -->
            </footer>
            <!-- Footer End -->
        </div>



        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>