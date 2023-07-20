<?php
namespace Model;
class User extends \Model {
  public static function get_usernames()
  {
    $query = \DB::select('id', 'username')->from('users')->order_by('id')->execute();
    $result = $query->as_array();
    $users = array();
    foreach ($result as $item) {
      $users[$item['id']] = $item['username'];
    }
    return $users;
  }

  public static function get_user_information($user_id)
  {
    $result = \DB::select('username', 'created_at')->from('users')->where('id', $user_id)->execute()->as_array();
    return $result;
  }

  public static function get_day_count($user_id, $current_date)
  {
    $query = \DB::select(\DB::expr('COUNT(*) as count'))
    ->from('ramen_posts')
    ->where('user_id', '=', $user_id)
    ->where('created_at', '=', $current_date)
    ->execute();
    $count = (int) $query->get('count', 0);
    return $count;
  }

}