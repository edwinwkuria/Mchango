<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaB2cController extends Controller
{
   public function Withdraw(Request $request){

        $ConsumerKey = config('mpesaconfigs.ConsumerKey');
        $ConsumerSecret = config('mpesaconfigs.ConsumerSecret');
    
        $Headers =['Content-Type:application/json; charset=utf8'];
    
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $Headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $ConsumerKey.":".$ConsumerSecret);
    
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $Result = json_decode($result);
        $accesstoken = $Result->access_token;
        //echo $accesstoken;
    /*Variables*/
    
        $InitiatorName ='apiop29'; 
        $SecurityCredential ='jRxOmTOo1WlBl3BpO/45CqO7i5BlUv8hrSbXOeh5LQ5zfFqZ48WVFajYApbvOB8pTsJcnKv1o8B2kV59qkNyznNZ2mTz5qTerPv9gBQd9Yr6xyVEme4ra85c/O5lA3lizXAMzhfE+1HxKtk/tWhaFOOxA4ZK/B5bhWpJcL3lsgAEMv4pYVD/XBPS+8nZTE8OxAznzNYty9coNjR82FYGo8gmxz7c1EMkrVkGbZW4AMF48mK+bBSW70DGRQUvVszAaUpE5Dq7yWYghI4GEyw2IEtABnwETb76rrjHKNY2UZ5pxI9hOPFqbO0Rw3KiRhcJ2rJRzv9ZYcnYukEUXhiADA==';
        $CommandID ='BusinessPayment';
        $Amount = $request.amount;
        $PartyA = config('mpesaconfigs.ShortCode');
        $PartyB = $request.MSISDN;
        $Remarks = config('mpesaconfigs.WithdrawMessage');
        $QueueTimeOutURL ='https://lovely-liger-24.localtunnel.me/mpesaAPI/lipacallback.php';
        $ResultURL ='https://lovely-liger-24.localtunnel.me/mpesaAPI/lipacallback.php';
        $Occasion ='June Salary';
    
    /*Main request*/
    $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $b2c_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer H28vJgb3bMCJMtVWJxGg4I2oFjb4')); //setting custom header
    
    
    $curl_post_data = array(
        //Fill in the request parameters with valid values
        'InitiatorName' => $InitiatorName,
        'SecurityCredential' => $SecurityCredential,
        'CommandID' => $CommandID,
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $PartyB,
        'Remarks' => $Remarks,
        'QueueTimeOutURL' => $QueueTimeOutURL,
        'ResultURL' => $ResultURL,
        'Occasion' => $Occasion
    );
    
    $data_string = json_encode($curl_post_data);
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
   }
}
