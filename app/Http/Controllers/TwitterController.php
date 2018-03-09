<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use stdClass;
use Carbon\Carbon;

class TwitterController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function fetch(Request $request)
    {
        $connection = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
        //$content = $connection->get("account/verify_credentials");

        Carbon::setLocale('lv');
        $random = $request->input('random');
        $limit = $request->input('limit');
        //exit();

        $query = $request->input('q');
        $hastagArray = explode(' ', str_replace('OR', '', $query));
        //print_r($hastagArray);
        //exit;

        $queryArray = [
          "q" => $query,
          "result_type" => $random ? "mixed" : "recent",
          "include_entities" => $random ? "true" : "false",
        ];
        $statuses = $connection->get("search/tweets", $queryArray);
    	  //$data = Twitter::getUserTimeline(['count' => 10, 'format' => 'array']);
        //print_r($statuses);
        //exit;

        $tweets = [];
        foreach($statuses->statuses as $status) {
            $tweet = new stdClass;
            $tweet->id = rand();

            $mediaUrl = null;
            if (isset($status->entities->media)) {
                foreach ($status->entities->media as $media) {
                    $mediaUrl = $media->media_url_https; // Or $media->media_url_https for the SSL version.
                }
            }

            $tweet->userImage = $status->user->profile_image_url_https;
            $tweet->userName = $status->user->screen_name;
            $tweet->user = $status->user->name;

            $text = preg_replace("/\p{L}*?".preg_quote($hastagArray[0])."\p{L}*/ui", "<span class='highlight'>$0</span>", $status->text);
            if (!empty($hastagArray[2])) {
                $text = preg_replace("/\p{L}*?".preg_quote($hastagArray[2])."\p{L}*/ui", "<span class='highlight'>$0</span>", $text);
            }
            $text = preg_replace('/(^|\s)@([\w_\.]+)/', '$1<a href="https://twitter.com/$2">@$2</a>', $text);

            $tweet->text = $text;

            //$tweet->image = $mediaUrl ? $mediaUrl : 'https://picsum.photos/600/600/?random&' . rand(1, 999);
            $tweet->image = $mediaUrl ? $mediaUrl : asset('/img/disconakts2018-avatar-logo.jpg');

            $tweet->socialIcon = asset('/img/twitter-logo.png');
            $tweet->createdAt = Carbon::parse($status->created_at)->diffForHumans();
            $tweet->admin = false;
            $tweet->network = 'twitter';

            $tweets[] = $tweet;
            $tweet = null;
        }

        $tweetsColl = collect($tweets);

        if ($tweetsColl->count() < $limit) {
            $limit = $tweetsColl->count();
        }

        if (!$random) {
            $chunk = $tweetsColl->take($limit);
        }

        if ($random) {
            $random = $tweetsColl->random($limit);
            $chunk = $random->shuffle();
        }

        return response()->json($chunk->all());
    }
}
