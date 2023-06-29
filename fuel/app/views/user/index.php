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
		<div class="card" style="width: 72rem;">
			<div class="card-body">
				<h1 class="card-title">@<?php echo $user['username']; ?>さんのプロフィール</h1>
				<h2 class="card-subtitle mb-2 text-muted">投稿数（食べた杯数）：<?php echo $user['ramen_post_count']?></h2>
				<h2 class="card-subtitle mb-2 text-muted">アカウント作成日：<?php echo date('Y-m-d', $user['created_at']); ?></h2>
			</div>
		</div>
		<h3 class="text-muted text-center">直近1週間で食べた日</h3>
		<div class="container">
			<?php
			foreach ($records as $date => $count) {
				if ($count == 0) {
					echo '<div class="cell-gray">' . $date . '</div>';
				} else {
					echo '<div class="cell-green">' . $date . '</div>';
				}
			}
			?>
		</div>
	</main>
</body>
</html>