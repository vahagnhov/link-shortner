<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ShortenLinkRepositoryInterface;
use Illuminate\Http\Request;

class ShortenLinkController extends Controller
{
    private $shortLinkRepository;

    public function __construct(ShortenLinkRepositoryInterface $shortLinkRepository)
    {
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'long_link' => 'required|url'
        ]);

        $shortLink = $this->shortLinkRepository->storeData($request);

        return response()->json($shortLink, 200);

    }
}
