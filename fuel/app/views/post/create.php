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
        <form method="POST" action="/post/save" enctype="multipart/form-data">
            <label for="shop_name">店名</label>
            <input type="text" name="shop_name" id="shop_name" required>
            <br/>
            <label for="shop_url">URL</label>
            <input type="url" name="shop_url" id="shop_url" required>
            <br>
            <label for="prefecuter_id">都道府県</label>
            <select name="prefecture_id" id="prefecture_id" required>
                <option value="">未選択</option>
                <?php foreach ($prefectures as $code => $prefecture): ?>
                    <option value="<?php echo $code; ?>"><?php echo $prefecture; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="score">評価:</label>
            <br>
            <input type="radio" name="score" value="1" required> 1
            <input type="radio" name="score" value="2"> 2
            <input type="radio" name="score" value="3"> 3
            <input type="radio" name="score" value="4"> 4
            <input type="radio" name="score" value="5" checked> 5
            <br>
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment"></textarea>
            <br>
            <label for="image">画像</label>
            <input type="file" name="image" accept="image/*">
            <br>
            <input type="submit" value="投稿する" />

        </form>
    </main>

</body>
</html>