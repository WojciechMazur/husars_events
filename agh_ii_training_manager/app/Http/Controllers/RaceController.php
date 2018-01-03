<?php

namespace App\Http\Controllers;

use App\Race;
use App\RaceHeat;
use App\RaceRegistration;
use http\Env\Response;
use Illuminate\Http\Request;

class RaceController extends Controller
{

    public function raceRegistration(Request $request){
        $competitors=Race::find($request['race_id'])->signed_in();
        $registered=false;
        foreach ($competitors as $competitor){
            if($competitor->id==$request['customer_id']){
                $registered=true;
                break;
            }
        }
        if(!$registered) {
            $heat=RaceHeat::find($request['heat_id']);
            if($heat->signed_in >= $heat->capacity){
                return response()->json(['success' => false, 'message'=>'Selected heat is full. Try to register for another one']);
            }
            $registration = new RaceRegistration();
            $registration->customer_id = $request['customer_id'];
            $registration->race_heat_id = $request['heat_id'];
            $registration->save();

            $heat->signed_in++;
            $heat->save();
            return response()->json(['success' => true, 'message'=>'Registered successfully']);
        }
        return response()->json(['success' => false, 'message'=>'Already registered for this race']);
    }

    public function raceRegistrationCancel($id){
        $registration= RaceRegistration::find($id);
        $heat = RaceHeat::find($registration->race_heat_id);
        $heat->signed_in--;
        $heat->save();
        return RaceRegistration::destroy($id);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Race::all()->sortBy('name');
        return view('models.races.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Race|Race[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        $race = Race::find($id);
        $race->heats=$race->heats();
        return $race;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
