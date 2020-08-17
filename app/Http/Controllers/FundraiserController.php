<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Fundraiser;
use Illuminate\Http\Request;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('fundraiser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $year = $this->switchYear($date->year);
        $month = $this->switchMonth($date->month);
        $accountNumber = $year.$month.rand(100000,999999);
        //dd($accountNumber);
        Fundraiser::create([
            'userID' => $request['number'],
            'name'   => $request['name'],
            'description'  => $request['description'],
            'accountNumber' => $accountNumber,
            'isActive' => true,
            'target' => $request['target'],
            'amountRaised' => 0,
            'numberOfContributors' => 0,
        ]);

        return redirect ('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraiser $fundraiser)
    {
        
        $update = Fundraiser::where('id', $fundraiser->id)->update([
            "isActive" => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fundraiser  $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser)
    {
        //
    }
    /**
     * Switches the Year to add to the random String
     * @param \Carbon->year $year
     * @return Year Character
     */
    public function switchYear($year)
    {
        switch($year){
            case 2020:
                return 'A';
            break;
            case 2021:
                return 'B';
            break;
            case 2022:
                return 'C';
            break;
            case 2023:
                return 'D';
            break;
            case 2024:
                return 'E';
            break;
            case 2025:
                return 'F';
            break;
        }
    }

    /**
     * Switches the Year to add to the random String
     * @param \Carbon->year $year
     * @return Year Character
     */
    public function switchMonth($year)
    {
        switch($year){
            case 1:
                return 'A';
            break;
            case 2:
                return 'B';
            break;
            case 3:
                return 'C';
            break;
            case 4:
                return 'D';
            break;
            case 5:
                return 'E';
            break;
            case 6:
                return 'F';
            break;
            case 7:
                return 'G';
            break;
            case 8:
                return 'H';
            break;
            case 9:
                return 'J';
            break;
            case 10:
                return 'K';
            break;
            case 11:
                return 'L';
            break;
            case 12:
                return 'M';
            break;
        }
    }
}
