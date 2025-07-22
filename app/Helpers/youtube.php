<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


// function fetchVideoData($videoId)
// {
//     $client = new Client();
//     $apiKey = env('YOUTUBE_API_KEY');
//     $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id=$videoId&key=$apiKey";

//     try {
//         $response = $client->get($url);
//         $data = json_decode($response->getBody(), true);
//         $video = $data['items'][0]; // First result
//         // dd($video);
//         return [
//             'published_at' => $video['snippet']['publishedAt'],
//             'title' => $video['snippet']['title'],
//             'description' => $video['snippet']['description'],
//             'views' => $video['statistics']['viewCount'],
//             'likes' => $video['statistics']['likeCount'],
//             'thumbnail' => $video['snippet']['thumbnails']['maxres']['url'],
//             'tags' => json_encode($video['snippet']['tags']),
//         ];
//     } catch (\Exception $e) {
//         return ['error' => $e->getMessage()];
//     }
// }
// function fetchPlaylistVideos($playlistId)
// {
//     $videoIds = [];

//     $playlistUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,contentDetails&playlistId=$playlistId&maxResults=50&key=" . env('YOUTUBE_API_KEY');
    
//     $response = file_get_contents($playlistUrl);
//     $data = json_decode($response, true);

//     if (!empty($data['items'])) {
//         foreach ($data['items'] as $item) {
//             $videoIds[] = $item['contentDetails']['videoId'];
//         }
//     }

//     // dd($videoIds);
//     return $videoIds;
// }
