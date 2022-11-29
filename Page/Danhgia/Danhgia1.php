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
        if(!empty($_COOKIE['checkLogin']))
        {
            
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
        else{
            echo("<script>location='/DACN/Login/logout.php'</script>");
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
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
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
                            <a href="/DACN/Login/login.html" class="d-none d-lg-inline-flex" style="margin-top:20px">Đăng nhập</a>
                        </a>    
                    </div>');
                   }
                    ?>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row form-group">
                    
                    <h1>Giảng Viên: <?php require "../../ConnectDB.php";
                    $id= $_GET['idTeacher'];
                    $sql="SELECT nameUser FROM `userInformation` WHERE `idUser`=$id";
                    $result=$conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo($row['nameUser']); ?></h1>
                    <h3 style='color:lightblack'>Lớp: 19DTHA3</h3>
                    <form action="./saveDG.php" method="post">
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Thời gian có mặt ở lớp học của bạn chiếm bao
                                    nhiêu % thời gian quy định của môn học?
                                </label>
                                <div class="form-check">
                                    <input  type="radio" name="1a" class="form-check-input" id="validationFormCheck2" value='25'required>0 - 25%
                                    
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="1a" class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="1a" class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="1a" class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 1: Chuẩn bị giảng dạy. Giảng viên có công bố đầy đủ cho SV về:</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Đề cương chi tiết
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='1b' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1b' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Mục tiêu học tập chung của môn học, cách thức kiểm tra đánh giá
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='1c' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1c' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1c' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1c' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Mục tiêu học tập cụ thể của từng phần, hoặc chương, bài, hay tiết học
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='1d' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1d' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1d' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1d' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Giáo trình/bài giảng, tài liệu tham khảo và cách thức tìm các tài liệu học
                                    tập của môn học
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='1e' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1e' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1e' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='1e' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 2: Nội dung giảng dạy của giảng viên</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Bám sát mục tiêu học tập môn học, trong từng phần, chương, bài
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='2a' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2a' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2a' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2a' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Khoa học, rõ ràng, chính xác
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='2b' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2b' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Cập nhật kiến thức mới
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='2c' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2c' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2c' class="form-check-input"id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2c' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Chỉ ra được các ứng dụng thực tiễn (liên hệ thực tế)
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='2d' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2d' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2d' class="form-check-input"id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='2d' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 3: Phương pháp giảng dạy</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Dễ hiểu, hấp dẫn, sinh động tạo hứng thú học tập cho SV
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='3a' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3a' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3a' class="form-check-input"id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3a' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Có ý kiến phản hồi tích cực cho SV về phương pháp học tập sau kiểm tra đánh
                                    giá
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='3b' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3b' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Có hướng dẫn SV tự học trên lớp và tự học ngoài lớp cụ thể, rõ ràng, hiệu quả
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='3c' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3c' class="form-check-input" id="validationFormCheck2" value='50' required> 26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3c'  class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3c'  class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">
                                    Khuyến khích sự chủ động và sáng tạo của SV trong học tập
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='3d'  class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3d' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3d' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='3d' class="form-check-input"id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 4: Kiểm tra đánh giá</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Phương pháp đánh giá kết quả học tập phù hợp, đa dạng và đảm bảo độ giá trị,
                                    tin cậy.
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='4a' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4a' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4a' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4a' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Giảng viên khách quan, công bằng trong kiểm tra đánh giá
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='4b' class="form-check-input"  id="validationFormCheck2" value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4b' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='4b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 5: Thực hiện quy chế giảng dạy của giảng viên</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Vào/ra lớp đúng giờ
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='5a' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5a' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5a' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5a' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Thực hiện giảng dạy theo đúng thời khóa biểu
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='5b' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5b' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Giảng dạy đủ số giờ qui định
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='5c' class="form-check-input" id="validationFormCheck2"  value='25' required> 0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5c' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5c' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='5c' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 6: Tác phong sư phạm</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Nhiệt tình và có trách nhiệm
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='6a' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6a' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6a' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6a' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">
                                    Bao quát được SV trên lớp
                                </label>
                                <div class="form-check">
                                    <input type="radio" name='6b' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6b' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6b' class="form-check-input" id="validationFormCheck2" value='79' required >51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio"  name='6b' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Có thái độ thân thiện với SV
                                </label>
                                <div class="form-check"> 
                                    <input type="radio" name='6c' class="form-check-input" id="validationFormCheck2"   value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio"  name='6c' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio"  name='6c' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio"  name='6c' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label class=" form-control-label">Quan tâm đến sự tiến bộ của SV cả kiến thức, kỹ năng và thái độ
                                </label>
                                <div class="form-check">
                                    <input type="radio"  name='6d' class="form-check-input" id="validationFormCheck2"  value='25' required>0 - 25%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6d' class="form-check-input" id="validationFormCheck2" value='50' required>26 - 50%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6d' class="form-check-input" id="validationFormCheck2" value='79' required>51 - 79%
                                </div>
                                <div class="form-check">
                                    <input type="radio" name='6d' class="form-check-input" id="validationFormCheck2" value='100' required>80 - 100%
                                </div>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <label for=""><h4>Tiêu chí 7: Những hạn chế mà sinh viên đang gặp phải</h4></label>
                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <div class="row form-group">
                                    <label class=" form-control-label">Để Lại 1 FeedBack Về Giảng Viên Trên</label>
                                    <input type="text">
                                </div>
                               
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top:10px">Đánh giá</button>
                                <input type="text" name="idTeacher" style='display:none' value='<?php $id=$_GET['idTeacher'];
                                $id= $_GET['idTeacher'];
                                $sql="SELECT ID FROM `userInformation` WHERE `idUser`=$id";
                                $result=$conn->query($sql);
                                $row = $result->fetch_assoc(); echo($row['ID']);  ?>' >
                                </form>
                            </div>                                                
            <!-- Chỉnh sửa  -->
            
                   <!-- Footer Start -->
    <footer class="bg-lighskyblue text-center text-black" >
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