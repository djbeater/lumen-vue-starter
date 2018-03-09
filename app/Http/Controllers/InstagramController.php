<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InstagramAPI\Instagram;
use stdClass;
use Carbon\Carbon;

class InstagramController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function fetch(Request $request)
    {
        /////// CONFIG ///////
        $username = env('INSTAGRAM_USERNAME');
        $password = env('INSTAGRAM_PASSWORD');
        $debug = false;
        $truncatedDebug = true;
        //////////////////////

        Carbon::setLocale('lv');
        $random = $request->input('random');
        $limit = $request->input('limit');
        //exit();

        $ig = new Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
            $query = $request->input('q');
            $hashtagPosts = $ig->hashtag->getFeed($query);

            //dd($hashtagPosts);

            $instas = [];
            foreach($hashtagPosts->getItems() as $hashtagPost) {
                // Let's get the media item from the first item of the explore-items array...!
                //$firstItem = $hashtagPost->getMedia();
                //$firstItem = $hashtagPost;
                //print_r($hashtagPost->getImageVersions2());
                //exit;
                // Finally, let's get the highest-quality image URL for the media item!
                $mediaUrl = null;
                if ($hashtagPost->getImageVersions2()) {
                    $mediaUrl = $hashtagPost->getImageVersions2()->getCandidates()[0]->getUrl();

                    if (!$mediaUrl) {
                        $mediaUrl = $hashtagPost->getImageVersions2()->getCandidates()[1]->getUrl();
                    }
                }

                //print_r($mediaUrl);
                //print_r($hashtagPost);
                //exit;

                //dd($hashtagPost->getUser());
                //dd($firstItem);

                $insta = new stdClass;
                $insta->id = rand();
                $insta->userImage = $hashtagPost->getUser()->profile_pic_url;
                $insta->userName = $hashtagPost->getUser()->username;
                $insta->user = $hashtagPost->getUser()->full_name;

                $text = preg_replace("/\p{L}*?".preg_quote($query)."\p{L}*/ui", "<span class='highlight'>$0</span>", $hashtagPost->getCaption()->text);
                $text = preg_replace('/(^|\s)@([\w_\.]+)/', '$1<a href="https://instagram.com/$2">@$2</a>', $text);

                $insta->text = $text;

                //$insta->image = $mediaUrl ? $mediaUrl : 'https://picsum.photos/600/600/?random&' . rand(1, 999);
                $insta->image = $mediaUrl ? $mediaUrl : asset('/img/disconakts2018-avatar-logo.jpg');

                $insta->socialIcon = asset('/img/instagram-logo.png');
                $insta->createdAt = Carbon::createFromTimestamp($hashtagPost->taken_at)->diffForHumans();
                $insta->admin = false;
                $insta->network = 'instagram';

                $instas[] = $insta;
                $insta = null;
            }

            $instasColl = collect($instas);
            if ($instasColl->count() < $limit) {
                $limit = $instasColl->count();
            }

            if (!$random) {
                $chunk = $instasColl->take($limit);
            }

            if ($random) {
                $random = $instasColl->random($limit);
                $chunk = $random->shuffle();
            }

            return response()->json($chunk->all());

        } catch (\Exception $e) {
            $response = ['error' => $e->getMessage()];

            return response()->json($response);
        }
    }
}
