
<?php
class Controller_MakePost extends Controller

{
    public function action_index()
    {   
        if (Input::method() == 'POST') {
            // フォームデータの取得
            // $userId = Auth::get('id');
            // $prefectureId = Input::post('prefecture_id');
            $shopName = Input::post('shop_name');
            $shopUrl = Input::post('shop_url');
            $score = Input::post('score');
            $comment = Input::post('comment');
            // 画像のアップロード
            $image = Input::file('image');
            $imagePath = '';

            if ($image && $image['tmp_name']) {
                $uploadDir = DOCROOT . 'uploads/';
                $imageName = $this->generateUniqueFileName($image['name']);
                $imagePath = $uploadDir . $imageName;

                // 画像ファイルであることを確認
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                    move_uploaded_file($image['tmp_name'], $imagePath);
                } else {
                    // エラーメッセージを表示
                    Session::set_flash('error', '無効なファイル形式です。画像ファイルを選択してください。');
                }
            } else {
                // 画像がアップロードされていない場合はデフォルトの画像パスを設定
                $imagePath = DOCROOT . 'assets/img/no_image.jpg';
            }

            // 新しいPostモデルインスタンスを作成し、値を設定
            $post = new Model_RamenPost();
            // $post->user_id = $userId;
            // $post->prefecture_id = $prefectureId;
            $post->shop_name = $shopName;
            $post->shop_url = $shopUrl;
            $post->score = $score;
            $post->comment = $comment;
            $post->image_path = $imagePath;


            try {
                // データベースに保存
                $post->save();

                // 成功メッセージを表示
                Session::set_flash('success', '投稿が正常に保存されました');

                // 投稿後にリダイレクトなどの処理を行う
                Response::redirect('/top');
            } catch (Exception $e) {
                // エラーメッセージを表示
                Session::set_flash('error', 'データの保存中にエラーが発生しました');
            }
        }

        // フォームのビューを表示
        $data = array();
		$data['title'] = '新規の投稿';

        return View::forge('makePost', $data);
    }

    public function action_success()
    {
        // 成功メッセージのビューを表示
        // return View::forge('post/success');
    }

    // ユニークなファイル名を生成するメソッド
    private function generateUniqueFileName($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;
        return $uniqueName;
    }
}

?>