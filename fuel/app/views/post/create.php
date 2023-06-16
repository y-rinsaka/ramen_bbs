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
        <h1><?php echo $title; ?></h1>
        <a href="logout" class="logout-link">ログアウト</a>
    </header>
    <form method="POST" action="/post/save" enctype="multipart/form-data">
        <label for="shop_name">店名</label>
        <input type="text" name="shop_name" id="shop_name" required>
        <br/>
        <label for="shop_url">URL</label>
        <input type="url" name="shop_url" id="shop_url" required>
        <br>
        <label for="prefecture">都道府県</label>
        <select name="prefecture_id" id="prefecture_id" required>
            <option value="">選択してください</option>
            <option value="1">北海道</option>
            <!-- 他の都道府県のオプションを追加 -->
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
        <label for="content">コメント</label>
        <textarea name="content" id="content"></textarea>
        <br>
        <label for="image">画像</label>
        <input type="file" name="image" accept="image/*">
        <br>
        <input type="submit" value="投稿する" />

    </form>


</body>
</html>