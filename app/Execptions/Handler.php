<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof QueryException) {

            $code = $e->getCode();

            if ($code == 1205) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This resource is currently locked, try again.'
                ], 423);
            }

            if ($code == 1213) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Conflict occurred, please try again.'
                ], 409);
            }
        }

        return parent::render($request, $e);
    }
}