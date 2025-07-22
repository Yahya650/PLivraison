<?php

use App\Models\Country;
use App\Models\Participant;
use Illuminate\Support\Carbon;

function analysCountries($time = null)
{

    switch ($time) {
        case 'TODAY':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereDate('created_at', Carbon::today())
                    ->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereDate('created_at', Carbon::today())
                    ->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        case 'YESTERDAY':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereDate('created_at', Carbon::yesterday())
                    ->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereDate('created_at', Carbon::yesterday())
                    ->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        case 'LAST7DAYS':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                    ->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                    ->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        case 'LAST30DAYS':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
                    ->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
                    ->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        case 'CURRENTMONTH':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        case 'LASTMONTH':
            $countries = Country::whereHas('participants', function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth(),
                ])->where('is_completed', true);
            })->withCount(['participants' => function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth(),
                ])->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;

        default:
            // Fetch all countries with only completed participants
            $countries = Country::withCount(['participants' => function ($query) {
                $query->where('is_completed', true);
            }])
                ->orderBy('participants_count', 'desc')
                ->get();
            break;
    }


    // Calculate total participants for percentage normalization
    $totalParticipants = $countries->sum('participants_count');

    // Add percentage property to each country and limit to 2 decimal places
    if ($totalParticipants > 0) {
        foreach ($countries as $country) {
            $country->percentage = number_format(($country->participants_count / $totalParticipants) * 100, 2);
        }
    } else {
        foreach ($countries as $country) {
            $country->percentage = 0;
        }
    }

    // Sort by percentage and take the top 4 countries
    $topCountries = $countries->sortByDesc('percentage')->take(4);

    // Get the remaining countries (excluding the top 4) and sort by participant count
    $countries = $countries->reject(function ($country) use ($topCountries) {
        return $topCountries->contains($country);
    })->sortByDesc('participants_count')->take(4);


    return [
        "topCountries" => $topCountries,
        "countries" => $countries
    ];
}


function analysGenders($time = null)
{

    // request()->time ? dd($time) : null;

    switch ($time) {
        case 'TODAY':
            // Fetch participants created today and completed
            $participants = Participant::whereDate('created_at', Carbon::today())
                ->where('is_completed', true)
                ->get();
            break;

        case 'YESTERDAY':
            // Fetch participants created yesterday and completed
            $participants = Participant::whereDate('created_at', Carbon::yesterday())
                ->where('is_completed', true)
                ->get();
            break;

        case 'LAST7DAYS':
            // Fetch participants created in the last 7 days and completed
            $participants = Participant::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                ->where('is_completed', true)
                ->get();
            break;

        case 'LAST30DAYS':
            // Fetch participants created in the last 30 days and completed
            $participants = Participant::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
                ->where('is_completed', true)
                ->get();
            break;

        case 'CURRENTMONTH':
            // Fetch participants created in the current month and completed
            $participants = Participant::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->where('is_completed', true)
                ->get();
            break;

        case 'LASTMONTH':
            // Fetch participants created in the last month and completed
            $participants = Participant::whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])
                ->where('is_completed', true)
                ->get();
            break;

        default:
            // Fetch all completed participants
            $participants = Participant::where('is_completed', true)->get();
            break;
    }


    // Calculate total participants
    $totalParticipants = $participants->count();

    // Group participants by gender (assuming 'gender' is a column: e.g., 'male', 'female')
    $genderGroups = $participants->groupBy('gender');

    if ($totalParticipants > 0) {

        // Add to the analysis result
        return [
            [
                'gender' => 'male',
                'count' => $genderGroups->has('male') ? $genderGroups['male']->count() : 0,
                'percentage' => $genderGroups->has('male') ? number_format(($genderGroups['male']->count() / $totalParticipants) * 100, 2) : 0
            ],
            [
                'gender' => 'female',
                'count' => $genderGroups->has('female') ? $genderGroups['female']->count() : 0,
                'percentage' => $genderGroups->has('female') ? number_format(($genderGroups['female']->count() / $totalParticipants) * 100, 2) : 0
            ]
        ];
    } else {
        return [
            [
                'gender' => 'male',
                'count' => 0,
                'percentage' => 0
            ],
            [
                'gender' => 'female',
                'count' => 0,
                'percentage' => 0
            ]
        ];;
    }
}
