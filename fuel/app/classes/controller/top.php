<?php
class Controller_Top extends Controller
{
    public function action_index()
    {
        $data = array();
		$data['title'] = '新規の投稿';
        
		return View::forge('top', $data);
    }
}
?>