<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JetBrains\PhpStorm\ArrayShape;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PG_NUM = 30;

    #[ArrayShape(['error' => "string"])]
    protected function getExceptionMsg(\Exception $exception): array
    {
        $msg = env('APP_ENV') == 'local' ? $exception->getMessage() : 'An error occurred, please try again!';

        return ['error' => $msg];
    }
}
