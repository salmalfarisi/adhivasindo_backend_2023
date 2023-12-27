<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($success, $data = [], $message)
    {
    	$response = [
            'success' => $success,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
	
	/**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [])
    {
		$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
		
        return response()->json($response, 400);
    }
	
	public function handlingErrorCatch($data)
	{
		$message = [];
		$string = '';
		$cek = is_array($data);
		if($cek == true)
		{
			$string = 'Error while process data';
			foreach($data as $messageerror)
			{
				array_push($message, $messageerror);
			}
		}
		else
		{
			$string = $data;
		}
		
		return $this->sendError($string, $message);
	}
}
