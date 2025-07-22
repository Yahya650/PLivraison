<?php

use GuzzleHttp\Client;
use App\Models\Formation;
use Illuminate\Support\Carbon;
use App\Models\FormationCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


include 'youtube.php';
include 'crypt.php';
include 'admin_dashboard.php';
include 'search.php';

function generateCustomId(int $modelId, string $prefix = 'I', int $startFrom = 50): string
{
    $customNumber = $modelId + ($startFrom - 1); // So ID 1 becomes 50
    return strtoupper($prefix) . $customNumber . date('my');
}

function calculateDiscountPercentage($price, $comparePrice): ?float
{
    // Prevent division by zero
    if (!$comparePrice || $comparePrice == 0) {
        return null;
    }

    $discount = (($comparePrice - $price) / $comparePrice) * 100;

    return round($discount, 2); // e.g., 12.34%
}


function countries()
{
    // dd(json_decode(file_get_contents(public_path("/data/countries.json")))[0]->translations);
    return json_decode(file_get_contents(public_path("/data/countries.json")));
}


function getNextYearBeforeThreeMonth()
{
    Carbon::setLocale('fr');

    $currentDate = Carbon::now();
    $lastThreeMonthsStart = Carbon::create($currentDate->year, 10, 1); // October 1st
    $yearToDisplay = $currentDate->greaterThanOrEqualTo($lastThreeMonthsStart)
        ? $currentDate->year + 1
        : $currentDate->year;

    return $yearToDisplay;
}


function clearStorageFolder($folderName)
{
    $disk = Storage::disk('public'); // Change 'public' to the desired disk configuration

    if ($disk->exists($folderName)) {
        $disk->deleteDirectory($folderName); // Deletes the directory and its contents
        $disk->makeDirectory($folderName);  // Recreates the empty directory
    }
}

function saveImageFromUrl($imageUrl, $small_name)
{
    // Get the image content
    $imageContent = file_get_contents($imageUrl);

    // Generate a unique name for the image
    $imageName = 'country_flags/' . $small_name . '.png';

    // Store the image in the storage folder (public disk in this case)
    Storage::disk('public')->put($imageName, $imageContent);

    // Return the path of the stored image
    return Storage::url($imageName);
}




function extractNumber($string)
{
    // Use a regular expression to extract numbers
    preg_match('/\d+/', $string, $matches);

    // Return the number if found, otherwise return null
    return $matches[0] ?? null;
}





// function extractFirstPageAsPng($pdfPath, $outputPath)
// {
//     try {
//         // Create an Imagick instance and load the PDF (first page only)
//         $imagick = new Imagick();
//         $imagick->setResolution(300, 300); // Set resolution for better quality
//         $imagick->readImage(storage_path("app/public/$pdfPath") . '[0]'); // First page only
//         $imagick->setImageFormat('png'); // Set format to PNG

//         // Save the output image to the specified path
//         $outputFullPath = storage_path("app/public/$outputPath");
//         Storage::disk('public')->makeDirectory(dirname($outputPath)); // Ensure directory exists
//         $imagick->writeImage($outputFullPath);

//         // Clear Imagick resources
//         $imagick->clear();
//         $imagick->destroy();

//         return true; // Successfully created the image
//     } catch (\Exception $e) {
//         // Log the error and return false
//         \Log::error("Error extracting PDF first page: " . $e->getMessage());
//         return false;
//     }
// }


// function generateCustomCodeForFormation($categoryId)
// {
//     $category = FormationCategory::find($categoryId);
//     if (!$category) {
//         return null;
//     }

//     $categoryCode = $category->code;
//     $maxCategoryCount = Formation::where('category_id', $categoryId)->count() + 1;
//     if ($maxCategoryCount == 2) {
//         dd($maxCategoryCount);
//     }
//     return $categoryCode . str_pad($maxCategoryCount, 2, "0", STR_PAD_LEFT);
// }

// function generateCustomCodesForFormations()
// {
//     $formations = Formation::whereNull('custom_id')->get(); // Get formations without custom_id

//     DB::transaction(function () use ($formations) {
//         foreach ($formations as $formation) {
//             $customId = generateCustomCodeForFormation($formation->category_id);

//             // Assign a unique custom_id
//             $formation->update(['custom_id' => $customId]);
//         }
//     });
// }



// function generateCustomCodeForFormation($categoryId)
// {
//     $category = FormationCategory::find($categoryId);
//     if (!$category) {
//         return null;
//     }

//     $categoryCode = $category->code;

//     // Get the highest existing number for this category
//     $maxExisting = Formation::where('category_id', $categoryId)
//         ->where('custom_id', 'LIKE', "{$categoryCode}%")
//         ->selectRaw("CAST(SUBSTRING(custom_id, LENGTH(?) + 1) AS UNSIGNED) as num", [$categoryCode])
//         ->orderByDesc('num')
//         ->value('num');

//     $newNumber = $maxExisting ? $maxExisting + 1 : 1;

//     return $categoryCode . str_pad($newNumber, 2, "0", STR_PAD_LEFT);
// }



function fetchVideoData($videoId)
{
    $client = new Client();
    $apiKey = env('YOUTUBE_API_KEY');
    $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id=$videoId&key=$apiKey";

    try {
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);
        $video = $data['items'][0]; // First result
        // dd($video);
        return [
            'published_at' => $video['snippet']['publishedAt'],
            'title' => $video['snippet']['title'],
            'description' => $video['snippet']['description'],
            'views' => $video['statistics']['viewCount'],
            'likes' => $video['statistics']['likeCount'],
            'thumbnail' => $video['snippet']['thumbnails']['maxres']['url'],
            'tags' => json_encode($video['snippet']['tags']),
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
function fetchAllFormations()
{
    $client = new Client();

    $url = env('CIFPRO_BASEURL') . "api/formations";

    $response = $client->get($url, [
        "headers" => [
            "Accept" => "application/json",
            "Authorization" => env("CIFPRO_SANCTUM_TOKEN")
        ]
    ]);

    $responseBody = $response->getBody()->getContents();

    return json_decode($responseBody, true);
}
function fetchAllParticipants()
{
    $client = new Client();

    $url = env('CIFPRO_BASEURL') . "api/formations";

    $response = $client->get($url, [
        "headers" => [
            "Accept" => "application/json",
            "Authorization" => env("CIFPRO_SANCTUM_TOKEN")
        ]
    ]);

    $responseBody = $response->getBody()->getContents();

    return json_decode($responseBody, true);
}

function formatPrice($price)
{
    return number_format($price, 2, ',', '.');
}



function Dha($additions = []): array
{
    // $has_extra_args = array_key_exists('search', $additions);

    $has_extra_args = true;
    $default_http = [
        'inscription_id' => request()->inscription_id,
    ];

    foreach ($additions as $name => $addition) {
        $default_http[$name] = $addition;
    }

    if ($has_extra_args) {
        foreach (request()->all() as $name => $addition) {
            if ($name != 'filter') {
                $default_http[$name] = $addition;
            }
        }
    }

    return $default_http;
}
