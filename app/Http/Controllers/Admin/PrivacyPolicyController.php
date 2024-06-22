<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(){

        $privacy=PrivacyPolicy::first();
        return view('Admin.privacypolicy.index',compact('privacy'));
    }

    public function store( Request $request){

        $request->validate([

            'privacy_policy'=>'required'
        ]);

        $privacy=PrivacyPolicy::first();

        if(! $privacy){

            $privacy=new PrivacyPolicy();

        }

        $privacy->privacy_policy=$request->input('privacy_policy');
        $privacy->save();

        return redirect()->back()->with('success','successfully created');

    }
}
