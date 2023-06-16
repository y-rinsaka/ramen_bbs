<?php
class Controller_Top extends Controller
{
    public function before() {

		// 未ログイン時、ログインページへリダイレクト
		if (!Auth::check()) {
		
			Response::redirect('/login');
		
		}
		
	}
    public function action_index()
    {
        $data = array();
		$data['title'] = '新規の投稿';
        
		return View::forge('top', $data);
    }
}
?>