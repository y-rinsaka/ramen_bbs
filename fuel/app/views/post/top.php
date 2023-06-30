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
    <div id="root"></div>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
    <main>
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
                    <img src="<?php echo $ramen_post->image; ?>" class="img-200-150">
                    
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $ramen_post->shop_name; ?></h5>
                        <h3>@<?php echo $users[$ramen_post->user_id]; ?></h3>
                        <p class="card-text"></p><?php echo $ramen_post->comment ?></p>
                        <a href="<?php echo Uri::create('post/view/' . $ramen_post->id); ?>" class="btn btn-primary">詳細</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <p class="link-to-post">
            <a href="<?php echo Uri::create('post/create'); ?>">
                <?php echo Asset::img('link-to-post.png'); ?>
            </a>
        </p>
    </main>

</body>

</html>