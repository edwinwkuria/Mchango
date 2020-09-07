<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Fundraiser;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class MpesaC2bController extends Controller
{
    public function registerUrl(){
    
    //Get access token 
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
	$result = json_decode($result);
	$access_token = $result->access_token;

    //register url 
    $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


    $curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => config('mpesaconfigs.ShortCode'),
    'ResponseType' => config('mpesaconfigs.ResponseType'),
    'ConfirmationURL' => config('mpesaconfigs.ConfirmationURL'),
    'ValidationURL' => config('mpesaconfigs.ValidationURL')
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    return $curl_response;

    //return view ('welcome');
    }
    public function B2Cvalidation(Request $request){
        $successresponse = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';
        $failureresponse = '{
        "ResultCode": 1,
        "ResultDesc": "Transaction could not be completed"
        }';
        $notfoundresponse = '{
            "ResultCode": 1,
            "ResultDesc": "Fundraiser does not exist"
            }';
        //Log request details
        $logresponse = $request['BillRefNumber'] ."|". 
                        $request['MSISDN'] ."|".
                        $request['TransID'] ."|".
                        $request['TransAmount'] ."|".
                        $request['TransTime'] ."|".
                        $request['BusinessShortCode'] ."|".
                        $request['FirstName'] . $request['LastName']."|";
        Storage:: disk('local')->append('validation.txt', $logresponse);
        //confirm if fundraiser exists and is active
        $fundraiser = Fundraiser::where('accountNumber', $request['BillRefNumber'])->first();
        if($fundraiser != null){
            if($fundraiser->isActive){
                $response = json_decode($successresponse);
            }else{
                $response = json_decode($failureresponse);
            }
        }else{
            $response = json_decode($notfoundresponse);
        }

        return response()->json($response, 200);
    }

    public function B2Cconfirmation(Request $request){
        $successresponse = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';
        //write transaction details to text file
        $logresponse = $request['BillRefNumber'] ."|". 
                        $request['MSISDN'] ."|".
                        $request['TransID'] ."|".
                        $request['TransAmount'] ."|".
                        $request['TransTime'] ."|".
                        $request['BusinessShortCode'] ."|".
                        $request['FirstName'] . $request['LastName']."|". 
                        $request['OrgAccountBalance'];
        Storage:: disk('local')->append('confirmation.txt', $logresponse);


        //validate the transaction details is verify paybill number and accountNumber
        $fundraiser = Fundraiser::where('accountNumber', $request['BillRefNumber'])->first();
        if($fundraiser != null){
                //update the relevant fundraiser amount and number of contributors
                $newAmountRaised = $fundraiser['amountRaised'] + $request['TransAmount'];
                $newNumberOfContributors = $request['numberOfContributors'] + 1;
                $update = Fundraiser::where('id', $fundraiser->id)->update([
                    "amountRaised" => $newAmountRaised,
                    "numberOfContributors" => $newNumberOfContributors,
                ]);
        }
        
        //save the transaction details to a database 
        Transaction::create([
            'accountNumber' => $request['BillRefNumber'],
            'phoneNumber'   => $request['MSISDN'],
            'transID'  => $request['TransID'],
            'transAmount' => $request['TransAmount'],
            'transTime' => $request['TransTime'],
            'paybill' => $request['BusinessShortCode'],
            'fullName' => $request['FirstName'] . $request['LastName'],
            'organizationAccountBalance' => $request['OrgAccountBalance'],
        ]);
        //response
        return response()->json($successresponse, 200);

    }


}
