<?php

namespace App\Observers;

use App\Models\Topic;


class TopicObserver
{
    //
	public function saving(Topic $topic)
	{

		// 过滤body  防止 XSS 攻击
		$topic->body = clean($topic->body, 'user_topic_body');

		$topic->excerpt = make_excerpt($topic->body);
	}



}
