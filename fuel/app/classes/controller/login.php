<?php
namespace Controller;
class Login extends \Controller
{
  public function action_index()
  {
    $data['title'] = 'ログイン';

    \Auth::check() and \Response::redirect('/');

    $error = null;
    $auth = \Auth::instance();

    if (\Input::post()) {
      if ($auth->login(\Input::post('username'), \Input::post('password'))) {
        \Response::redirect('/');
      } else {
        $error = 'ユーザ名かパスワードに誤りがあります';
      }
    }

    $view = \View::forge('auth/login', $data);

    $view->set('error', $error);
    return $view;
  }
}
?>

