<?php
namespace Controller;
class Logout extends \Controller
{
    public function action_index()
    {
    //ログイン用のオブジェクト生成
    $auth = \Auth::instance();
    $auth->logout();

    \Response::redirect('/');
}
}