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
        <a href="logout" class="logout-link">ログアウト</a>
    </header>
	<div class="container">
		<div class="row">
			<?php echo Form::open(array('class' => 'form-horizontal'));?>
			<?php if (isset($error)): ?>
			<p class="alert alert-warning">
				<?php echo $error ?>
			</p>
			<?php endif ?>
			<div class="form-group">
				<label for="form_name" class="col-sm-4 control-label">ユーザ名</label>
				<div class="col-sm-8">
					<?php echo Form::input('username');?>
				</div>
			</div>
			<div class="form-group">
				<label for="form_name" class="col-sm-4 control-label">パスワード</label>
				<div class="col-sm-8">
					<?php echo Form::password('password');?>
				</div>
			</div>
			<div class="form-group">
				<div class="d-grid gap-2 d-md-block col-sm-offset-4 col-sm-8">
					<a href="/register" class="btn btn-primary" role="button" data-bs-toggle="button">新規登録</a>
					<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-success'));?>
				</div>
			</div>
			<?php echo Form::close();?>
		</div>
	</div>

	
</body>
</html>