<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderCancelRequest;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function indexData()
    {

        $orders = Order::all();
        // dd($orders[0]->user->name);
        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('customer_name', function ($order) {
                return $order->user->name;
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }
    public function update(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        if ($request->has('delivery_man_id') && !empty($request->delivery_man_id)) {

            $order->delivery_man_id = $request->delivery_man_id;
        } else {

            $order->delivery_man_id = null;
        }

        $order->save();

        return redirect()->route('orders.all')->with('success', 'Order updated successfully!');
    }
    public function getOrder($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    public function all()
    {
        return view('Admin.order.all');
    }
    public function pendingData()
    {

        $orders = Order::where('order_status', 0)->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }

    public function pending()
    {

        return view('Admin.order.pending');
    }
    public function progressData()
    {

        $orders = Order::where('order_status', 1)->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }

    public function progress()
    {
        return view('Admin.order.progress');
    }
    public function shippedData()
    {

        $orders = Order::where('order_status', 2)->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }
    public function shipped()
    {
        return view('Admin.order.shipped');
    }
    public function deliveredData()
    {

        $orders = Order::where('order_status', 3)->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }
    public function delivered()
    {
        return view('Admin.order.delivered');
    }
    public function cancelData()
    {

        $orders = Order::where('order_status', 4)->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Shipped';
                    case 3:
                        return 'Delivered';
                    case 4:
                        return 'Cancel';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }
    public function cancel()
    {
        return view('Admin.order.cancel');
    }
    public function cashData()
    {

        $orders = Order::where('payment_method', 'cod')->get();

        return DataTables::of($orders)
            ->editColumn('payment_status', function ($order) {
                return $order->payment_status == 1 ? 'Success' : 'Pending';
            })
            ->editColumn('order_status', function ($order) {
                switch ($order->order_status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'In Progress';
                    case 2:
                        return 'Delivered';
                    case 3:
                        return 'Completed';
                    case 4:
                        return 'Declined';
                    default:
                        return 'Unknown';
                }
            })
            ->make(true);
    }
    public function cashONDelivery()
    {
        return view('Admin.order.cash_on_delivery');
    }

    public function show($id)
    {
        $order = Order::with('payment')->find($id);
        $user = $order->user; // Assuming the `user` relationship is set up

        $billingAddress = Addresses::getBillingAddress($user->id);
        $shippingAddress = Addresses::getShippingAddress($user->id);

        // If no shipping address exists, use the billing address
        if (!$shippingAddress) {
            $shippingAddress = $billingAddress;
        }

        return view('Admin.order.show', compact('order', 'billingAddress', 'shippingAddress'));
    }

    public function read_one($id)
    {
        $notify = Notification::find($id);
        $notify->read_at = Carbon::now();
        $notify->save();

        return redirect()->route('orders.all');
    }

    public function read_all()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $order_Notification = $unreadNotifications->filter(function ($notification) {
            return $notification->type == 'App\Notifications\OrderNotification';
        });
        $order_Notification->markAsRead();
        return redirect()->back();
    }

    public function orderCancelRequest()
    {
        

       return view('Admin.order.order_cancel_request');
    }

    public function orderCancelRequestData()
    {

        $order_cancel_request = OrderCancelRequest::all();
        // dd($orders[0]->user->name);
        return DataTables::of($order_cancel_request)
        
            ->make(true);
    }
}
