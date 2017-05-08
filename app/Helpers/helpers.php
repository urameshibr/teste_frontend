<?php

if(!function_exists('json_response')){
    /**
     * @param bool $status
     * @param int $code
     * @param null $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    function json_response($status = true, $code = 200, $message = null, $data = null){
        if(!$status){
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => $message
            ],404);
        }
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => $message,
            'data' => $data
        ],200);
    }
}