<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Training;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = Customer::find(decrypt($id));
        $orders = $profile->orders()->orderBy('created_at')->get();
        $trainings = json_decode($profile->trainings(),true);
        $trainings_past = json_decode($profile->trainingsPast());
        $races = json_decode($profile->futureRaces());
        $races_past = json_decode($profile->pastRaces());

        return view('profile.base', [
            'profile' => $profile,
            'orders' => $orders,
            'trainings'=>$trainings,
            'trainings_past'=>$trainings_past,
            'races'=>$races,
            'races_past'=>$races_past
            ]);
    }
}
