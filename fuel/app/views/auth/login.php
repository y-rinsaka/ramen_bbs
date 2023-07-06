<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css(array('style.css', 'bootstrap.css')); ?>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.1/knockout-min.js'></script>
  
  <title><?php echo $title; ?></title>
</head>
<body>
  <header>
        <h1><?php echo $title; ?></h1>
    </header>
  <main>
		<h1 class="text-center">Ramen BBS</h1>
    <div class="container">
      <div class="row text-center">
        <?php echo Form::open(array('class' => 'form-horizontal'));?>
        <?php if (isset($error)): ?>
          <p class="alert alert-warning">
          <?php echo $error ?>
          </p>
        <?php endif ?>
        <div class="form-group">
          <?php echo Form::input('username', null, ['placeholder' => 'ユーザー名', 'data-bind' => "value: inputUsername, valueUpdate: 'afterkeydown'"]);?>
        </div>
        <div class="form-group">
          <?php echo Form::password('password', null, ['placeholder' => 'パスワード', 'data-bind' => "value: inputPassword, valueUpdate: 'afterkeydown'"]);?>
        </div>
        <div class="form-group">
          <a href="/register" class="btn btn-default" role="button" data-bs-toggle="button">新規登録</a>
          <?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-primary', 'data-bind' => 'enable: canSubmitLogin'));?>
        </div>
        <?php echo Form::close();?>
      </div>
    </div>
  </main>
  <?php echo Asset::js('knockout-isinput.js'); ?>
</body>
</html>
