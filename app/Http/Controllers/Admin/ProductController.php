<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Color;
use App\Models\MetaKey;
use App\Models\MetaType;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductColorImage;
use App\Models\ProductMeta;
use App\Models\ProductMultipleImage;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationKey;
use App\Models\ProductVariantColor;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::with('category', 'subcategory', 'childcategory', 'brand')->get();
        $color = Color::all();
        $productcolors = ProductColor::with('product', 'color', 'images')->get();

        return view('Admin.product.index', compact('product', 'color', 'productcolors'));
    }
    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    public function productUpdate(Request $request)
    {

        $product = Product::findOrFail($request->product_id);


        $productColor = new ProductColor();
        $productColor->product_id = $product->id;
        $productColor->color_id = $request->input('color_id');
        $productColor->price = $request->input('price');
        $productColor->sku = $request->input('sku');
        $productColor->qty = $request->input('qty');
        $productColor->offer_price = $request->input('offer_price');

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('Product Images/thumbnail', 'public');
            $productColor->single_image = $mainImagePath;
        }

        $productColor->save();

        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->store('Product Color Images', 'public');
                ProductColorImage::create([
                    'product_color_id' => $productColor->id,
                    'multi_image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function getProductColorsByProductId($productId)
    {
        $productColors = ProductColor::with('color', 'images')->where('product_id', $productId)->get();
        return response()->json($productColors);
    }
    public function productsUpdate(Request $request)
    {

        // $productColor = ProductColor::find($request->input('id')) ?? new ProductColor();
        // dd($productColor);
        // $productColor->product_id = $request->input('product_id');
        // $productColor->color_id = $request->input('color_id'); // Ensure color_id is an integer
        $productColor = ProductColor::where('product_id', $request->input('product_id'))->where('id', $request->input('id'))->first();
        $productColor->color_id = $request->input('color_id');
        $productColor->price = $request->input('price');
        $productColor->sku = $request->input('sku');
        $productColor->qty = $request->input('qty');
        $productColor->offer_price = $request->input('offer_price');

        if ($request->hasFile('single_image')) {
            $mainImagePath = $request->file('single_image')->store('Product Images/thumbnail', 'public');
            $productColor->single_image = $mainImagePath;
        }

        $productColor->save();

        if ($request->hasFile('multi_images')) {
            // Delete old images if needed
            ProductColorImage::where('product_color_id', $productColor->id)->delete();

            // Add new images
            foreach ($request->file('multi_images') as $image) {
                $imagePath = $image->store('Product Color Images', 'public');
                ProductColorImage::create([
                    'product_color_id' => $productColor->id,
                    'multi_image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function productsDelete(Request $request)
    {
        $productColor = ProductColor::find($request->input('id'));

        if ($productColor) {
            // Delete related images if needed
            foreach ($productColor->images as $image) {
                Storage::disk('public')->delete($image->multi_image);
                $image->delete();
            }

            // Delete the single image
            Storage::disk('public')->delete($productColor->single_image);

            // Delete the product color
            $productColor->delete();

            $result = "Product Color deleted successfully";
            return $result;
        }

        return response()->json(['error' => 'Product color not found'], 404);
    }


    public function indexData()
    {
        $product = Product::with('category', 'subcategory', 'childcategory', 'brand', 'colors')->get();
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
            ->addColumn('color_count', function ($row) {
                return $row->colors ? $row->colors->count() : 0;
            })
            ->addColumn('colors', function ($row) {
                if ($row->colors->isNotEmpty()) {
                    $colorNames = $row->colors->map(function ($colors) {
                        return $colors->color ? $colors->color->code : 'N/A';
                    });
                    return $colorNames->implode(', ');
                }
                return 'N/A';
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
            ->addColumn('single_image', function ($row) {
                $color = $row->colors->first();
                if ($color->single_image != null) {
                     // Change this to get the desired color image
                    $imagePath = $color->single_image;
                    return $imagePath; // Return the URL of the image
                }
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
        $color = Color::all();

        return view('Admin.product.create', compact('brand', 'category', 'productspecificationkey', 'meta_type', 'meta_key', 'color'));
    }

    public function getSubcategories($categoryId)
    {
        // Only retrieve subcategories where status = 1
        $subcategories = SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();

        return response()->json(['subcategories' => $subcategories]);
    }


    public function getChildcategories($subcategoryId)
    {
        // Only retrieve child categories where status = 1
        $childcategories = ChildCategory::where('subcategory_id', $subcategoryId)
            ->where('status', 1)
            ->get();

        return response()->json(['childcategories' => $childcategories]);
    }



    public function getMetaKeys($metaTypeId)
    {
        $metaKeys = MetaKey::where('meta_types_id', $metaTypeId)->get();
        return response()->json($metaKeys);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000000000',
            'short_description' => 'required',
            'price' => 'required|numeric',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:200000000', 
        ]);

      
        // Create and save the product
        $product = new Product();
        $product->fill($validatedData);
        $product->slug = Str::slug($request->input('title'));
        $product->brand_id = $request->input('brand_id') ?? null;
        $product->category_id = $request->input('category_id') ?? null;
        $product->subcategory_id = $request->input('subcategory_id') ?? null;
        $product->childcategory_id = $request->input('childcategory_id') ?? null;
        $product->long_description = $request->input('long_description') ?? null;
        $product->is_top = $request->has('is_top') ? 1 : 0;
        $product->new_product = $request->has('new_product') ? 1 : 0;
        $product->is_best = $request->has('is_best') ? 1 : 0;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;

        if ($request->input('action') == 'save_and_new') {
            $product->status = 0; // Save as draft
        } elseif ($request->input('action') == 'save') {
            $product->status = 1; // Publish the product
        }
        $product->save();

        // Create and save the product color
        $productColor = new ProductColor();
        $productColor->product_id = $product->id;
        $productColor->color_id = $request->input('color_id');
        $productColor->price = $request->input('price');
        $productColor->qty = $request->input('qty') ?? 0;
        $productColor->sku = $request->input('sku');
        $productColor->offer_price = $request->input('offer_price');
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('Product Images/thumbnail', 'public');
            $productColor->single_image = $mainImagePath;
        }
        $productColor->save();

        // Save multiple images for the product color
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->store('Product Color Images', 'public');
                // dd($imagePath);
                ProductColorImage::create([
                    'product_color_id' => $productColor->id,
                    'multi_image' => $imagePath,
                ]);
            }
        }

        // Save product specifications
        $productSpecificationKeys = array_filter($request->input('product_specification_key_id', []));
        $productSpecifications = array_filter($request->input('specification', []));

        if (count($productSpecificationKeys) === count($productSpecifications)) {
            foreach ($productSpecificationKeys as $index => $specificationKeyId) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'product_specification_key_id' => $specificationKeyId,
                    'specification' => $productSpecifications[$index],
                ]);
            }
        }

        // Save product meta keys
        $productMetaKeys = array_filter($request->input('meta_keys_id', []));
        $content = array_filter($request->input('content', []));

        if (count($productMetaKeys) === count($content)) {
            foreach ($productMetaKeys as $index => $metaKeyId) {
                ProductMeta::create([
                    'product_id' => $product->id,
                    'meta_keys_id' => $metaKeyId,
                    'content' => $content[$index],
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::with('colors')->find($id);
        $productcolor = ProductColor::with('images')->where('product_id', $id)->first();
        // dd($productcolor);
        $category = Category::all();
        $subcategory = SubCategory::where('status', 1)->get();
        $childcategory = ChildCategory::where('status', 1)->get();
        $brand = Brand::all();
        $productspecificationkey = ProductSpecificationKey::all();
        $productSpecifications = ProductSpecification::where('product_id', $id)->get();

        $meta_type = MetaType::all();
        $meta_key = MetaKey::all();
        $productmeta = ProductMeta::where('product_id', $id)->get();

        $color = Color::all();



        return view('Admin.product.edit', compact('product', 'category', 'brand', 'productspecificationkey', 'subcategory', 'childcategory', 'productSpecifications', 'meta_key', 'productmeta', 'meta_type', 'color', 'productcolor'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
       
     $colors = Color::all();
     $products = Product::all();


        return view('Admin.product.add_product_variant', compact('product','colors','products'));
    }

    public function editProduct($id)
    {
        // Find the product by id
        $product = Product::findOrFail($id);

        // Fetch all colors
        $colors = Color::all();

        // Fetch all products
        $products = Product::all();

        // Fetch all product variant colors related to this product
        $productVariantColors = ProductVariantColor::where('main_product_id', $id)->get();

        return view('Admin.product.edit_product_variant', compact('product', 'colors', 'products', 'productVariantColors'));
    }

    public function updateProduct(Request $request, $id)
    {
        // Find the product by id
        $product = Product::findOrFail($id);

        // Update product details
        $product->update($request->all());

        // Update product variant colors
        foreach ($request->input('variant_colors', []) as $variantId => $variantData) {
            $productVariantColor = ProductVariantColor::findOrFail($variantId);
            $productVariantColor->update($variantData);
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function deleteVariantColor(Request $request)
    {
        $variantId = $request->id;

        // Find the variant by ID and delete it
        $variantColor = ProductVariantColor::find($variantId);

        if ($variantColor) {
            $variantColor->delete();
            return response()->json(['success' => true, 'message' => 'Variant color deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Variant color not found.']);
    }


    public function storeVariant(Request $request)
    {
        $request->validate([
            'main_product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'product_id' => 'required|exists:products,id',
        ]);

        // $data = $request->only(['main_product_id', 'color_id', 'product_id']);
        $data = [
            'main_product_id' => $request->input('main_product_id'),
            'color_id' => $request->input('color_id'),
            'product_id' => $request->input('product_id'),
        ];
        ProductVariantColor::create($data);
        $second_color_id = ProductColor::where('product_id', $request->input('main_product_id'))->first();

        $second_data = [
            'main_product_id' => $request->input('product_id'),
            'color_id' => $second_color_id->color_id,
            'product_id' => $request->input('main_product_id'),
        ];
        ProductVariantColor::create($second_data);

        if ($request->action === 'save_and_new') {
            return redirect()->back()->with('success', 'Product variant color saved. Add another one.');
        }

        return redirect()->route('product.index')->with('success', 'Product variant color saved.');
    }
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'slug' => 'required|string|unique:products,slug,' . $id . '|max:255',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',  // Add validation for price
            'offer_price' => 'nullable|numeric',  // Add validation for offer_price
            'sku' => 'required|string|max:255',  // Add validation for sku
            'qty' => 'required|integer',  // Add validation for quantity
        ]);

        $product = Product::findOrFail($id);

        // Determine product status based on action
        $status = ($request->input('action') == "save") ? 1 : 0;

        // Update product details
        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('slug'));
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id') ?? null;
        $product->childcategory_id = $request->input('childcategory_id') ?? null;
        $product->brand_id = $request->input('brand_id');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');
        $product->status = $status;
        $product->save();

        // Update single image for the product color
        if ($request->hasFile('main_image')) {
            $singleImagePath = $request->file('main_image')->store('Product Colors/single', 'public');

            $productColor = ProductColor::where('product_id', $id)->first();
            if ($productColor) {
                // Delete the old image if it exists
                if ($productColor->single_image && Storage::exists('public/' . $productColor->single_image)) {
                    Storage::delete('public/' . $productColor->single_image);
                }

                $productColor->single_image = $singleImagePath;
                $productColor->save();
            }
        }

        // Update price, offer_price, qty, and sku for the product color
        $productColor = ProductColor::where('product_id', $id)->first();
        if ($productColor) {
            $productColor->price = $request->input('price');
            $productColor->offer_price = $request->input('offer_price');
            $productColor->qty = $request->input('qty');
            $productColor->sku = $request->input('sku');
            $productColor->save();
        }

        if ($request->hasFile('multiple_images')) {
            // First, delete existing product images related to the product color
            if ($productColor) {
                // This will call the productColorImages method defined in the ProductColor model
                $productColor->productColorImages()->delete();
            }

            // Add new product images
            foreach ($request->file('multiple_images') as $image) {
                $filenameimage = $image->store('Product/Multiple Images', 'public');
                ProductColorImage::create([
                    'product_color_id' => $productColor->id,
                    'multi_image' => $filenameimage,
                ]);
            }
        }

        // Handle product specifications
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

        // Handle product meta
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
