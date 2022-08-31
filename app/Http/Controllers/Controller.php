<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PG_NUM = 30;

    #[ArrayShape(['error' => "string"])]
    protected function getExceptionMsg(\Exception $exception): array
    {
        $msg = $exception->getMessage();
        if (env('APP_ENV') == 'production') {
            $msg = 'An error occurred';

            Log::error($exception->getMessage() . "\n");
        }

        return ['error' => $msg];
    }
}
