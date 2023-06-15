<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css(array('style.css', 'bootstrap.css')); ?>
    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
        <h1><?php echo $title; ?></h1>
    </header>
    <div class="row alert alert-danger">
    <p><?php echo Session::get_flash('message') ?></p>
    </div>

    <div class="row" style="padding: 2rem;">
        <?php echo Form::open(['action' => 'register/index', 'method' => 'post']); ?>
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <?php echo Form::input('username', null, ['id' => 'username', 'class' => 'form-controll']); ?>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <?php echo Form::input('email', null, ['id' => 'email', 'class' => 'form-controll']); ?>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <?php echo Form::password('password', null, ['id' => 'password', 'class' => 'form-controll']); ?>
        </div>
        <?php echo Form::button('登録！', null, ['class' => 'btn btn-primary']); ?>
        <?php echo Form::close(); ?>
    </div>
</body>
</html>