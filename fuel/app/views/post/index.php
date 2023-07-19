<?php require APPPATH . 'classes/prefectures.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo Asset::css(array('style.css', 'bootstrap.css')); ?>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.1/knockout-min.js'></script>


  <title><?php echo $title; ?></title>
</head>
<body>
  <div id="js-loader" class="loader"></div>
  <?php echo Asset::js('loader.js'); ?>

  <div id="react-header"></div>
  
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
    <h1 class="text-center"><?php echo $title; ?></h1>
    <div class="container">
      <select class="form-center"  data-bind="options: Object.entries(prefectures), optionsText: '1', optionsValue: '0', value: selectedPrefecture">
      </select>
    </div>
  <?php echo Input::json('name')?>
    <div data-bind="foreach: ramenPosts">
      <div class="card">
        <h2 class="card-title" data-bind="text: shop_name"></h2>
        <img data-bind="attr: { src: image }" class="img-200-150" alt="容量オーバーのため表示できません">
        <div class="card-body">
          <h3 data-bind="text: $parent.prefectures[$data.prefecture_id]"></h3>
          <h3>@<span data-bind="text: $parent.users[$data.user_id]"></span></h3>
          <p class="card-text" data-bind="text: comment"></p>
          <a data-bind="attr: { href: $parent.createPostLink($data.id) }" class="btn btn-primary">詳細</a>
        </div>
      </div>
    </div>
    <p class="link-to-post">
      <a href="<?php echo Uri::create('post/create'); ?>">
        <?php echo Asset::img('link-to-post.png'); ?>
      </a>
    </p>
  </main>
  <script>
    var current_user_id = <?php echo json_encode($current_user_id); ?>;
  </script>
  <script src="/assets/dist/app.js" charset="utf-8"></script>
  <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
  <script>
    // Knockout.js ViewModel
    function RamenViewModel() {
      var self = this;
      
      // 投稿詳細ページへのリンクを生成するメソッド
      self.createPostLink = function(postId) {
        return '/post/detail/' + postId;
      };

      // データバインディングに使用する変数
      self.prefectures = Object.assign({'0': 'すべての都道府県'}, <?php echo json_encode($prefectures); ?>); // undefinedではなく0にして全投稿表示対応
      self.users = <?php echo json_encode($users); ?>;
      self.selectedPrefecture = ko.observable('');
      self.ramenPosts = ko.observable('');

      this.selectedPrefecture.subscribe(function () {
        // 選択された都道府県に対応するJSONデータを取得するためのリクエストを送信
        var data = {
          prefecture_id: self.selectedPrefecture()
        }
        $.ajax({
          url: '<?php echo Uri::base();?>' + 'test/list.json',
          type: 'POST',
          cache: false,
          contentType: 'application/json',
          dataType: 'json',
          data: JSON.stringify(data), // 選択された都道府県を送信
          success: function (json_data) {
            self.ramenPosts(json_data); // 取得したJSONデータをramenPostsに設定
          },
          error: function () {
            alert('Server Error. Please try again later.');
          },
          complete: function () {
          }
        });
      });
    }

    var viewModel = new RamenViewModel();
    ko.applyBindings(viewModel);
  </script>
</body>
</html>