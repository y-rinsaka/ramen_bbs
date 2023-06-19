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
    <main>
        
    </main>
    <?php if (Session::get_flash('success')): ?>
        <div class="alert alert-success">
            <?php echo Session::get_flash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Session::get_flash('error')): ?>
        <div class="alert alert-warning">
            <?php echo Session::get_flash('error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($ramen_posts): ?>
        <?php foreach ($ramen_posts as $ramen_post): ?>
            <div class="card">
                <img src="<?php echo $ramen_post->image; ?>" class="card-img-top">
                
                <div class="card-body">
                    <h2 class="card-title"><?php echo $ramen_post->shop_name; ?></h5>
                    <h3>@<?php echo $users[$ramen_post->user_id]; ?></h3>
                    <p class="card-text"><?php echo $ramen_post->comment; ?></p>
                    <a href="#" class="btn btn-primary">詳細</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <p class="link-to-post">
        <a href="/post/create">
            <?php echo Asset::img('link-to-post.png'); ?>
        </a>
    </p>
</body>

</html>