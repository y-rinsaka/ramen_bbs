<?php
namespace Controller;
class Post extends \Controller
{
  public function before() {
  // 未ログイン時、ログインページへリダイレクト
  if (!\Auth::check()) {
    \Response::redirect('/login');
      }
}

  public function action_index()
  {
    $latest_ramen_posts = \Model\RamenPost::find(array(
      'order_by' => array(
          'id' => 'desc',
      ),
    ));

    $data['title'] = "最新の投稿(20件)";
    $data['current_user_id'] = \Auth::get('id');
    $data['latest_20_ramen_posts'] = $latest_ramen_posts;
    $data['users'] = $this->getUserNames($latest_ramen_posts);
    $latest_ramen_posts_array = array();
    foreach ($latest_ramen_posts as $ramen_post) {
      if ($ramen_post->comment) {
        $ramen_post->comment = $this->truncateComment($ramen_post->comment, 10);
      }
      $latest_ramen_posts_array[] = $ramen_post->to_array();
    }
    $json_latest_ramen_posts = json_encode($latest_ramen_posts_array);
    $data['json_latest_ramen_posts'] = $json_latest_ramen_posts;

    return \View::forge('post/index',$data);
  }
  
  public function action_create()
  {
    $data['title'] = "投稿する";
    $data['current_user_id'] = \Auth::get('id');

    return \View::forge('post/create', $data);
  }

  public function action_save()
  {   
    if (\Input::method() == 'POST') {
      // フォームデータの取得
      $form = array();
      $form['user_id'] = \Auth::get('id');
      $form['prefecture_id'] = \Input::post('prefecture_id');
      $form['shop_name'] = \Input::post('shop_name');
      $form['shop_url'] = \Input::post('shop_url');
      $form['score'] = \Input::post('score');
      $form['comment'] = \Input::post('comment');
      // 画像のアップロード
      $image = \Input::file('image');
      $imagePath = $this->uploadImage($image);
      $form['image'] = $imagePath;

      $ramen_post = \Model\RamenPost::forge();
      $ramen_post->set($form);
      
      try {
        $result = $ramen_post->save();
        \Session::set_flash('success', '投稿が正常に保存されました');
        \Response::redirect('/');
      } catch (\Exception $e) {
        \Session::set_flash('error', $e->getMessage());
      }
    }
    \Response::redirect('post');
  }

  public function action_detail($id)
  {
    $data['title'] = '詳細';

    // ログインユーザーのIDを取得し、投稿のユーザーIDと一致したものだけが編集・削除できるようにする
    $data['current_user_id'] = \Auth::get('id');

    $ramen_post = \Model\RamenPost::find_by_pk($id);
    $data['ramen_post'] = $ramen_post;
    $query = \DB::select('username')->from('users')->where('id', $ramen_post->user_id);
    $result = $query->execute()->as_array();
    $data['ramen_post']['username'] = $result[0]['username'];

    return \View::forge('post/detail', $data);
  }

  public function action_edit($id)
  {
    $data['title'] = "編集する";
    
    // 編集対象のPostを取得
    $ramen_post = \Model\RamenPost::find_by_pk($id);
    $data['ramen_post'] = $ramen_post;
    $data['current_user_id'] = \Auth::get('id');

    // 自分のPostであるか確認
    if ($ramen_post && $ramen_post->user_id == \Auth::get('id')) {
      return \View::forge('post/edit', $data);
    } else {
      // 編集権限がない場合はリダイレクト
      \Session::set_flash('error', 'この投稿は編集できません。');
      \Response::redirect('/');
    }
  }

  public function post_update($id)
  {
    // 更新対象のPostを取得
    $ramen_post = \Model\RamenPost::find_by_pk($id);
    if (!$ramen_post) {
      // 投稿が存在しない場合の処理
      \Session::set_flash('error', '指定された投稿は存在しません');
      \Response::redirect('/');
    }
    if (\Input::method() == 'POST') {
      // 自分のPostであるか確認
      if ($ramen_post && $ramen_post->user_id == \Auth::get('id')) {
        // 値の更新
        $ramen_post->prefecture_id = \Input::post('prefecture_id');
        $ramen_post->shop_name = \Input::post('shop_name');
        $ramen_post->shop_url = \Input::post('shop_url');
        $ramen_post->score = \Input::post('score');
        $ramen_post->comment = \Input::post('comment');

        $image = \Input::file('image');
        $imagePath = $this->uploadImage($image);
        $ramen_post->image = $imagePath;

        try {
          // 投稿を保存
          $ramen_post->is_new(false);
          $ramen_post->save();
          // 成功メッセージを表示
          \Session::set_flash('success', '投稿が正常に更新されました');
  
          \Response::redirect('/');
        } catch (\Exception $e) {
          // エラーメッセージを表示
          \Session::set_flash('error', $e->getMessage());
          \Response::redirect('/');
        }
      }
    }
  }

  public function post_delete($id)
  {
    try {
      $post = \Model\RamenPost::find_by_pk($id);

      if ($post) {
        $post->delete();
        \Session::set_flash('success', '投稿を削除しました。');
      } else {
        \Session::set_flash('error', '該当する投稿が見つかりませんでした。');
      }
    } catch (\Exception $e) {
        \Session::set_flash('error', '投稿の削除中にエラーが発生しました。');
    }
    \Response::redirect('/');
  }

private function uploadImage($image)
{
  $imagePath = '';
  if ($image && $image['name']) {
    $uploadDir = DOCROOT . 'assets/uploads/';
    $imageName = $this->generateUniqueFileName($image['name']);
    $imagePath = '/assets/uploads/' . $imageName;

    // 画像ファイルであることを確認
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    if (in_array(strtolower($fileExtension), $allowedExtensions)) {
      move_uploaded_file($image['tmp_name'], DOCROOT . $imagePath);
    } else {
      // エラーメッセージを表示
      \Session::set_flash('error', '無効なファイル形式です。画像ファイルを選択してください。');
    }
  } else {
    // 画像がアップロードされていない場合はデフォルトの画像パスを設定
    $imagePath = '/assets/img/no_image.jpg';
  }
  return $imagePath;
}

  private function generateUniqueFileName($filename)
  {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $extension;
    return $uniqueName;
  }

  protected function getUserNames($ramen_posts)
  {
    $userIds = array_column($ramen_posts, 'user_id');
    $result = \Model\User::get_usernames($userIds);

    $users = array();
    foreach ($result as $row) {
      $users[$row['id']] = $row['username'];
    }

    return $users;
  }

  protected function truncateComment($comment, $length)
  {
    if (mb_strlen($comment) > $length) {
      $truncated = mb_substr($comment, 0, $length) . '...';
    } else {
      $truncated = $comment;
    }
    return $truncated;
  }
}

?>