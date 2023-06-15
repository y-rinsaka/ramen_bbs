<?php
class Controller_Register extends Controller
{
public function action_index()
  {
    $data["title"] = "新規登録";
    if (
      empty(Input::post('username'))
      || empty(Input::post('password'))
      || empty(Input::post('email'))
    )
    {
      Session::set_flash('message', '入力は全て必須です');
      $data["subnav"] = array('register'=> 'active' );
    
      return View::forge('auth/register', $data);
    }

    try {
      Auth::create_user(
        Input::post('username'),
        Input::post('password'),
        Input::post('email'),
        1
      );
    } catch (Exception $e) {
      Session::set_flash('message', 'そのユーザーは登録できません');
      $data["subnav"] = array('register'=> 'active' );
      return View::forge('auth/register', $data);
    }
    Response::redirect('/');
  }
}
?>