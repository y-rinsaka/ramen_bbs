<?php
namespace Model;
class User extends \Model {
  public static function get_usernames($userIds)
  {
    $query = \DB::select('id', 'username')->from('users')->where('id', 'IN', $userIds)->execute();
    $result = $wuery->as_array();
    return $result;
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