<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function dashboard()
     {
        $productCount = Product::count();
        $orderCount = Order::count();
        $userCount = User::count();
        $subscriberCount =Subscriber::count();
        return view ('Admin.dashboard',compact('productCount','orderCount','userCount', 'subscriberCount'));

    }
}
