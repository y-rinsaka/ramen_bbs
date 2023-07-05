<?php
namespace Controller;
class Login extends \Controller
{
  public function action_index()
  {
    $data = array();
    $data['title'] = 'ログイン';

    //すでにログイン済であればログイン後のページへリダイレクト
    \Auth::check() and \Response::redirect('/');

    //エラーメッセージ用変数初期化
    $error = null;

    //ログイン用のオブジェクト生成
    $auth = \Auth::instance();

    //ログインボタンが押されたら、ユーザ名、パスワードをチェックする
    if (\Input::post()) {
      if ($auth->login(\Input::post('username'), \Input::post('password'))) {
      // ログイン成功時、ログイン後のページへリダイレクト
      \Response::redirect('/');
      } else {
      // ログイン失敗時、エラーメッセージ作成
      $error = 'ユーザ名かパスワードに誤りがあります';
      }
    }

    //ビューテンプレートを呼び出し
    $view = \View::forge('auth/login', $data);

    //エラーメッセージをビューにセット
    $view->set('error', $error);

    return $view;
  }
}
?>

