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


    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <?php
         $quyen=$_COOKIE['checkGV'];
         print_r($quyen);  
        if(!empty($quyen))
        {
            if($quyen==1 || $quyen==2 )
            { 
                echo(' <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="#" class="navbar-brand mx-4 mb-3">
                        <img src="/DACN/img/logohutech.png" alt="" style="width: 200px; height: 45px;">
                    </a>
                    <div class="navbar-nav w-100">
                    <a href="/DACN/homepage/giaovien.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Trang Chủ</a>
                        <a href="/DACN/Page/Lichday/Lichday.php" class="nav-item nav-link"><i class="fa fa-calendar me-2"></i>Lịch dạy</a>
                        <a href="/DACN/Page/chart/Chart.php?idTeacher=?&name=?&class=?&subject=?" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Biểu đồ</a>
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
            </div>');
            }
            else{
                echo(' <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="#" class="navbar-brand mx-4 mb-3">
                        <img src="../../img/logohutech.png" alt="" style="width: 200px; height: 45px;">
                    </a>
                    <div class="navbar-nav w-100">
                    <a href="/DACN/homepage/main.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Trang Chủ</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-laptop me-2"></i>Học Tập</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="/DACN/Page/Hoctap/Thoikhoabieu.php?id=0" class="dropdown-item">Thời Khoá Biểu</a>
                                <a href="/DACN/Page/Hoctap/Lop.php" class="dropdown-item">Lớp</a>
                            </div>
                        </div>
                        <a href="/DACN/Page/Danhgia/Danhgia.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Khảo sát</a>
                      
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bars me-2"></i> Khác</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="/DACN/Login/logout.php" class="dropdown-item">Đăng xuất</a>
                                <a href="/DACN/Login/logout.php" class="dropdown-item">Thoát</a>
                            </div>
                        </div>
                        <a href="/DACN/Page/Support/Support.php" class="nav-item nav-link"><i class="fa fa-phone me-2"></i>Hỗ trợ</a>
                       
                    </div>
                </nav>
            </div>');
            }
        }
        else{
          
           // echo("<script>location='/DACN/Login/logout.php'</script>");
        }
       
    ?>
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
                            <a href="/DACN/Page/informationUser/informationUser.php" class="dropdown-item">Thông tin tài khoản</a>
                            <a href="/DACN/Page/Option/Option.php" class="dropdown-item">Cài đặt</a>
                            <a href="/DACN/Login/logout.php" class="dropdown-item">Đăng xuất</a>
                        </div>
                        </div>');
                        }
                        else{
                            echo("<script> var a=confirm('Login False! Please Check Your Input!');
                                if(a==true)
                                {
                                    location='../Login/logout.php';
                                }
                                else{
                                    location='../Login/logout.php';
                                }
                                </script>");
                        }
                    }
                   else{
                    echo('<div class="nav-item dropdown"  style="display:flex;">
                        <a href="" class="nav-link" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../../img/profile-42914_960_720.png" alt=""
                                style="width: 40px; height: 40px;">
                            <a href="../../Login/login.html" class="d-none d-lg-inline-flex" style="margin-top:20px">Đăng nhập</a>
                        </a>    
                    </div>');
                   }
                    ?>
                </div>
            </nav>
            <!-- Navbar End -->
            <?php
                if(!empty($_COOKIE['checkLogin'])){
                    $id=$_COOKIE['checkLogin'];
                    $sql="SELECT * FROM `userInformation` WHERE `idUser`=$id";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    $img=$row['avatar'];
                    $add=$row['address'];
                    $name=$row['nameUser'];
                    $class=$row['class'];
                    $faculty=$row['faculty'];
                    $email=$row['email'];
                echo('
                    <form action="ChangeInfo.php" method="post" enctype="multipart/form-data">
                        <div style="display: inline-block">
                            <img src="/DACN/img/'.$img.'" alt="" style="margin-left: 70%; margin-top: 20px; margin-bottom: 20px; height: 200px; width: 200px;border-radius: 100px;">
                            <input type="file" id="image" accept=".jpg, .jpeg, .png" value="Thay đổi avatar" name="avatar" 
                            style="margin-left:70%; border: none; margin-bottom: 20px; background: transparent; color: rgb(38, 84, 170);"/>
                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Họ và tên người dùng</h5>
                            <input type="text" value="'.$name.'" name="name" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">

                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Lớp</h5>
                            <input type="text" value="'.$class.'" name="class" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">
                       
                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Khoa</h5>
                            <input type="text" value="'.$faculty.'" name="faculty" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">
                     
                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Số điện thoại</h5>
                            <input type="text" value='.$row['phoneNumber'].' name="phoneNumber" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">
                 
                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Email</h5>
                            <input type="text" value='.$email.' name="email" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">
                      
                        </div>
                        <div>
                            <h5 style="display: inline-flex; width:20%; margin-top: 10px;">Địa chỉ</h5>
                            <input type="text" value="'.$add.'" name="address" style="width: 60%; height: 40px; border-radius: 50px; margin-bottom: 20px; padding-left: 1.5%;">
                            
                        </div>
                        <div>
                            <input type="submit" value="Thay đổi" style="margin-left:40%; color: rgb(38, 84, 170);"/>
                        </div>
                    </form>
                    ');
                }else{
                    echo('<h1>Please login first!!</h1>');
                }
            ?>


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
    <script src="../js/main.js"></script>
</body>

</html>