<?php
namespace Controller;
class User extends \Controller
{
    public function before() {
		// 未ログイン時、ログインページへリダイレクト
		if (!\Auth::check()) {
			\Response::redirect('/login');
        }
	}
	public function action_index($user_id)
	{  
        // user_id に対応するユーザー情報の取得
        $query = \DB::select('username', 'created_at')->from('users')->where('id', $user_id);
        $result = $query->execute()->as_array();
        $data['user'] = $result[0];
        
        // そのユーザーの総投稿数
        $data['user']['ramen_post_count'] = \Model\RamenPost::count('id', true, array('user_id'=>$user_id));

        // 7日間の記録
        // 直近の一週間の開始日と終了日を取得
        $start_date = strtotime('-1 week');
        $endDate = time();

        $target_date = date("n/j"); // 今日の日付
        $start_date = date("Y-m-d", strtotime($target_date . " -6 day")); // 開始日（今日から6日前）
        $current_date = $start_date;

        $records = [];
        for ($i = 0; $i < 7; $i++) {
            $date = date("n/j", strtotime($current_date));
            $count = 0; // 初期値を0とする

            // 該当日の投稿数を取得する
            $query = \DB::select(\DB::expr('COUNT(*) as count'))
            ->from('ramen_posts')
            ->where('user_id', '=', $user_id)
            ->where('created_at', '=', $current_date)
            ->execute();

            // 取得した投稿数を個数として連想配列に格納する
            $count = (int) $query->get('count', 0);

            $records[$date] = $count;

            $current_date = date("Y-m-d", strtotime($current_date . " +1 day"));
        }
        $data['records'] = $records;
        $data['current_user_id'] = \Auth::get('id');
        
        return \View::forge('user/index', $data);
	}
}
?>
