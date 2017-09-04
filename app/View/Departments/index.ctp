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
                        Wszystkie oddziały z ekranami
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-table"></i> Wszystkie oddziały z ekranami
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i>  <a href="<?php  echo $this->Html->url(array('controller'=>'departments','action'=>'add'), true);?>">Dodaj Oddział</a>
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
                            <th>Nazwa Oddziału</th>
                            <th>Ilosc Ekranów</th>
                            <th>Link Google</th>
                            <th>Działanie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($departments as $item): ?>
                            <tr>

                                <td> <?php echo $item['Department']['name'];?></td>
                                <td> <?php echo '0';?></td>
                                <td> <?php if($item['Department']['link']==1)echo 'Tak'; else echo 'Nie';?></td>
                                <td class="actions">
                                    <?php echo $this->Form->postLink(__('Usuń Oddział'), array('controller'=>'Departments','action' => 'delete', $item['Department']['id']), array('confirm' => 'Czy na pewno chcesz usunąć oddział?','class' => 'btn btn-danger')); ?>
                                    <?php echo $this->Html->link(__('Edytuj Oddział'), array('controller'=>'Departments','action' => 'edit', $item['Department']['id']),array('class' => 'btn btn-warning')); ?>

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














