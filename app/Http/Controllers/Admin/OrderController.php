<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function indexData()
    {

        $orders = Order::all();

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

    public function progress()
    {
        return view('Admin.order.progress');
    }
    public function deliveredData()
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
    public function delivered()
    {
        return view('Admin.order.delivered');
    }
    public function completedData()
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
    public function completed()
    {
        return view('Admin.order.completed');
    }
    public function declinedData()
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
    public function declined()
    {
        return view('Admin.order.declined');
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
        $order = Order::find($id);
        return view('Admin.order.show', compact('order'));
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
}
