<?php require APPPATH . 'classes/prefectures.php'; ?>
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
        <form method="POST" action="<?php echo Uri::create('post/update/'.$ramen_post->id); ?>" enctype="multipart/form-data">
            <label for="shop_name">店名</label>
            <input type="text" name="shop_name" id="shop_name" value="<?php echo $ramen_post->shop_name;?>" required>
            <br/>
            <label for="shop_url">URL</label>
            <input type="url" name="shop_url" id="shop_url" value="<?php echo $ramen_post->shop_url;?>" required>
            <br>
            <label for="prefecuter_id">都道府県</label>
            <select name="prefecture_id" id="prefecture_id" required>
                <option value="">未選択</option>
                <?php foreach ($prefectures as $code => $prefecture): ?>
                    <option value="<?php echo $code; ?>" <?php if ($ramen_post->prefecture_id == $code) {echo "selected";} ?>><?php echo $prefecture; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="score">評価:</label>
            <br>
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <input type="radio" name="score" value="<?php echo $i; ?>" <?php if ($ramen_post->score == $i) {echo "checked";} ?>> <?php echo $i; ?>
            <?php endfor; ?>
            <br>
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" value="<?php echo $ramen_post->comment; ?>"></textarea>
            <br>
            <label for="image">画像</label>
            <input type="file" name="image" accept="image/*">
            <p>現在の画像</p>
            <img src="<?php echo $ramen_post->image?>" class="img-200-150">
            <br>
            <input type="submit" value="投稿する" />

        </form>
    </main>

</body>
</html>