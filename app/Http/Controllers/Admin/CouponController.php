<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\User;
use App\Models\UserCoupon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{

    public function index()
    {
        $coupon_type = CouponType::get();
        return view('Admin.coupon.index', compact('coupon_type'));
    }


    public function indexData()
    {

        $coupons = Coupon::with('couponType')->get();

        return DataTables::of($coupons)
        ->editColumn('status', function ($coupon) {
            return $coupon->status ? 'Active' : 'Inactive';
        })
            ->addColumn('coupon_type_name', function ($coupon) {
                return $coupon->couponType ? $coupon->couponType->name : 'N/A';
            })
        ->make(true);
    }

    public function create()
    {
        $users = User::all();
        return view('Admin.coupon.create', compact('users'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'minimum_purchase_price' => 'required',
        ]);

        $coupon = new Coupon;
        $coupon->name = $request->input('name');
        $coupon->code = $request->input('code');
        $coupon->start_date = $request->input('start_date');
        $coupon->end_date = $request->input('end_date');
        $coupon->minimum_purchase_price = $request->input('minimum_purchase_price');
        $coupon->discount_type = $request->input('discount_type');
        $coupon->discount_value = $request->input('discount_value');
        $coupon->usage_limit = $request->input('usage_limit');
        $coupon->coupon_type_id = $request->input('coupon_type_id');
        $coupon->save();

        $selectet_userList = $request->input('selectet_userList');
        if ($selectet_userList) {
            foreach ($selectet_userList as $userId) {
                $user_coupon = new UserCoupon;
                $user_coupon->user_id = $userId; // Ensure user_id is set correctly
                $user_coupon->coupon_id = $coupon->id;
                $user_coupon->save();
            }
        }

        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully!');
    }
    // public function edit($id)
    // {
    //     $coupon = Coupon::find($id);
    //     return view('Admin.coupon.edit', compact('coupon'));
    // }


    public function update(Request $request, $id)
    {

        // dd($request);
        $request->validate(['name' => 'required', 'code' => 'required',

        ]);

        $coupon = Coupon::find($id);
        $coupon->name = $request->input('name');
        $coupon->code = $request->input('code');
        $coupon->start_date = $request->input('start_date');
        $coupon->end_date = $request->input('end_date');
        $coupon->minimum_purchase_price = $request->input('minimum_purchase_price');
        $coupon->discount_type = $request->input('discount_type');
        $coupon->discount_value = $request->input('discount_value');
        $coupon->usage_limit = $request->input('usage_limit');
        $coupon->coupon_type_id = $request->input('coupon_type_id');
        $coupon->status     = $request->input('status');

        $coupon->save();

        $selectet_userList = $request->input('selectet_userList');
        if ($selectet_userList) {
            foreach ($selectet_userList as $userId) {
                $user_coupon = UserCoupon::find($id);
                $user_coupon->user_id = $userId; // Ensure user_id is set correctly
                $user_coupon->coupon_id = $coupon->id;
                // dd($user_coupon);
                $user_coupon->save();
            }
        }

        return redirect()->route('coupons.index')->with('success', 'Coupon Update successfully!');
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);

        $coupon->delete();
        $result = "Coupon Deleted successfully";
        return $result;
    }

    public function process(Request $request)
    {
        $couponTypeId = $request->input('coupon_type');

        // Perform validation if necessary
        $request->validate([
            'coupon_type' => 'required|exists:coupon_types,id'
        ]);

        // Redirect based on coupon type ID
        switch ($couponTypeId) {
            case 1:
                return redirect()->route('coupon.general');
            case 2:
                return redirect()->route('coupon.userCoupon');
            case 3:
                return redirect()->route('coupon.productCoupon');
            case 4:
                return redirect()->route('coupon.userProductCoupon');
            default:
                return redirect()->route('coupon.general');
        }
    }

    public function general()
    {
        return view('Admin.coupon.general.create');
    }
    public function userCoupon()
    {
        $users = User::all();
        return view('Admin.coupon.user_coupon.create', compact('users'));
    }
    public function productCoupon()
    {
        return view('Admin.coupon.product_coupon.create');
    }
    public function userProductCoupon()
    {
        return view('Admin.coupon.user_product_coupon.create');
    }

    public function edit($id)
    {
        $coupon = Coupon::with('couponType')->findOrFail($id);

        switch ($coupon->coupon_type_id) {
            case 1:
                return redirect()->route('coupon.general.edit', $id);
            case 2:
                return redirect()->route('coupon.userCoupon.edit', $id);
            case 3:
                return redirect()->route('coupon.productCoupon.edit', $id);
            case 4:
                return redirect()->route('coupon.userProductCoupon.edit', $id);
            default:
                abort(404, 'Coupon type not found');
        }
    }
    public function generalEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $users = User::all();
        return view('Admin.coupon.general.edit', compact('coupon', 'users'));
    }
    public function userCouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        // dd($coupon);
        $users = User::all();
        $userCoupons = UserCoupon::where('coupon_id', $coupon->id)->with('user')->get();
        // dd($userCoupons);
        // dd($userCoupon);
        return view('Admin.coupon.user_coupon.edit', compact('coupon', 'users', 'userCoupons'));
    }
    public function productCouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $users = User::all();
        return view('Admin.coupon.product_coupon.edit', compact('coupon', 'users'));
    }
    public function userProductCouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $users = User::all();
        return view('Admin.coupon.user_product_coupon.edit', compact('coupon', 'users'));
    }
}
