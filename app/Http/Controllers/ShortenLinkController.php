<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ShortenLinkRepositoryInterface;
use Request;


class ShortenLinkController extends Controller
{
    private $shortLinkRepository;

    public function __construct(ShortenLinkRepositoryInterface $shortLinkRepository)
    {
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Redirect original long link when clicking generated shorten link.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $findShortLink = $this->shortLinkRepository->findData($code);

        $redirect = redirect($findShortLink->long_link);
        if ($redirect) {
            $this->shortLinkRepository->incrementVisitsByQueue($code);
        } else {
            $redirect = redirect('/');
        }
        return $redirect;
    }
}
