<?php
namespace Controller;
class Post extends \Controller
{
  public function action_index()
  {
    $data['title'] = '投稿一覧';

    // 投稿データを取得
    $ramen_posts = \Model\RamenPost::find('all', array(
      'order_by' => array('created_at' => 'desc'),
    ));

    // ユーザー名を取得
    $users = $this->getUserNames($ramen_posts);

    // 投稿データとユーザー名を結合
    foreach ($ramen_posts as &$ramen_post) {
      $ramen_post['username'] = $users[$ramen_post['user_id']];
      $ramen_post['comment'] = $this->truncateComment($ramen_post['comment'], 50);
    }

    $data['ramen_posts'] = $ramen_posts;

    return \View::forge('post/index', $data);
  }

  public function action_create()
  {
    $data['title'] = '投稿する';

    if (\Input::method() == 'POST') {
      $ramen_post = \Model\RamenPost::forge(array(
        'prefecture_id' => \Input::post('prefecture_id'),
        'shop_name' => \Input::post('shop_name'),
        'shop_url' => \Input::post('shop_url'),
        'score' => \Input::post('score'),
        'comment' => \Input::post('comment'),
        'user_id' => \Auth::get('id'),
      ));

      $image = \Input::file('image');
      $imagePath = $this->uploadImage($image);
      $ramen_post->image = $imagePath;

      try {
        // 投稿を保存
        $ramen_post->save();

        // 成功メッセージを表示
        \Session::set_flash('success', '投稿が正常に作成されました');
      } catch (\Exception $e) {
        // エラーメッセージを表示
        \Session::set_flash('error', $e->getMessage());
      }

      \Response::redirect('post');
    }

    return \View::forge('post/create', $data);
  }

  public function action_detail($id)
  {
    $data['title'] = '詳細';
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
    $ramen_post = \Model\RamenPost::find_by_pk($id);
    $data['ramen_post'] = $ramen_post;
    $data['current_user_id'] = \Auth::get('id');
    $data['title'] = "編集する";

    if ($ramen_post && $ramen_post->user_id == \Auth::get('id')) {
      return \View::forge('post/edit', $data);
    } else {
      \Session::set_flash('error', '編集権限がありません');
      \Response::redirect('/');
    }
  }

  public function action_update($id)
  {
    if (\Input::method() == 'POST') {
      $ramen_post = \Model\RamenPost::find_by_pk($id);
      $ramen_post->prefecture_id = \Input::post('prefecture_id');
      $ramen_post->shop_name = \Input::post('shop_name');
      $ramen_post->shop_url = \Input::post('shop_url');
      $ramen_post->score = \Input::post('score');
      $ramen_post->comment = \Input::post('comment');

      $image = \Input::file('image');
      $imagePath = $this->uploadImage($image);
      $ramen_post->image = $imagePath;

      try {
        // 投稿を更新
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

  public function action_delete($id)
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
    $userIds = array();
    foreach ($ramen_posts as $ramen_post) {
      $userIds[] = $ramen_post['user_id'];
    }

    $query = \DB::select('id', 'username')->from('users')->where('id', 'IN', $userIds);
    $result = $query->execute()->as_array();

    $users = array();
    foreach ($result as $row) {
      $users[$row['id']] = $row['username'];
    }

    return $users;
  }

  protected function truncateComment($comment, $length)
  {
    if (mb_strlen($comment) <= $length) {
      return $comment;
    }

    return mb_substr($comment, 0, $length) . '...';
  }
}
?>