<?php

namespace App\Repositories;

use App\Jobs\IncrementVisitsCount;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\ShortenLink;
use App\Repositories\Interfaces\ShortenLinkRepositoryInterface;
use DB;

class ShortenLinkRepository implements ShortenLinkRepositoryInterface
{
    public function storeData($request)
    {
        $input['long_link'] = $request->long_link;
        $input['code'] = Str::random(6);

        return ShortenLink::create($input);
    }

    public function findData($code)
    {
        $findShortLink = ShortenLink::where('code', $code)->first();
        return $findShortLink ?? false;
    }

    public function incrementVisitsByQueue($code)
    {
        $incrementVisits = (new IncrementVisitsCount($code))
            ->delay(Carbon::now()
                ->addSeconds(1));
        dispatch($incrementVisits);

        return $incrementVisits ?? false;
    }
}