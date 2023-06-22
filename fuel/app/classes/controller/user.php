<?php

class Controller_User extends Controller
{

	public function action_index($user_id)
	{
        // user_id に対応するユーザー情報の取得
        $query = DB::select('username', 'created_at')->from('users')->where('id', $user_id);
        $result = $query->execute()->as_array();
        $data['user'] = $result[0];

        // そのユーザーが投稿した数
        $data['user']['ramen_post_count'] = Model_RamenPost::count('id', true, array('user_id'=>$user_id));

        return View::forge('user/index', $data);
	}

}
