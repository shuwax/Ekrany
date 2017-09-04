<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>


    <!-- Custom CSS -->
    <style>
        .col-lg-12 {
            padding-right: 0px;
            padding-left: 0px;
        }
    </style>
    <!-- Custom Fonts -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="wrapper">
    <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container" style="width: 1280px;padding-right: 0px;padding-left: 0px;margin-top: 40px;">

            <!-- Page Heading -->
            <br><br><br>
            <!-- /.row -->
            <div class="col-lg-12">
                <h3><?php echo $event['Event']['content']?></h3>
                <h3><?php echo $event['Event']['stuff']?></h3>
                <?php echo $this->Html->image('../files/event/filename/'.$event['Event']['dir'].'/'.$event['Event']['filename']);?>
            </div>
        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!--przekierowywanie na strony statystyk 30 sek-->
<script>
    $(document).ready(function(){
        setInterval(function(){cache_clear()},10000);
    });
    function cache_clear()
    {
        location.reload();
    }
</script>

</body>

</html>














