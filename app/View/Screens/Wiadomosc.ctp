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

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Spis Ważnych informacji
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-table"></i> Wszystkie Informacje
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i>  <a href="<?php  echo $this->Html->url(array('controller'=>'exevents','action'=>'add'), true);?>">Dodaj Informacje</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Autor</th>
                            <th>Informacje</th>
                            <th>Status</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($exevents as $event): ?>
                                <?php foreach ($users as $user) {
                                if ($event['ExEvent']['author'] == $user['User']['id'])
                                    ?><td> <?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name'];?></td><?php
                            }?>
                            <td> <?php echo $event['ExEvent']['info'];?></td>
                            <td> <?php if($event['ExEvent']['status'] == 1)
                                            echo 'Aktywny';
                                        else echo 'Wygaszony'?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('Dodaj nową informacje'), array('controller'=>'ExEvents','action' => 'add'),array('class' => 'btn btn-success'));?>
                                <?php echo $this->Html->link(__('Wyświetl informacje'), array('controller'=>'ExEvents','action' => 'view', $event['ExEvent']['id']),array('class' => 'btn btn-info')); ?>
                                <?php echo $this->Html->link(__('Edytuj informacje'), array('controller'=>'ExEvents','action' => 'edit', $event['ExEvent']['id']),array('class' => 'btn btn-warning')); ?>
                                <?php echo $this->Form->postLink(__('Usuń informacje'), array('controller'=>'ExEvents','action' => 'delete', $event['ExEvent']['id']),array('class' => 'btn btn-danger'), array('confirm' => __('Chcesz usunać wiadomość?', $event['ExEvent']['id']))); ?>
                            </td>

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


</body>

</html>














