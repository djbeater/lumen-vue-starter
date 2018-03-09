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
                $insta->userImage = $hashtagPost->getUser()->profile_pic_url;
                $insta->userName = $hashtagPost->getUser()->username;
                $insta->user = $hashtagPost->getUser()->full_name;

                $text = preg_replace("/\p{L}*?".preg_quote($query)."\p{L}*/ui", "<span class='highlight'>$0</span>", $hashtagPost->getCaption()->text);

                $insta->text = $text;

                //$insta->image = $mediaUrl ? $mediaUrl : 'https://picsum.photos/600/600/?random&' . rand(1, 999);
                $insta->image = $mediaUrl ? $mediaUrl : asset('/img/disconakts2018-cover-full.jpg');

                $insta->socialIcon = 'https://www.seeklogo.net/wp-content/uploads/2016/06/Instagram-logo.png';
                $insta->createdAt = Carbon::createFromTimestamp($hashtagPost->taken_at)->diffForHumans();
                $insta->admin = false;
                $insta->network = 'instagram';

                $instas[] = $insta;
                $insta = null;
            }

            $instasColl = collect($instas);
            if (!$random) {
                $chunk = $instasColl->take(3);
            }

            if ($random) {
                $random = $instasColl->random(3);
                $chunk = $random->shuffle();
            }

            //$chunk->all();
            //dd($chunk->all());

            return response()->json($chunk->all());

        } catch (\Exception $e) {
            $response = ['error' => $e->getMessage()];

            return response()->json($response);
        }
    }
}
