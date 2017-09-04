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
            font-size: 24px;
            font-family: fantasy;
            text-align: center;
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

        <div class="container" style="width: 1920px;padding-right: 0px;padding-left: 0px;margin-top: 40px;">

            <!-- Page Heading -->
            <br><br><br>
            <!-- /.row -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <?php
                        $srednia = floatval(str_replace(",",".",$pierwszalinia[4]));
                        $przerwypauza = str_replace("%","",$pierwszalinia[12]);
                        $przerwypauza = floatval(str_replace(",",".",$pierwszalinia[12]));
                        $rozmowy = str_replace("%","",$pierwszalinia[17]);
                        $rozmowy = floatval(str_replace(",",".",$pierwszalinia[17]));
                        ?>
                        <tr bgcolor="yellow">

                            <th>Imie i Nazwisko</th>
                            <th>Średnia</th>
                            <th>(Przerwy + Pauza)/Praca</th>
                            <th>Rozmowy/Czas Pracy</th>
                            <th>Telefon Systell</th>
                            <!--                            <th>Trener </th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<count($dane);$i++): ?>
                                <td> <?php echo $dane[$i][0];?></td>

                                        <?php
                                        $wartosc = floatval(str_replace(",",".",$dane[$i][4]));
                                        if($wartosc >= $srednia*2)
                                        { // tragicznie
                                            ?><td bgcolor="aqua"><?php
                                        }
                                        else if($wartosc < $srednia*2 && $wartosc>=$srednia*1.5)
                                        {// bardzo slabo
                                            ?><td bgcolor="#adff2f"><?php
                                        }
                                        else if($wartosc < $srednia*1.5 && $wartosc>=$srednia)
                                        {//slabo
                                            ?><td bgcolor=yellow><?php
                                        }
                                        else if($wartosc < $srednia && $wartosc>=$srednia * 0.75)
                                        {//slabo
                                            ?><td bgcolor=orange><?php
                                        }
                                        else
                                        {//bardzo dobrze
                                            ?><td bgcolor=red style="color: white"><?php
                                        }
                                        echo $dane[$i][4];?> </td>
                                                                <?php ?>



                                    <?php
                                    $wartosc = str_replace("%","",$dane[$i][12]);
                                    $wartosc = floatval(str_replace(",",".",$dane[$i][12]));

                                    if($wartosc >= $przerwypauza*2.5)
                                    { // tragicznie
                                        ?><td bgcolor="red" style="color: white"><?php
                                    }
                                    else if($wartosc < $przerwypauza*2.5 && $wartosc >= $przerwypauza*2.3 )
                                    {// bardzo slabo
                                        ?><td bgcolor="orange"><?php
                                    }
                                    else  if($wartosc < $przerwypauza*2.3 && $wartosc >= $przerwypauza*2 )
                                    {//slabo
                                        ?><td bgcolor=yellow><?php
                                    }
                                    else
                                    {//bardzo dobrze
                                        ?><td bgcolor=#adff2f><?php
                                    }
                                    echo $dane[$i][12];?> </td>
                                                                <?php ?>

                                <?php
                                $wartosc = str_replace("%","",$dane[$i][17]);
                                $wartosc = floatval(str_replace(",",".",$dane[$i][17]));

                                if($wartosc >= $rozmowy)
                                { // tragicznie
                                    ?><td bgcolor="#adff2f"><?php
                                }
                                else if($wartosc < $rozmowy && $wartosc >= $rozmowy*0.95 )
                                {// bardzo slabo
                                    ?><td bgcolor="yellow"><?php
                                }
                                else  if($wartosc < $rozmowy*0.95 && $wartosc >= $rozmowy*0.8 )
                                {//slabo
                                    ?><td bgcolor=orange><?php
                                }
                                else
                                {//bardzo dobrze
                                    ?><td bgcolor=red style="color: white"><?php
                                }
                                echo $dane[$i][17];?> </td>
                                <?php ?>
                                <td> <?php echo $dane[$i][18];?></td>
                            <tr></tr>
                        <?php endfor;?>
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














