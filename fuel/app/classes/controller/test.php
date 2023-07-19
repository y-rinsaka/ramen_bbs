<?php
namespace Controller;
class Test extends \Controller_Rest
{
  protected $default_format = 'json';
  
  public function post_list()
  {
    $prefecture_id = \Input::json('prefecture_id');
    if ( $prefecture_id != 0 ) {
      $latest_ramen_posts = \Model\RamenPost::find(array(
        'where' => array(
          array('prefecture_id', '=', $prefecture_id),
        ),
        'order_by' => array(
          'id' => 'desc',
        ),
      ));
    } else {
      $latest_ramen_posts = \Model\RamenPost::find(array(
        'order_by' => array(
          'id' => 'desc',
        ),
      ));
    }

    $latest_ramen_posts_array = array();
    if ($latest_ramen_posts) {
      foreach ($latest_ramen_posts as $ramen_post) {
        if ($ramen_post->comment) {
          $ramen_post->comment = $this->truncateComment($ramen_post->comment, 10);
        }
        $latest_ramen_posts_array[] = $ramen_post->to_array();
      }
    }

    return $this->response($latest_ramen_posts_array, 200);
  }

  protected function truncateComment($comment, $length)
  {
    if (mb_strlen($comment) > $length) {
      $truncated = mb_substr($comment, 0, $length) . '...';
    } else {
      $truncated = $comment;
    }
    return $truncated;
  }
}
?>