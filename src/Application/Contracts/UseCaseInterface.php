<?php

namespace App\Application\Contracts;

interface UseCaseInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function run($request);
}
