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
        .page-header
        {
            margin: 70px 0 20px
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

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Spis Konkursów
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-table"></i> Wszystkie konkursy
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i>  <a href="<?php  echo $this->Html->url(array('controller'=>'events','action'=>'add'), true);?>">Dodaj Konkurs</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php
            // aktualne dane z serwera
            $aktualnaData = date("Y-m-d"); // konkurs na dwie minuty
            $aktualnyCzas = date("H:i");
            $indeks = 0;
            ?>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Autor</th>
                            <th>Konkurs</th>
                            <th>Wygrana</th>
                            <th>Status</th>
                            <th>Miejsce wyświetlania</th>
                            <th>Działanie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                            <?php  if(AuthComponent::user('depid') == $event['Event']['depid']) :?>
                                <?php
                                    //Podział terminu eventu na dzni oraz godziny
                                    $daneEventu = $event['Event']['czas'];
                                    $zmieniarka = strtotime($daneEventu);
                                    $czasEventu = date("H:i", strtotime('+0 minutes', $zmieniarka));
                                    $dataEventu = date("Y-m-d",$zmieniarka);
                                ?>
                                    <?php foreach ($users as $user): ?>
                                    <?php if ($event['Event']['author'] == $user['User']['id']):?>
                                     <td> <?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?></td>
                                      <?php endif; ?>
                                    <?php endforeach;?>
                                <td> <?php echo $event['Event']['content'];?></td>
                                <td> <?php echo $event['Event']['stuff'];?></td>

                                <td>
                                    <?php if ($aktualnyCzas<$czasEventu && $dataEventu==$aktualnaData)
                                                echo 'Aktywny';
                                            else echo 'Wygaszony';?>
                                </td>
                                <td>
                                    <?php
                                        echo 'Ekran: #'.$states2[$event['Event']['ekran']];
                                    ?>
                                </td>

                                <td class="actions">
                                    <?php echo $this->Html->link(__('Dodaj nowy konkurs'), array('controller'=>'Events','action' => 'add'),array('class' => 'btn btn-success'));?>
                                    <?php echo $this->Html->link(__('Podgląd Konkuru'), array('controller'=>'Events','action' => 'view', $event['Event']['id']),array('class' => 'btn btn-info')); ?>
                                    <?php echo $this->Html->link(__('Edytuj Konkurs'), array('controller'=>'Events','action' => 'edit', $event['Event']['id']),array('class' => 'btn btn-warning')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń Konkurs'), array('controller'=>'Events','action' => 'delete', $event['Event']['id']), array('confirm' => 'Czy na pewno chcesz usunąć konkurs?','class' => 'btn btn-danger')); ?>
                                    <?php echo $this->Form->postLink(__('Uruchom ponownie'), array('controller'=>'Events','action' => 'reboot', $event['Event']['id']), array('confirm' => 'Czy na pewno chcesz włączyć konkurs ponownie?','class' => 'btn btn-danger')); ?>
                                </td>
                                <?php endif;?>
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


<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        setInterval(function(){cache_clear()},10000);-->
<!--    });-->
<!--    function cache_clear()-->
<!--    {-->
<!--        location.reload();-->
<!--    }-->
<!--</script>-->
</body>

</html>














