<?php
namespace Controller;
class Register extends \Controller
{
public function action_index()
  {
    $data["title"] = "新規登録";
    if (
      empty(\Input::post('username'))
      || empty(\Input::post('password'))
      || empty(\Input::post('email'))
    )
    {
      $data["subnav"] = array('register'=> 'active' );
      $view = \View::forge('auth/register', $data);
      return $view;
    }

    try {
      \Auth::create_user(
        \Input::post('username'),
        \Input::post('password'),
        \Input::post('email'),
        
      );
    } catch (\Exception $e) {

      \Session::set_flash('error', 'ユーザ名/メールアドレスがすでに使用されているか、メールアドレスが正しくありません。');
      $data["subnav"] = array('register'=> 'active' );
      $view = \View::forge('auth/register', $data);
      return $view;
    }
    \Response::redirect('/');
  }
}
?>