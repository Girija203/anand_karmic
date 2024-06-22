<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index(){

        $terms=TermsAndCondition::first();
        return view('Admin.termsandcondition.index',compact('terms'));
    }

    public function store( Request $request){

        $request->validate([

            'terms_and_condition'=>'required'
        ]);

        $terms=TermsAndCondition::first();

        if(!$terms){

            $terms=new TermsAndCondition();

        }

        $terms->terms_and_condition=$request->input('terms_and_condition');
        $terms->save();

        return redirect()->back()->with('success','successfully created');

    }
}
