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
    <form method="POST" action="<?php echo Uri::create('post/update/'.$ramen_post->id); ?>" enctype="multipart/form-data" class="margin-0-30per">
      <div class="form-group">
        <label for="shop_name" class="control-label">店名</label>
        <input type="text" name="shop_name" id="shop_name" class="form-control" value="<?php echo $ramen_post->shop_name;?>" required>
      </div>
      <div class="form-group">
        <label for="shop_url" class="control-label">URL</label>
        <input type="url" name="shop_url" id="shop_url" class="form-control" value="<?php echo $ramen_post->shop_url;?>" required>
      </div>
      <div class="form-group">
        <label for="prefecuter_id" class="control-label">都道府県</label>
        <select name="prefecture_id" id="prefecture_id" class="form-control" required>
          <option value="">未選択</option>
          <?php foreach ($prefectures as $code => $prefecture): ?>
            <option value="<?php echo $code; ?>" <?php if ($ramen_post->prefecture_id == $code) {echo "selected";} ?>><?php echo $prefecture; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="score" class="control-label">評価</label>
        <br/>
        <?php for ($i = 1; $i <= 5; $i++) : ?>
          <label><input type="radio" name="score" value="<?php echo $i; ?>" <?php if ($ramen_post->score == $i) {echo "checked";} ?>> <?php echo $i; ?></label>
        <?php endfor; ?>
      </div>
      <div class="form-group">
        <label for="comment" class="control-label" >コメント</label>
        <textarea name="comment" id="comment" class="form-control" value="<?php echo $ramen_post->comment; ?>"></textarea>
      </div>
      <div class="form-group">
        <label for="image" class="control-label">画像</label>
        <input type="file" name="image" accept="image/*">
        <h4>*編集前の画像</h4>
        <p><img src="<?php echo $ramen_post->image?>" class="img-200-150" alt="容量オーバーのため表示できません"></p>
        <u>注意：このフォームでは画像に変更がない場合も画像を再選択してください。アップロードを取り消したい場合は選択不要です。</u>
      </div>
      <div class="display-flex content-center">
        <a href="<?php echo Uri::create('post/detail/'.$ramen_post->id); ?>" class="btn btn-default">投稿へ戻る</a>
        <input type="submit" value="編集する" class="btn btn-primary"/>
      </div>
    </form>
    <script>
      var current_user_id = <?php echo json_encode($current_user_id); ?>;

    </script>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
  </main>

</body>
</html>