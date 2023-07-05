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
  <div id="react-header"></div>
  <main>
    <h1 class="align-center"><?php echo $title; ?></h1>
    <form method="POST" action="<?php echo Uri::create('/post/save'); ?>" enctype="multipart/form-data" class="margin-0-30per">
      <div class="form-group">
        <label for="shop_name" class="control-label">店名</label>
        <input type="text" name="shop_name" id="shop_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="shop_url" class="control-label">URL</label>
        <input type="url" name="shop_url" id="shop_url" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="prefecuter_id" class="control-label">都道府県</label>
        <select name="prefecture_id" id="prefecture_id" class="form-control" required>
          <option value="">未選択</option>
          <?php foreach ($prefectures as $prefecture_id => $prefecture): ?>
            <option value="<?php echo $prefecture_id; ?>"><?php echo $prefecture; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="score" class="control-label" class="control-label">評価</label>
        <br/>
        <label><input type="radio" name="score" value="1" required> 1</label>
        <label><input type="radio" name="score" value="2"> 2</label>
        <label><input type="radio" name="score" value="3"> 3</label>
        <label><input type="radio" name="score" value="4"> 4</label>
        <label><input type="radio" name="score" value="5" checked> 5</label>
      </div>
      <div class="form-group">
        <label for="comment" class="control-label">コメント</label>
        <textarea name="comment" id="comment" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="image" class="control-label">画像</label>
        <input type="file" name="image" accept="image/*">
      </div>
      <div class="display-flex content-center">
      <a href="/" class="btn btn-default">トップへ戻る</a>
      <input type="submit" value="投稿する" class="btn btn-primary"/>
      </div>
    </form>
    
  </main>
  <script>
    var current_user_id = <?php echo json_encode($current_user_id); ?>;

  </script>
  <script src="/assets/dist/app.js" charset="utf-8"></script>
</body>
</html>