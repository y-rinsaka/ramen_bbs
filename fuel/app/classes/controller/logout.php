<?php
namespace Controller;
class Logout extends \Controller
{
  public function action_index()
  {
    $auth = \Auth::instance();
    $auth->logout();

    \Response::redirect('/');
  }
}
?>