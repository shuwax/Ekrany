
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootstrap Login Form</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
            display: block;
            width: 100%;
        }
        #btn-cancel
        {
            background: gainsboro;
        }
    </style>
</head>
<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="position: initial">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Logowanie</h1>
            </div>
            <div class="modal-body">
                <div class="form col-md-12 center-block">
                    <div class="form-group">
                        <?php echo $this->Form->create('User'); ?>
                           <?php echo $this->Form->input('',array('name'=> 'data[User][username]' ,'class' => 'form-control input-lg','type'=>'text','placeholder' => 'Nazwa Użytkownika','id' => 'username'));?>
                    </div>               
                    <div class="form-group">
                        <?php echo $this->Form->input('',array('name'=>'data[User][password]','type'=>'password','class' => 'form-control input-lg','placeholder' => 'Haslo','id'=>'password'));?>

                        </div>
                    <div class="form-group">
                        <?php echo $this->Form->end(__('Zaloguj sie',array('id' => 'btn-login'))); ?>

                        <span class="pull-right"> <?php echo $this->HTML->link('Brak konta? Zarejestruje sie',array('controller'=>'Users','action'=>'add'))?></span>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <?php echo $this->HTML->link('Anuluj',array('controller'=>'Pages','action'=>'display'),array('class'=>'btn',
                        'data-dismiss'=>'modal','aria-hidden'=>'true','id'=>'btn-cancel'));?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- script references -->

</body>
</html>
 

<?php /*
<div class="login">
    <?php echo $this->Form->create('User'); ?>
    <span><strong>Logowanie</strong></span>
    <fieldset>
        <?php echo $this->Form->input('username',array('label' => 'Nazwa uzytkownika'));
        echo $this->Form->input('password',array('label' => 'Hasło'));?>
    </fieldset>
    <div class="btnlog">
        <?php echo $this->Form->end(__('Zaloguj sie')); ?>
    </div>
</div>

*/ ?>