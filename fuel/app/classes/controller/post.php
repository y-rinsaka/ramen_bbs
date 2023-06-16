
<?php
class Controller_Post extends Controller
{
    public function before() {
		// 未ログイン時、ログインページへリダイレクト
		if (!Auth::check()) {
			Response::redirect('/login');
        }
	}

    public function action_create()
    {
        $data = array();
        $data['title'] = "投稿する";
        return View::forge('post/create', $data);
    }

    public function action_save()
    {   
        if (Input::method() == 'POST') {
            // フォームデータの取得
            $form = array();
            $form['user_id'] = Auth::get('id');
            $form['prefecture_id'] = Input::post('prefecture_id');
            $form['shop_name'] = Input::post('shop_name');
            $form['shop_url'] = Input::post('shop_url');
            $form['score'] = Input::post('score');
            $form['comment'] = Input::post('comment');
            // 画像のアップロード
            $image = Input::file('image');
            $imagePath = '';

            if ($image && $image['name']) {
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

            $form['image'] = $imagePath;
            // 新しいPostモデルインスタンスを作成し、値を設定
            $ramen_post = Model_RamenPost::forge(); //Model_RamenPostクラスのオブジェクトを作成
            $ramen_post->set($form); //setメソッドで、配列をramen_postオブジェクトに設定
            
            try {
                // データベースに保存
                $result = $ramen_post->save();

                // 成功メッセージを表示
                Session::set_flash('success', '投稿が正常に保存されました');

                Response::redirect('/');
            } catch (Exception $e) {
                // エラーメッセージを表示
                Session::set_flash('error', $e->getMessage());
            }
        }

        Response::redirect('post');
    }

    // ユニークなファイル名を生成するメソッド
    private function generateUniqueFileName($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;
        return $uniqueName;
    }

    public function action_index(){

        $data = array();
        $data['title'] = '新規投稿';
        $data['rows'] = Model_RamenPost::find_all();

        return View::forge('post/top',$data);

    }
}

?>