<?php

namespace App\Repositories\Interfaces;


interface ShortenLinkRepositoryInterface
{
    public function storeData($request);

    public function findData($code);

    public function incrementVisitsByQueue($code);
}