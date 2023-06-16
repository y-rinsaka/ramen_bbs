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
        <h1>最新の投稿</h1>
        <a href="logout" class="logout-link">ログアウト</a>
    </header>
        <?php foreach($rows as $row)
        {
            echo $row['id'] .":". $row['shop_name'] .":". $row['image'];
            echo "<br/>";
        }
        ?>
    <?php if (Session::get_flash('success')): ?>
        <div class="success-message">
            <?php echo Session::get_flash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Session::get_flash('error')): ?>
        <div class="error-message">
            <?php echo Session::get_flash('error'); ?>
        </div>
    <?php endif; ?>
    <p class="link-to-post">
        <a href="/post/create">
            <?php echo Asset::img('link-to-post.png'); ?>
        </a>
    </p>
</body>

</html>