<?php

namespace App\Http\Controllers\API\Otithee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class AgentApiController extends Controller
{

    public function agent_api(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        $phone = $_GET['phone'];
        if (!$phone || empty($phone)) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Phone number is required']);
            exit;
        }
        
        $apiUrl = "https://otithee.com/api/OEMSAGENTINFO?phone=" . $phone;

        $response = file_get_contents($apiUrl);
        if ($response === false) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to retrieve data from the API']);
            exit;
        }
        
        header('Content-Type: application/json');
        $data = json_decode($response);
        
        if (empty($data)) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'No data found for the given phone number']);
            exit;
        }
        
        // If data is found, return it as is
        return $response;
        
        }

}
