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
    <main>
        <div class="container">
            <div class="row">
                    <?php echo Form::open(['action' => 'register/index', 'method' => 'post', 'class' => 'form-horizontal']); ?>
                    <?php if (isset($error)): ?>
                    <p class="alert alert-warning">
                        <?php echo $error ?>
                    </p>
                    <?php endif ?>
                    <div class="text-center">
                        <div class="form-group">
                                <?php echo Form::input('username', null, ['id' => 'username', 'placeholder' => 'ユーザ名']); ?>
                            </div>

                        <div class="form-group">
                                <?php echo Form::input('email', null, ['id' => 'email', 'placeholder' => 'メールアドレス']); ?>
                            </div>
                        <div class="form-group">
                            <?php echo Form::password('password', null, ['id' => 'password', 'placeholder' => 'パスワード']); ?>
                        </div>
                        <div class="form-group">
                            <a href="/login" class="btn btn-default" role="button" data-bs-toggle="button">ログイン</a>
                                <?php echo Form::button('登録', null, ['class' => 'btn btn-primary']); ?>
                        </div>  
                    </div>
                    <?php echo Form::close(); ?>
                </div>
            </div>
        </div>
    </main>



</body>
</html>