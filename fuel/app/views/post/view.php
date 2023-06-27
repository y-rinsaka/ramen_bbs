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
        <div class="card">
            <img src="<?php echo $ramen_post->image; ?>" class="card-img-top">
            
            <div class="card-body">
                <h2 class="card-title"><?php echo $ramen_post->shop_name; ?><a href=<?php echo $ramen_post->shop_url; ?>><?php echo Asset::img('external-link.png', array('class' => 'card-img-external-link')); ?></a></h5>
                <h3><a href="<?php echo Uri::create('user/index/' . $ramen_post->user_id); ?>">@<?php echo $ramen_post->username; ?></a></h3>
                <p class="card-text"><?php echo $ramen_post->comment ?></p>
                <p class="card-text">投稿日：<?php echo $ramen_post->created_at ?></p>
            </div>
        </div>
    </main>
</body>
</html>