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


<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="min-height: 120px;font-size: 74px;
    color: black;background-color: #55fd37;">
    <div class="container" style="text-align: center;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
                 $id = $this->requestAction(array('controller'=>'screens','action'=>'getIDekrandwa'));
                    if($id == null) {
                        $id = 0;
                    }else
                    {
                        if($id > 5 || $id <0)
                            $id = 0;
                    }
                ?>

              </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php $srednia = $this->requestAction(array('controller'=>'screens','action'=>'getsredniadwa')); ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <span style="text-align: center;size: 30px"><?php  echo ScreensController::$Trenerzy[$id].': '.$srednia;?></span>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>