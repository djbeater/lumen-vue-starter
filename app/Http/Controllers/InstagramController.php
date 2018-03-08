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

        $ig = new Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
            $hashtagPosts = $ig->hashtag->getFeed($request->input('q'));

            //dd($hashtagPosts);

            $instas = [];
            foreach($hashtagPosts->getItems() as $hashtagPost) {
                // Let's get the media item from the first item of the explore-items array...!
                $firstItem = $hashtagPost->getMedia();
                // Finally, let's get the highest-quality image URL for the media item!
                $mediaUrl = null;
                if ($firstItem) {
                    $mediaUrl = $firstItem->getImageVersions2()->getCandidates()[0]->getUrl();
                }

                //dd($hashtagPost->getUser());
                //dd($firstItem);

                $insta = new stdClass;
                $insta->userImage = $hashtagPost->getUser()->profile_pic_url;
                $insta->userName = $hashtagPost->getUser()->username;
                $insta->user = $hashtagPost->getUser()->full_name;

                $text = preg_replace("/\p{L}*?".preg_quote('disconakts')."\p{L}*/ui", "<span class='highlight'>$0</span>", $hashtagPost->getCaption()->text);

                $insta->text = $text;
                $insta->image = $mediaUrl ? $mediaUrl : 'https://picsum.photos/600/600/?random&' . rand(1, 999);
                $insta->socialIcon = 'https://www.seeklogo.net/wp-content/uploads/2016/06/Instagram-logo.png';
                $insta->createdAt = Carbon::createFromTimestamp($hashtagPost->taken_at)->diffForHumans();
                $insta->admin = false;

                $instas[] = $insta;
                $insta = null;
            }

            $instasColl = collect($instas);
            $chunk = $instasColl->take(3);
            //$chunk->all();
            //dd($chunk->all());

            return response()->json($chunk->all());

        } catch (\Exception $e) {
            $response = ['error' => $e->getMessage()];

            return response()->json($response);
        }
    }
}
