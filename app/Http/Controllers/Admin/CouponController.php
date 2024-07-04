<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\ProductCoupon;
use App\Models\UserProductCoupon;
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

        // dd($request);
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

        $selected_userList = $request->input('selected_userList');
        if (
            $selected_userList &&  $coupon->coupon_type_id == 2
        ) {
            foreach ($selected_userList as $userId) {
                $user_coupon = new UserCoupon;
                $user_coupon->user_id = $userId;
                $user_coupon->coupon_id = $coupon->id;
                $user_coupon->save();
            }
        }

        $selected_productList = $request->input('selected_productList');
        if ($selected_productList && $coupon->coupon_type_id == 3) {
            foreach ($selected_productList as $productId) {
                $product_coupon = new ProductCoupon;
                $product_coupon->product_id = $productId;
                $product_coupon->coupon_id = $coupon->id;
                $product_coupon->save();
            }
        }

        // Handle coupon_type_id 4
        if ($coupon->coupon_type_id == 4) {
            $userId = $request->input('user_id');
            $productId = $request->input('product_id');
            if ($userId && $productId) {
                $user_product_coupon = new UserProductCoupon;
                $user_product_coupon->user_id = $userId;
                $user_product_coupon->product_id = $productId;
                $user_product_coupon->coupon_id = $coupon->id;
                $user_product_coupon->save();
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
        $request->validate(['name' => 'required', 'code' => 'required']);

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
        $coupon->status = $request->input('status');

        $coupon->save();

        $selected_userList = $request->input('selected_userList');
        $removedUsers = $request->input('removedUsers');

        if ($removedUsers) {
            UserCoupon::where('coupon_id', $coupon->id)->whereIn('user_id', $removedUsers)->delete();
        }

        if ($selected_userList && $coupon->coupon_type_id == 2) {
            foreach ($selected_userList as $userId) {
                $user_coupon = UserCoupon::where('coupon_id', $coupon->id)
                    ->where('user_id', $userId)
                    ->first();

                if (!$user_coupon) {
                    $user_coupon = new UserCoupon();
                    $user_coupon->user_id = $userId;
                    $user_coupon->coupon_id = $coupon->id;
                }

                $user_coupon->save();
            }
        }

        $selected_productList = $request->input('selected_productList');
        $removedProducts = $request->input('removedProducts');

        if ($removedProducts) {
            ProductCoupon::where('coupon_id', $coupon->id)->whereIn('product_id', $removedProducts)->delete();
        }
        if ($selected_productList && $coupon->coupon_type_id == 3) {
            foreach ($selected_productList as $productId) {
                $product_coupon = ProductCoupon::where('coupon_id', $coupon->id)
                    ->where('product_id', $productId)
                    ->first();

                if (!$product_coupon) {
                    $product_coupon = new ProductCoupon();
                    $product_coupon->product_id = $productId;
                    $product_coupon->coupon_id = $coupon->id;
                }

                $product_coupon->save();
            }
        }

        if ($coupon->coupon_type_id == 4) {
            $selected_userList = $request->input('selectet_userList'); // Corrected variable name
            $selected_productList = $request->input('selected_productList');
            $removedUserProducts = $request->input('removedUserProducts');

            foreach ($selected_productList as $productId) {
                foreach ($selected_userList as $userId) { // Corrected variable name
                    $user_product_coupon = UserProductCoupon::where('coupon_id', $coupon->id)
                        ->where('product_id', $productId)
                        ->where('user_id', $userId)
                        ->first();
                    if ($removedUserProducts) {
                        // Assuming $productId, $userId are defined somewhere above this block
                        UserProductCoupon::where('coupon_id', $coupon->id)
                        ->where('product_id', $productId)
                        ->where('user_id', $userId)
                        ->delete();
                    }
                    if (!$user_product_coupon) {
                        $user_product_coupon = new UserProductCoupon();
                        $user_product_coupon->coupon_id = $coupon->id;
                        $user_product_coupon->product_id = $productId;
                        $user_product_coupon->user_id = $userId;
                    }
                    $user_product_coupon->save();
                }
            }
        }


        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
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
        $products = Product::all();
        return view('Admin.coupon.product_coupon.create', compact('products'));
    }
    public function userProductCoupon()
    {
        $users = User::all();
        $products = Product::all();
        return view('Admin.coupon.user_product_coupon.create', compact('users', 'products'));
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
                return redirect()->route('coupon.general.edit', $id);

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
        $products = Product::all();
        $productCoupons = ProductCoupon::where('coupon_id', $coupon->id)->with('product')->get();
        return view('Admin.coupon.product_coupon.edit', compact('coupon', 'products', 'productCoupons'));
    }
    public function userProductCouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        $UserProductCoupons = UserProductCoupon::where('coupon_id', $coupon->id)->with('product', 'user')->get();
        return view('Admin.coupon.user_product_coupon.edit', compact('coupon', 'users', 'products', 'UserProductCoupons'));
    }
}
