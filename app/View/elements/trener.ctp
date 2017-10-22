<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="min-height: 120px;font-size: 74px;
    color: #f1e000;
    background-color: #080808;">
    <div class="container" style="text-align: center;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

              </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 34px">
            <?php
            $id = $this->params['pass'][0];
            $aktualny = $this->requestAction(array('controller'=>'screens','action'=>'getEkranID',$id));
            $typ = $aktualny['Screen']['conntentnumber'];
            $pracownik = $aktualny['Screen']['weekemployee'];

            if($typ == 3) {
                $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " -1 days"));
                $day_number = date('N', strtotime($newTime));
                if ($day_number == 7) {
                    $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " -2 days"));
                }
                $day_number2 = date('N', strtotime($newTime));
                $tydzien = '';
                switch ($day_number2) {
                    case 1:
                        $tydzien = 'Poniedziałek';
                        break;
                    case 2:
                        $tydzien = 'Wtorek';
                        break;
                    case 3:
                        $tydzien = 'Środa';
                        break;
                    case 4:
                        $tydzien = 'Czwartek';
                        break;
                    case 5:
                        $tydzien = 'Piątek';
                        break;
                    case 6:
                        $tydzien = 'Sobota';
                        break;
                    case 7:
                        $tydzien = 'Niedziela';
                        break;
                }
            }else if($typ == 2 )
            {
                $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " -0 days"));
                $day_number = date('N', strtotime($newTime));
                if($day_number==1)
                {
                    $day_number=0;
                }
                $start = date("Y-m-d",strtotime(date("Y-m-d")."-".($day_number-1)." days"));
                $stop = date("Y-m-d",strtotime(date("Y-m-d")." -1 days"));
            }
            ?>
         <?php if($typ == 3) : ?>
        <span style="text-align: center;font-size: 45px;font-weight: 600;"><?php  echo 'Wyniki za dzień: '.$newTime.' ('.$tydzien.')' ?></span>
        <?php endif;?>
            <?php if($typ == 2) : ?>
                <span style="text-align: center;font-size: 35px;font-weight: 600;"><?php  echo 'Wyniki Tygodniowy: '.$start.' --- '.$stop ?></span>
            <?php endif;?>
            <?php if($typ == 0) : ?>
                <?php
                $godzina = $this->requestAction(array('controller'=>'screens','action'=>'getGodzina'));
                $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " -0 days"));
                $day_number = date('N', strtotime($newTime));
                $day_number2 = date('N', strtotime($newTime));
                $tydzien = '';
                switch ($day_number2) {
                case 1:
                $tydzien = 'Poniedziałek';
                break;
                case 2:
                $tydzien = 'Wtorek';
                break;
                case 3:
                $tydzien = 'Środa';
                break;
                case 4:
                $tydzien = 'Czwartek';
                break;
                case 5:
                $tydzien = 'Piątek';
                break;
                case 6:
                $tydzien = 'Sobota';
                break;
                case 7:
                $tydzien = 'Niedziela';
                break;
                }
                ?>
                <span style="text-align: center;font-size: 50px;font-weight: 600;"><?php  echo 'Wyniki Bieżące: '.$godzina.' '.$tydzien?></span>
            <?php endif;?>

            <div id="tt" style="background: white;
    width: 1920px;
    height: 0pc;
    margin-left: -380px;
    margin-top: 57px;>
                <div class="table-responsive">
            <table class="table table-bordered table-hover header-fixed table-striped">
                <thead>
                <tr style=" color: yellow;
                            background: black;">
                    <th style="width: 7%;">L.P</th>
                    <th style="width: 45%;">Nazwisko Imie</th>
                    <th >     Czas</th>
                    <th>Zgody</th>
                    <th>Srednia</th>
                    <th>PLN/H</th>
                </tr>
                </thead>
            </table>
                </div>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>