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
        <h1 class="align-center"><?php echo $title; ?></h1>
        <div class="container">
        <select class="form-center"  data-bind="options: Object.entries(prefectures), optionsText: '1', optionsValue: '0', value: selectedPrefecture, optionsCaption: 'すべての都道府県'">
        </select>
        </div>

        <div data-bind="foreach: ramenPosts">
            <div class="card" data-bind="visible: $parent.filterByPrefecture($data.prefecture_id)">
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
        // 埋め込んだ変数をJavaScriptに渡す
        var current_user_id = <?php echo json_encode($current_user_id); ?>;

    </script>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
    <script>
        // Knockout.js ViewModel
        function RamenViewModel() {
            var self = this;
            // モデルから取得したjson_dataの整形
            var json_data = '<?php echo htmlspecialchars_decode($json_latest_20_ramen_posts); ?>';
            var clean_json_data = json_data.replace(/[\u0000-\u0019]+/g, "");
            var data_array = JSON.parse(clean_json_data);

            // データバインディングに使用する変数を定義
            self.ramenPosts = ko.observableArray(data_array);
            self.prefectures = <?php echo json_encode($prefectures); ?>;
            self.users = <?php echo json_encode($users); ?>;
            self.selectedPrefecture = ko.observable('');

            // 投稿詳細ページへのリンクを生成するメソッド
            self.createPostLink = function(postId) {
                return '/post/detail/' + postId;
            };

            // 都道府県で絞り込みを行う関数
            self.filterByPrefecture = function(post_prefecture) {
                var selected_prefecture_id = self.selectedPrefecture();
                if (selected_prefecture_id && selected_prefecture_id !='すべての都道府県') {
                    
                    return (post_prefecture === Number(selected_prefecture_id));
                }
                return true;
            };

            self.selectedPrefecture.subscribe(function() {
                self.filterByPrefecture();
            });
        }
        // ViewModelを適用
        var viewModel = new RamenViewModel();
        ko.applyBindings(viewModel);
    </script>

</body>
</html>