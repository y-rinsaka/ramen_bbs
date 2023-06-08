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
    </header>
    <p class="link-to-post">
        <a href="create">
            <?php echo Asset::img('link-to-post.png'); ?>
        </a>
    </p>
</body>

</html>