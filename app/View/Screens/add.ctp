<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .submit > input
        {
            margin-right: 11px;
            color: #fff;
            background-color: #337ab7;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
            display:grid;
            width: 100%;
        }
        label
        {
            display: compact;
        }

    </style>
</head>

<body>

<div id="wrapper">
    <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?php  echo $this->Html->url(array('controller'=>'/Pages','action'=>'display'), true);?>">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Dodaj Ekran
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <?php echo $this->Form->create('Screen'); ?>
                        <fieldset>
                            <form>
                            <div class="form-group">
                            <?php
                            echo $this->Form->input('depid', array('class'=>'form-control','label'=> 'Wybierz miejsce ekranu','style'=>'display:','options' =>$states));
                            ?>
                            </div>
                        </fieldset>
                        <?php echo $this->Form->end(__('Dodaj ekran')); ?>
                        </form>
                    </div>

                    <div class="col-lg-2">
                    </div>
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

</body>

</html>





