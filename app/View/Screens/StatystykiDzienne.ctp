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
        td{
            font-size: 42px;
            text-align: center;
            font-weight: bold;
        }
        th{
            text-align: center;
            font-size: 20px;
        }
        .table-bordered>thead>tr>td, .table-bordered>thead>tr>th,.table-bordered>tbody>tr>td {
            border-bottom-width: 10px;
        }
        .message success
        {
            background-color: rgba(106, 216, 84, 0.38);
            border-color: #000000;
            color: rgba(1, 4, 0, 0.52);
            text-align: center;
            font-size: 29px;
        }
        flashMessage
        {
            background-color: rgba(106, 216, 84, 0.38);
            border-color: #000000;
            color: rgba(1, 4, 0, 0.52);
            text-align: center;
            font-size: 29px;
        }
        .navbar
        {
            margin-bottom: 0px;
        }
        tr th
        {
            font-size: large;
            font-size: 50px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.30;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .table {
            width:inherit;
            max-width: 100%;
            margin-bottom: 20px;
            border: 16px solid #ddd;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 14px solid #ddd;
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

<body onload="pageScroll()">

<div id="wrapper" style="padding-top: 35px" onload="scrollWin()" >
    <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container" style="width: 1920px;padding-right: 0px;padding-left: 0px;margin-top: 40px;">

            <!-- Page Heading -->
            <br><br><br>
            <!-- /.row -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover header-fixed table-striped">
                        <thead>
                        <tr style=" color: yellow;
                            background: black;">
                            <th>L.P</th>
                            <th style="width: 42%;">Nazwisko Imie</th>
                            <th>Czas pracy</th>
                            <th>Zgody</th>
                            <th>Srednia</th>
                            <th>PLN/H</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;?>
                        <?php foreach ($systell as $item): ?>
                            <tr>
                                <td><?php echo $i;$i++; ?></td>
                                <td><?php echo $item['3'];?></td>
                                <?php
                                $srednia = $item['2'];
                                $czaspracy = $item['0'];
                                $czaspracy = round($czaspracy,2);
                                $srednia = round($srednia,2);
                                ?>
                                <td><?php echo $czaspracy;?></td>
                                <td><?php echo $item['1'];?></td>

                                <td><?php echo $srednia;?></td>
                                <?php
                                if($srednia <=2.5)
                                    echo '<td>'.'9.50'.'</td>';
                                else if($srednia>=2.5 and $srednia <=2.74)
                                    echo '<td>'.'10'.'</td>';
                                else  if($srednia>=2.75 and $srednia <=2.99)
                                    echo '<td>'.'10.50'.'</td>';
                                else  if($srednia>=3 and $srednia <=3.24)
                                    echo '<td>'.'11'.'</td>';
                                else  if($srednia>=3.25 and $srednia <=3.49)
                                    echo '<td>'.'11.50'.'</td>';
                                else  if($srednia>=3.50 and $srednia <=3.74)
                                    echo '<td>'.'12'.'</td>';
                                else  if($srednia>=3.75 and $srednia <=3.99)
                                    echo '<td>'.'12.50'.'</td>';
                                else  if($srednia>=4 and $srednia <=4.24)
                                    echo '<td>'.'13'.'</td>';
                                else  if($srednia>=4.25 and $srednia <=4.49)
                                    echo '<td>'.'13.50'.'</td>';
                                else  if($srednia>=4.5 and $srednia <=4.74)
                                    echo '<td>'.'14'.'</td>';
                                else  if($srednia>=4.75 and $srednia <=4.99)
                                    echo '<td>'.'14.50'.'</td>';
                                else  if($srednia>=5 and $srednia <=5.24)
                                    echo '<td>'.'15'.'</td>';
                                else  if($srednia>=5.25 and $srednia <=5.49)
                                    echo '<td>'.'15.50'.'</td>';
                                else  if($srednia>=5.5 and $srednia <=5.74)
                                    echo '<td>'.'16'.'</td>';
                                else  if($srednia>=5.75 and $srednia <=5.99)
                                    echo '<td>'.'16.50'.'</td>';
                                else  if($srednia>=6 and $srednia <=6.24)
                                    echo '<td>'.'17'.'</td>';
                                else  if($srednia>=6.25 and $srednia <=6.49)
                                    echo '<td>'.'17.50'.'</td>';
                                else
                                {
                                    echo '<td>'.'18*'.'</td>';
                                }
                                ?>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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

    function pageScroll() {
        window.scrollBy(0,-1);
        scrolldelay = setTimeout(pageScroll,25);
    }
    $(document).ready(function(){
        setInterval(function(){cache_clear()},31000);
    });


    function cache_clear()
    {
        window.scrollTo(0,100000);
        location.reload(true);
    }


</script>

</body>

</html>


































