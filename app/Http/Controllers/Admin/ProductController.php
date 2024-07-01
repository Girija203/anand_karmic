<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\MetaKey;
use App\Models\MetaType;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\ProductMultipleImage;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationKey;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::with('category', 'subcategory', 'childcategory', 'brand')->get();
        return view('Admin.product.index', compact('product'));
    }
    public function indexData()
    {

        $product = Product::with('category', 'subcategory', 'childcategory', 'brand')->get();

        return DataTables::of($product)
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : 'N/A';
            })
            ->addColumn('subcategory_name', function ($row) {
                return $row->subcategory ? $row->subcategory->name : 'N/A';
            })

            ->addColumn('childcategory_name', function ($row) {
                return $row->childcategory ? $row->childcategory->name : 'N/A';
            })

            ->addColumn('brand', function ($row) {
                return $row->brand ? $row->brand->name : 'N/A';
            })
            ->addColumn('labels', function ($row) {
                $labels = '';
                if ($row->new_product) {
                    $labels .= '<span class="badge badge-primary p-1">New</span> ';
                }
                if ($row->is_featured) {
                    $labels .= '<span class="badge badge-success p-1">Featured</span> ';
                }
                if ($row->is_top) {
                    $labels .= '<span class="badge badge-warning p-1">Top</span> ';
                }
                if ($row->is_best) {
                    $labels .= '<span class="badge badge-danger p-1">Best</span> ';
                }
                return $labels;
            })
            ->rawColumns(['labels'])
            ->make(true);
    }



    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        $productspecificationkey = ProductSpecificationKey::all();
        $meta_type = MetaType::all();
        $meta_key = MetaKey::all();

        return view('Admin.product.create', compact('brand', 'category', 'productspecificationkey', 'meta_type', 'meta_key'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }

    public function getChildcategories($subcategoryId)
    {
        $childcategories = ChildCategory::where('subcategory_id', $subcategoryId)->get();
        return response()->json(['childcategories' => $childcategories]);
    }



    public function getMetaKeys($metaTypeId)
    {
        $metaKeys = MetaKey::where('meta_types_id', $metaTypeId)->get();
        return response()->json($metaKeys);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'title' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            // 'offer_price' => 'required',
            'brand_id'=>'required',
            'qty' => 'required',
            'status'=>'required'
        ]);


        $product = new Product();
        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'));
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id') ?? null;
        $product->childcategory_id = $request->input('childcategory_id') ?? null;

        $product->brand_id = $request->input('brand_id');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->offer_price = $request->input('offer_price');
        $product->qty = $request->input('qty');
        $product->is_top = $request->has('is_top') ? 1 : 0;
        $product->new_product = $request->has('new_product') ? 1 : 0;
        $product->is_best = $request->has('is_best') ? 1 : 0;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->status = $request->input('status');
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('Product Images/thumbnail', 'public');
            $product->image = $mainImagePath;
        }


        $product->save();

        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->store('Product Images', 'public');
                $productImage = new ProductMultipleImage();
                $productImage->product_id = $product->id;
                $productImage->image = $imagePath;
                $productImage->save();
            }
        }

        $productSpecificationKeys = $request->input('product_specification_key_id');
        $productSpecifications = $request->input('specification');

        // Filter out null values from the arrays
        $productSpecificationKeys = array_filter($productSpecificationKeys, function ($value) {
            return !is_null($value);
        });

        $productSpecifications = array_filter($productSpecifications, function ($value) {
            return !is_null($value);
        });

        // Ensure both arrays are not empty and have the same length
        if (!empty($productSpecificationKeys) && !empty($productSpecifications) && count($productSpecificationKeys) === count($productSpecifications)) {
            foreach ($productSpecificationKeys as $index => $specificationKeyId) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'product_specification_key_id' => $specificationKeyId,
                    'specification' => $productSpecifications[$index],
                ]);
            }
        }


        //metakey

        $productmetakey = $request->input('meta_keys_id');
        $content = $request->input('content');

        // Filter out null values from the arrays
        $productmetakey = array_filter($productmetakey, function ($value) {
            return !is_null($value);
        });

        $content = array_filter($content, function ($value) {
            return !is_null($value);
        });

        // Ensure both arrays are not empty and have the same length
        if (!empty($productmetakey) && !empty($content) && count($productmetakey) === count($content)) {
            foreach ($productmetakey as $index => $metakeyid) {
                ProductMeta::create([
                    'product_id' => $product->id,
                    'meta_keys_id' => $metakeyid,
                    'content' => $content[$index],
                ]);
            }
        }




        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        $subcategory = SubCategory::where('status', 1)->get();
        $childcategory = ChildCategory::where('status', 1)->get();
        $brand = Brand::all();
        $productspecificationkey = ProductSpecificationKey::all();
        $productSpecifications = ProductSpecification::where('product_id', $id)->get();

        $meta_type = MetaType::all();
        $meta_key = MetaKey::all();
        $productmeta = ProductMeta::where('product_id', $id)->get();



        return view('Admin.product.edit', compact('product', 'category', 'brand', 'productspecificationkey', 'subcategory', 'childcategory', 'productSpecifications', 'meta_key', 'productmeta', 'meta_type'));
    }


    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'main_image' => 'nullable',
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            // 'offer_price' => 'required',
            'qty' => 'required',
            'status' => 'required',
            'multiple_images.*' => 'nullable',
        ]);


        $product = Product::findOrFail($id);


        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'));
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id') ?? null;
        $product->childcategory_id = $request->input('childcategory_id') ?? null;
        $product->brand_id = $request->input('brand_id');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->offer_price = $request->input('offer_price');
        $product->qty = $request->input('qty');
        $product->is_top = $request->has('is_top') ? 1 : 0;
        $product->new_product = $request->has('new_product') ? 1 : 0;
        $product->is_best = $request->has('is_best') ? 1 : 0;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->status = $request->input('status');


        if ($request->hasFile('main_image')) {

            $mainImagePath = $request->file('main_image')->store('Product Images/thumbnail', 'public');

            $product->image = $mainImagePath;
        }

        $product->save();

        if ($request->hasFile('multiple_images')) {

            ProductMultipleImage::where('product_id', $id)->delete();


            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->store('Product Images', 'public');
                $productImage = new ProductMultipleImage();
                $productImage->product_id = $id;
                $productImage->image = $imagePath;
                $productImage->save();
            }
        }

        $productSpecificationKeys = $request->input('product_specification_key_id');
        $productSpecifications = $request->input('specification');

        if ($productSpecificationKeys && $productSpecifications) {

            ProductSpecification::where('product_id', $id)->delete();


            foreach ($productSpecificationKeys as $index => $specificationKeyId) {
                ProductSpecification::create([
                    'product_id' => $id,
                    'product_specification_key_id' => $specificationKeyId,
                    'specification' => $productSpecifications[$index],
                ]);
            }
        }


        $productmetakey = $request->input('meta_keys_id');
        $productmeta = $request->input('content');

        if ($productmetakey && $productmeta) {
            ProductMeta::where('product_id', $id)->delete();

            foreach ($productmetakey as $index => $productmetakeyId) {
                ProductMeta::create([
                    'product_id' => $id,
                    'meta_keys_id' => $productmetakeyId,
                    'content' => $productmeta[$index],
                ]);
            }
        }


        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {

        $product = Product::findOrfail($id);
        $product->delete();
        $result = "Product deleted successfully";
        return $result;

       
    }
}
