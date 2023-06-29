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

            <?php if ($ramen_post->user_id == $current_user_id): ?>
                <form action="<?php echo Uri::create('post/edit/' . $ramen_post->id); ?>" method="post" >
                    <input type="submit" value="編集" class="btn btn-success">
                </form>
                <form action="<?php echo Uri::create('post/delete/' . $ramen_post->id); ?>" method="post" >
                    <input type="hidden" name="<?php echo Config::get('security.csrf_token_key'); ?>" value="<?php echo Security::fetch_token(); ?>">
                    <input type="submit" value="削除" class="btn btn-danger">
                </form>
            <?php endif; ?>

            </div>
        </div>

    </main>
</body>
</html>