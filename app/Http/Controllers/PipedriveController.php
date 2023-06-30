<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PipedriveController extends UserDataController
{
    protected $api_token = "f1e2c619c0b5b54ac7985c73c9442b02e01f0dc9";
    protected $company_domain = 'dbagmbh';
    public $result = Array();

    protected function request($url, $data = Array(), $request = 'GET') //$url = PD API URL | $request = GET / = POST (new data) / = PUT (update data) | $data = Array 
    {

	// GET request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // POST request (adds following lines)
    if ($request == 'POST'){
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    // PUT request (adds following lines)
    if ($request == 'PUT'){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

	//echo 'Sending request...' . PHP_EOL;
	
	$output = curl_exec($ch);
	curl_close($ch);

    $this->result = json_decode($output, true);

    }

	public function deal($deal_id, $data = Array(), $request = 'GET'){  
        $url = 'https://' . $this->company_domain . '.pipedrive.com/api/v1/deals/' . $deal_id . '?api_token=' . $this->api_token;
        $this->request($url, $data, $request);
	}

    public function person($person_id, $data = Array(), $request = 'GET'){  
        $url = 'https://' . $this->company_domain . '.pipedrive.com/api/v1/persons/' . $person_id . '?api_token=' . $this->api_token;
        $this->request($url, $data, $request);
	}
    
    public function orga($orga_id, $data = Array(), $request = 'GET'){  
        $url = 'https://' . $this->company_domain . '.pipedrive.com/api/v1/organizations/' . $orga_id . '?api_token=' . $this->api_token;
        $this->request($url, $data, $request);
	}
}
