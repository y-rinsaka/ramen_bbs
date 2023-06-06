
<?php
class Controller_MakePost extends Controller
{
    public function action_index()
    {

        $query= DB::select()->from('prefectures');
        $results=$query->execute();

        $view= 'makePost';
        $twig= View_Twig::forge($view);
        $presenter= Presenter::forge($view, 'view', null, $twig);
        $presenter-> set('results', $results);
    
        return Response::forge($presenter);

    }
}

