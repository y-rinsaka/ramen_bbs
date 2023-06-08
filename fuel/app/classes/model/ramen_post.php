<?php
class Model_RamenPost extends Model
{
    protected static $_table_name = 'ramen_posts';
    protected static $_properties = array(
        'id',
        // 'user_id',
        // 'prefecture_id,
        'shop_name',
        'shop_url',
        'score',
        'comment',
        'image',
        'created_at',
        'updated_at',
    );
}
?>
