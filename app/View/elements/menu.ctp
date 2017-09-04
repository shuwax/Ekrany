
<style>
    .dropdown-submenu {
        position: relative;
    }
    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
    }
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    .dropdown-submenu:hover > a:after {
        border-left-color: #fff;
    }
    .dropdown-submenu.pull-left {
        float: none;
    }
    .dropdown-submenu.pull-left > .dropdown-menu {
        left: -100%;
        margin-left: 10px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
   $ekrany = $this->requestAction(array('controller'=>'screens','action'=>'getEkrany'));
   $department = $this->requestAction(array('controller'=>'departments','action'=>'getDepName', AuthComponent::user('depid')));
   $departments = $this->requestAction(array('controller'=>'departments','action'=>'getDep'));

$i = 1;
?>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if(!AuthComponent::user()) : ?>
            <a class="navbar-brand" href="<?php  echo $this->Html->url(array('controller'=>'Pages','action'=>'display'), true);?>"> Home</a>
            <?php endif;?>
            <?php if(AuthComponent::user()) : ?>
            <a class="navbar-brand" href="<?php  echo $this->Html->url(array('controller'=>'Pages','action'=>'display'), true);?>"> <?php echo $department['Department']['name'] ?></a>
            <?php endif;?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ekrany <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <?php foreach ($departments as $item) :?>

                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#"><?php echo $item['Department']['name'] ?> <i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($ekrany as $ekran) :?>
                                    <?php if($ekran['Screen']['depid'] == $item['Department']['id']):?>
                                        <li><a tabindex="-1" href="<?php  echo $this->Html->url(array('controller'=>'Screens','action'=>'ekran',$ekran['Screen']['id']), true);?>">Ekran: # <?php echo $i;$i++; ?></a></li>
                                    <?php endif ?>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li> <!-- .dropdown -->
                <?php if(AuthComponent::user()) :?>
                    <li><a href="<?php  echo $this->Html->url(array('controller'=>'Events','action'=>'index'), true);?>">Konkursy <span class="sr-only">(current)</span></a></li>
<!--                    <li><a href="#">Ważne</a></li>-->
<!--                    <li><a href="--><?php // echo $this->Html->url(array('controller'=>'Employees','action'=>'index'), true);?><!--">Ustawienia trenera <span class="sr-only">(current)</span></a></li>-->
                    <li><a href="<?php  echo $this->Html->url(array('controller'=>'Screens','action'=>'index'), true);?>">Opcje Ekranów <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Zalogowany jako: <?php echo AuthComponent::user('first_name').' '.AuthComponent::user('last_name') ?></a></li>
                    <li><a href="<?php  echo $this->Html->url(array('controller'=>'Users','action'=>'logout'), true);?>">Wyloguj sie</a></li>
                <?php endif; ?>
                <?php if(!AuthComponent::user()) :?>
                <li><a href="<?php  echo $this->Html->url(array('controller'=>'Users','action'=>'login'), true);?>">Zaloguj sie</a></li>
                <?php endif; ?>
            </ul> <!-- .nav .navbar-nav -->
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>