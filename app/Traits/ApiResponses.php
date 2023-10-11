<?php

namespace App\Traits;

use Illuminate\Http\Response;
/**
 * Trait to respond with HTTP status
 */
Trait ApiResponses
{
    /**
     * Common response for all API
     * @param int $code
     * @param mixed $data
     * @param mixed $message
     * @param int $count
     * @return \Illuminate\Http\JsonResponse
     */
    public static function apiResponse($data=null, $code, $message=null, $count=0)
    {
        $response = [
            'status' => $code == (Response::HTTP_OK || Response::HTTP_CREATED ) ? 'success' : 'failed',
            'data' => !is_null($data)  ? $data : [],
            'message' => $message == null ? [] : $message,
            'count' => $count,
        ];
        return Response()->json($response, $code);
    }

    /**
     * Common response for all Validator
     * @param int $code
     * @param mixed $data
     * @param mixed $message
     * @param int $count
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validatorErrorResponse($code, $errors=null)
    {
        if (is_object($errors)) {
           $errors = self::responseErrorGenerator($errors);
        }
        $message = 'Oops! Something went wrong.';
        $status = 'failed';
        $response = [
            'status' => $status,
            'error' => $errors === null ? [] : $errors,
            'message' => $message == null ? [] : $message,
        ];

        return Response()->json($response, $code);
    }


    private static function responseErrorGenerator($errors)
    {
        $response = [];
        
        $validatorArray = array_map( 'self::validatorArrayGenerator',$errors->keys(), $errors->all());

        foreach($validatorArray as $error) {
            $response = array_merge($response, $error);
        }

        return $response;
    }

    private static function validatorArrayGenerator($errorKey, $errorValue)
    {
        return array($errorKey => $errorValue);
    }
}