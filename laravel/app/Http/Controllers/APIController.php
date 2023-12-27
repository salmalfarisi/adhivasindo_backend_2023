<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function Finddata(Request $request)
	{
		$listarray = [];
		$client = new \GuzzleHttp\Client();
		$url = $client->get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');
		
		$response = json_decode($url->getBody()->getContents());
		$convertdata = explode("\n",$response->DATA);
		
		for($i = 1; $i < count($convertdata); $i++)
		{
			$convertlagi = explode("|",$convertdata[$i]);
			if(count($convertlagi) == 3)
			{
				$tempobj = new \stdClass();
				foreach($convertlagi as $setdata)
				{
					$cektype = intval($setdata);
					
					if($cektype == 0)
					{
						$tempobj->NAMA = $setdata;
					}
					else
					{
						$panjangdata = strlen($setdata);
						if($panjangdata == 8)
						{
							$tempobj->YMD = $setdata;
						}
						else
						{
							$tempobj->NIM = $setdata;
						}
					}
				}
				array_push($listarray, $tempobj);				
			}
		}
		$result = $listarray;
	}
}
