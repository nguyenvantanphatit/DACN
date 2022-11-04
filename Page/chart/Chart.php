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
    <link href="/DACN/css/chart.css" rel="stylesheet">

    <link href="../../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
    require "../../ConnectDB.php";
    $id=$_COOKIE['checkLogin'];
    $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND b.`idUser`='$id'";
    if($_COOKIE['checkGV']==2)
    {
        $getId= $_GET['idTeacher'];
        $sql="SELECT a.`IdUser`,`IdUserTeacher`,`Tprepare`,`TContent`,`TMethod`,`testingMethod`,`TRules`,`professionalManner` FROM `surveyresults` a,`userInformation` b WHERE `IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`='$getId'";
    }
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
                        if($list[$i][$j]>50 && $list[$i][$j]>80)
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
    echo("<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Trên 80%', ".$arraygiatri[0][4]."],
        ['Trên 50%', ".$arraygiatri[0][3]."],
        ['Trên 25%', ".$arraygiatri[0][2]."],
        ['Trên 10%', ".$arraygiatri[0][1]."],
        ['Trên 0%',  ".$arraygiatri[0][0]."]
      ]);

      // Set chart options
      var options = {'title':'TEACHING TPREPARE ',
                     'width':500,
                     'height':400};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    // bảng 2
    google.charts.setOnLoadCallback(drawMultSeries);

    function drawMultSeries() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density', { role: 'style' } ],
            ['Trên 80%', ".$arraygiatri[1][4].", 'skyblue'],
            ['Trên 50%', ".$arraygiatri[1][3].", 'lightpink'],
            ['Trên 25%', ".$arraygiatri[1][2].", 'skyblue'],
            ['Trên 10%', ".$arraygiatri[1][1].", 'lightpink'],
            ['Trên 0%', ".$arraygiatri[1][0].", 'skyblue']
        
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: 'stringify',
                             sourceColumn: 1,
                             type: 'string',
                             role: 'annotation' },
                           2]);
    
          var options = {
            title: 'TEACHING CONTENT',
            width: 500,
            height: 400,
            bar: {groupWidth: '95%'},
            legend: { position: 'none' },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById('chart1'));
          chart.draw(view, options);
    }
    //bảng 3
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['', '%',],
        ['Trên 80%',".$arraygiatri[2][4]."],
        ['Trên 50%',".$arraygiatri[2][3]."],
        ['Trên 25%',".$arraygiatri[2][2]."],
        ['Trên 10%',".$arraygiatri[2][2]."],
        ['Trên 0%',".$arraygiatri[2][1]."]
      ]);

      var options = {
        title: 'TEACHING METHOD',
        chartArea: {width: '70%',height:'80%'},
        hAxis: {
          title: 'Tỉ lệ phần trăm',
          minValue: 0
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart2'));

      chart.draw(data, options);
    }
    //Bảng 4
    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            ['Phần trăm','tam', 'TESTING METHOD'],
            ['Trên 0%',0,".$arraygiatri[3][0]."],
            ['Trên 10%',0,".$arraygiatri[3][1]."],
            ['Trên 25%',0,".$arraygiatri[3][2]."],
            ['Trên 50%',0,".$arraygiatri[3][3]."],
            ['Trên 80%',0,".$arraygiatri[3][4]."]
          
        ]);

        var options = {
          title: 'TESTING METHOD',
          chartArea: {width: '70%',height:'80%'},
          hAxis: {title: 'Tỉ lệ phần trăm',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart4'));
        chart.draw(data, options);
      }
      //Bảng 5
      google.charts.setOnLoadCallback(drawChart5);

      function drawChart5() {
        var data = google.visualization.arrayToDataTable([
          ['Phần Trăm',  'Giá trị'],
          ['Trên 0%',    ".$arraygiatri[4][0]."],
          ['Trên 10%',   ".$arraygiatri[4][1]."],
          ['Trên 25%',     ".$arraygiatri[4][2]."],
          ['Trên 50%',     ".$arraygiatri[4][3]."],
          ['Trên 80%',     ".$arraygiatri[4][4]."]
        ]);

        var options = {
          title: 'TEACHING RULES',
          vAxis: {title: 'TEACHING RULES'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart5'));

        chart.draw(data, options);
      }
      //bảng 6
      google.charts.setOnLoadCallback(drawChart6);

    function drawChart6() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density', { role: 'style' } ],
            ['Trên 80%', ".$arraygiatri[5][4].", 'lightred'],
            ['Trên 50%', ".$arraygiatri[5][3].", 'lightblack'],
            ['Trên 25%', ".$arraygiatri[5][2].", 'lightred'],
            ['Trên 10%', ".$arraygiatri[5][1].", 'lightblack'],
            ['Trên 0%', ".$arraygiatri[5][0].", 'lightred']
        
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: 'stringify',
                             sourceColumn: 1,
                             type: 'string',
                             role: 'annotation' },
                           2]);
    
          var options = {
            title: 'TEACHING CONTENT',
            width: 500,
            height: 400,
            bar: {groupWidth: '95%'},
            legend: { position: 'none' },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById('chart6'));
          chart.draw(view, options);
    }
  </script>")
    
    ?>
</head>

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
                    <a href="" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Biểu đồ</a>
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
                 $sql="SELECT * FROM `surveyresults`a,`userInformation` b WHERE a.`IdUserTeacher`=b.`ID` AND b.`idUser`= '$id'";
                $result=$conn->query($sql);
                $count=0;
                while($row=$result->fetch_assoc()){
                    $count++;
                }
                if($count>10){
                    echo('<div class="row">
                    <div class="col-6">
                        <div class="card" style="margin-top:20%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Chuẩn Bị Đầu Môn</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá dựa trên mức độ phổ cập cho sinh viên về mục tiêu môn học, cách thức kiểm tra, tài liệu giảng dạy, thời gian có mặt trên lớp và cách tức tìm liệu để sinh viên có thể nắm bắt. 
                                </p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row" align="right">
                            <div id="chart_div" class="col-12"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" style="height:400px">
                    <div class="col-6">
                        <div class="row" align="right">                          
                            <div class="col-12" id="chart1"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="margin-top:20%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Nội dung giảng dạy của giảng viên</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá dựa trên đánh giá của sinh viên về trong quá trình giảng dạy của giảng viên có được bám sát vào trong mục tiêu môn học, có được rõ ràng chính xác và giúp sinh viên hiểu được các kiến thức mới hay không.</p>
                               
                            </div>
                        </div>
                    </div>
                  
                </div>
                <hr>
                <div class="row" style="height:400px">
                    <div class="col-6">
                        <div class="card" style="margin-top:10%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Phương pháp giảng dạy</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá dựa trên mức độ hiệu quả của phương pháp giảng viên đã dùng trong quá trình dạy học, mức độ hiểu bài của sinh viên và thái độ tích cực hay tiêu cực của sinh viên</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row" align="right" style="margin-top:10%">                          
                            <div class="col-12" id="chart2"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" style="height:400px">
                    <div class="col-6">
                        <div class="row" align="right" style="margin-top:10%">                          
                            <div class="col-12" style="height:300px" id="chart4"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="margin-top:10%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Kiểm tra đánh giá</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá dựa trên tính công bằng, khách quan của giảng viên trong hoạt động kiểm tra kiến thức và nắm được mức độ hiểu bài của sinh viên đưa điều chỉnh phù hợp.</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" style="height:400px">
                    <div class="col-6">
                        <div class="card" style="margin-top:10%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Thực hiện quy chế giảng dạy của giảng viên</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá dựa trên sự nghiêm túc, có trách nhiệm trong công việc của giảng viên trong quá trình thực hiện khóa học.</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row" align="right" style="margin-top:10%">                          
                            <div class="col-12" id="chart5"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" style="height:400px">
                    <div class="col-6">
                        <div class="row" align="right" style="margin-top:10%">                          
                            <div class="col-12" style="height:300px" id="chart6"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="margin-top:10%;width:100%">
                            <div class="card-body" style="width:100%;height:100%">
                                <h5 class="card-title">Tác phong sư phạm</h5>
                                <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                <p class="card-text">Được đánh giá bằng thái độ, tác phong và hành vi ứng xử có chuyên nghiệp và phù hợp với vai vế của giảng viên hay không
</p>
                               
                            </div>
                        </div>
                    </div>
                </div>');
                }
                else{
                    echo("<h1  style='text-align:center; color:Red;'> CHÚNG TÔI KHÔNG ĐỦ THÔNG TIN ĐÁNH GIÁ GIẢNG VIÊN NÀY!!!</h1>
                    <h3  style='text-align:center'>Xin Vui Lòng Quay Lại Khi Đã Đủ Thông Tin Đánh Giá</h3>");
                }
            }
            else{
                if($_COOKIE['checkGV']==2)
                {
                    $sql="SELECT b.`ID`,`nameUser` FROM `userInformation`b,`taikhoan` a WHERE a.`id`= b.`idUser` AND a.`authority`=1";
                    $result=$conn->query($sql);
                    $count=0;
                    echo('<div class="btn-group dropend">
                    <button type="button" class="btn btn-secondary">
                      Chọn Giảng Viên
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropright</span>
                    </button>
                    <ul class="dropdown-menu">');
                    while($row=$result->fetch_assoc()){
                        echo('<li><a class="dropdown-item" href="?idTeacher='.$row['ID'].'&name='.$row['nameUser'].'" type="button">'.$row['nameUser'].'</a></li>');
                    }
                     echo('
                    </ul>
                  </div><hr>
                  ');
                  $idTeacher=$_GET['idTeacher'];
                  $sql="SELECT * FROM `surveyresults`a,`userInformation` b WHERE a.`IdUserTeacher`=b.`ID` AND a.`IdUserTeacher`= '$idTeacher'";
                  $result=$conn->query($sql);
                  $count=0;
                  while($row=$result->fetch_assoc()){
                      $count++;
                  }
                  if($count>=10){
                      echo('
                      <div algin="center"><h3>Giảng Viên:'.$_GET['name'].'</h3></div>
                      <div class="row">
                      <div class="col-6">
                          <div class="card" style="margin-top:20%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Chuẩn Bị Đầu Môn</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá dựa trên mức độ phổ cập cho sinh viên về mục tiêu môn học, cách thức kiểm tra, tài liệu giảng dạy, thời gian có mặt trên lớp và cách tức tìm liệu để sinh viên có thể nắm bắt. 
                                  </p>
                                 
                              </div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="row" align="right">
                              <div id="chart_div" class="col-12"></div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row" style="height:400px">
                      <div class="col-6">
                          <div class="row" align="right">                          
                              <div class="col-12" id="chart1"></div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card" style="margin-top:20%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Nội dung giảng dạy của giảng viên</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá dựa trên đánh giá của sinh viên về trong quá trình giảng dạy của giảng viên có được bám sát vào trong mục tiêu môn học, có được rõ ràng chính xác và giúp sinh viên hiểu được các kiến thức mới hay không.</p>
                                 
                              </div>
                          </div>
                      </div>
                    
                  </div>
                  <hr>
                  <div class="row" style="height:400px">
                      <div class="col-6">
                          <div class="card" style="margin-top:10%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Phương pháp giảng dạy</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá dựa trên mức độ hiệu quả của phương pháp giảng viên đã dùng trong quá trình dạy học, mức độ hiểu bài của sinh viên và thái độ tích cực hay tiêu cực của sinh viên</p>
                                 
                              </div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="row" align="right" style="margin-top:10%">                          
                              <div class="col-12" id="chart2"></div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row" style="height:400px">
                      <div class="col-6">
                          <div class="row" align="right" style="margin-top:10%">                          
                              <div class="col-12" style="height:300px" id="chart4"></div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card" style="margin-top:10%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Kiểm tra đánh giá</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá dựa trên tính công bằng, khách quan của giảng viên trong hoạt động kiểm tra kiến thức và nắm được mức độ hiểu bài của sinh viên đưa điều chỉnh phù hợp.</p>
                                 
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row" style="height:400px">
                      <div class="col-6">
                          <div class="card" style="margin-top:10%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Thực hiện quy chế giảng dạy của giảng viên</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá dựa trên sự nghiêm túc, có trách nhiệm trong công việc của giảng viên trong quá trình thực hiện khóa học.</p>
                                 
                              </div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="row" align="right" style="margin-top:10%">                          
                              <div class="col-12" id="chart5"></div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row" style="height:400px">
                      <div class="col-6">
                          <div class="row" align="right" style="margin-top:10%">                          
                              <div class="col-12" style="height:300px" id="chart6"></div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card" style="margin-top:10%;width:100%">
                              <div class="card-body" style="width:100%;height:100%">
                                  <h5 class="card-title">Tác phong sư phạm</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">...</h6>
                                  <p class="card-text">Được đánh giá bằng thái độ, tác phong và hành vi ứng xử có chuyên nghiệp và phù hợp với vai vế của giảng viên hay không
  </p>
                                 
                              </div>
                          </div>
                      </div>
                  </div>');
                  }
                  else{
                      echo("<h1  style='text-align:center; color:Red;'> CHÚNG TÔI KHÔNG ĐỦ THÔNG TIN ĐÁNH GIÁ GIẢNG VIÊN NÀY!!!</h1>
                      <h3  style='text-align:center'>Xin Vui Lòng Quay Lại Khi Đã Đủ Thông Tin Đánh Giá</h3>");
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