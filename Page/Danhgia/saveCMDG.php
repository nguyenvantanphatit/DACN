
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
        <?php
       $idU=$_GET['idU'];
       $idT=$_GET['idT'];
       print_r($_GET['idU']);
        echo('
       
        <script>
        $(document).ready(function(){     
            $.ajax({
                url:"http://127.0.0.1:5000/prediction/'.$_GET['comment'].'",
                type: "get",
                dataType: "json",
                success: function(data){
                    console.log(data)
                    document.cookie = "ketqua="+data+"; expires=Thu, 5 Dec  2022 12:00:00 UTC";
                }
                });
            });
            var delayInMilliseconds =3000 ; //1 second
            setTimeout(function() {
                window.location="./tam.php?comment='.$_GET['comment'].'&idU='.$idU.'&idT='.$idT.'";
            }, delayInMilliseconds);

            
        </script>
        ');
        ?>
</body>
</html>