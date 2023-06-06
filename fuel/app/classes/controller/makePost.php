
<?php
class Controller_MakePost extends Controller
{
    public function action_index()
    {
        $data = array();
		$data['title'] = '新規の投稿';
        $view = View::forge('makePost', $data);

        return $view;
    }
}

