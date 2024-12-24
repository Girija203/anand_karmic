<?php

namespace App\Http\Controllers;

use App\Models\OrderCancelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderCancelController extends Controller
{
    public function cancelRequest(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'order_id' => $request->order_id,
            'reason' => $request->reason,
        ];
        // dd($data);
        OrderCancelRequest::create($data);
        return redirect()->back()->with('success', 'Your request send to Karmic Admin successfully');
    }
}
