<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Trainer;
use App\Training;
use App\TrainingReservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return TrainingReservation|Response|int
     */
    public function getTrainingReservations(Request $request){
        $query = DB::table('training_reservations')
            ->join('customers', 'customers.id', "=", 'training_reservations.customer_id')
            ->join('trainings', 'trainings.id', "=", 'training_reservations.training_id')
            ->select('training_reservations.*', 'trainings.date', 'trainings.location', 'trainings.capacity_limit', 'trainings.signed_in',
                      'customers.id as customer_id', 'customers.first_name', 'customers.surname', 'customers.email');

        if($request['training_id']!="*")
            $query= $query->where('training_reservations.training_id', '=', $request['training_id']);
        if($request['customer_id']!="*")
            $query= $query->where('training_reservations.customer_id', '=', $request['customer_id']);
        return $query->get();
    }

    public function addTrainingReservation(Request $request){
        $oldReservation = DB::table('training_reservations')
            ->where('training_id', '=', $request['training_id'])
            ->where('customer_id', '=', $request['customer_id'])
            ->select('training_reservations.*')
            ->first();

        if(!empty($oldReservation)){
            return Response::HTTP_ALREADY_REPORTED;
        }

        $training = Training::find($request['training_id']);
        if($training['signed_in'] <= $training['capacity_limit']){
            $training['signed_in']+=1;
            $training->save();
            $reservation = new TrainingReservation();
            $reservation['training_id']=$request['training_id'];
            $reservation['customer_id']=$request['customer_id'];
            $reservation->save();
            return $reservation;
        }
        else
            return Response::HTTP_NOT_MODIFIED;
    }

    public function deleteTrainingReservation($id){
        $reservation=TrainingReservation::find($id);
        $training = $reservation->training()->first();
        $training['signed_in']= ($training['signed_in']>1) ? $training['signed_in']-1 : 0;
        $training->save();
        return TrainingReservation::destroy($id);
    }

    public function index(Request $request)
    {
        $items = Training::all();
        foreach ($items as $item){
            $item['trainer_details']=Trainer::find($item['trainer_id']);
        }
        if($request['api']){
            return $items;
        }
        return view('models.trainings.index')->with('items',$items);
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
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Training::find($id);
        $item['trainer_details']=Trainer::find($item['trainer_id']);
        return $item;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return Response|int
     */
    public function destroy($id)
    {
       return Training::destroy($id);
    }
}
