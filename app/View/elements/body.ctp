
<!DOCTYPE html>
<html lang="en">

<style>
    #myCarousel
    {
        top: -19px;
    }
    .thumbnail a>img, .thumbnail>img {
        width: 340px !important;
        height: 138px !important;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Heroic Features - Start Bootstrap Template</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>







<!-- Header Carousel -->
<header>

</header>

<!-- Page Content -->
<div class="container">

    <hr>
    <?php
    $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " +0 days"));
    $day_number = date('N', strtotime($newTime));
    $start = date("Y-m-d",strtotime(date("Y-m-d")."-".($day_number-1)." days"));
    $stop = date("Y-m-d",strtotime(date("Y-m-d")." -1 days"));
    echo $start;?>
    <!-- Title -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Witaj w systemie zarządzania ekranami informacyjnymi.</h3>
        </div>
    </div>
    <!-- /.row -->

    <!-- Page Features -->

    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Verona Consulting Website 2017</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->
</body>

</html>