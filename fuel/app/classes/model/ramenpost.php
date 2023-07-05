<?php
namespace Model;
class RamenPost extends \Model_Crud{
  protected static $_table_name = 'ramen_posts';
  protected static $_primary_key = 'id';
  protected static $_properties = array(
    'id',
    'user_id',
    'prefecture_id',
    'shop_name',
    'shop_url',
    'score',
    'image',
    'comment',
    'created_at',
    'updated_at'
  );
  protected static $_created_at = 'created_at';
  protected static $_updated_at = 'updated_at';
  protected static $_mysql_timestamp = true;
}
?>