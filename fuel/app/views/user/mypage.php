<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css(array('style.css', 'bootstrap.css')); ?>
	<title></title>
</head>
<body>
    <div id="react-header"></div>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
	<main>
        <h1>hello</h1>
	</main>
	<script>
        // 埋め込んだ変数をJavaScriptに渡す
        var current_user_id = <?php echo json_encode($current_user_id); ?>;

    </script>
    <script src="/assets/dist/app.js" charset="utf-8"></script>
</body>
</html>