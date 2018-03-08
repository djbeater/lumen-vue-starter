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

        $query = [
          "q" => $request->input('q'),
          "result_type" => "recent",
          "include_entities" => "true"
        ];
        $statuses = $connection->get("search/tweets", $query);
    	  //$data = Twitter::getUserTimeline(['count' => 10, 'format' => 'array']);

        //print_r($statuses);
        //exit;

        $tweets = [];
        foreach($statuses->statuses as $status) {
            $tweet = new stdClass;

            $mediaUrl = null;
            if (isset($status->entities->media)) {
                foreach ($status->entities->media as $media) {
                    $mediaUrl = $media->media_url_https; // Or $media->media_url_https for the SSL version.
                }
            }

            $tweet->userImage = $status->user->profile_image_url_https;
            $tweet->userName = $status->user->screen_name;
            $tweet->user = $status->user->name;

            $text = preg_replace("/\p{L}*?".preg_quote('disconakts')."\p{L}*/ui", "<span class='highlight'>$0</span>", $status->text);

            $tweet->text = $text;
            $tweet->image = $mediaUrl ? $mediaUrl : 'https://picsum.photos/600/600/?random&' . rand(1, 999);
            $tweet->socialIcon = 'https://www.seeklogo.net/wp-content/uploads/2015/11/twitter-logo.png';
            $tweet->createdAt = Carbon::parse($status->created_at)->diffForHumans();
            $tweet->admin = false;

            $tweets[] = $tweet;
            $tweet = null;
        }

        $tweetsColl = collect($tweets);
        $chunk = $tweetsColl->take(3);
        //$chunk->all();
        //dd($chunk->all());

        return response()->json($chunk->all());
    }
}
