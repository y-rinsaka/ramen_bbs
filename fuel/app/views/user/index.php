<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css(array('style.css', 'bootstrap.css')); ?>
	<title><?php echo $user['username']; ?></title>
</head>
<body>
	<div id="root"></div>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
	<main>
		<h2>投稿数：<?php echo $user['ramen_post_count']?></h2>
		<h2>アカウント作成日：<?php echo date('Y-m-d', $user['created_at']); ?></h2>
		
	</main>
</body>
</html>