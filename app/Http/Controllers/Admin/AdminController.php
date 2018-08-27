<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Subcategory;
use App\Product;
use App\Order;
use App\Comment;
use App\Notification;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function viewOrders()
    {
        $order = Order::where('active', 0)->orderBy('id', 'desc')->get();

        return view('admin.viewOrders', compact('order'));
    }

    public function viewProducts()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view('admin.viewProducts', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::orderBy('subcategory', 'asc')->get();

        return view('admin.addProduct', compact('categories', 'subcategories'));
    }

    public function viewCategories()
    {
        $categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::orderBy('subcategory', 'asc')->get();

        return view('admin.viewCategories', compact('categories', 'subcategories'));
    }

    public function addCategory()
    {
        return view('admin.addCategory');
    }

    public function addSubcategory()
    {
        return view('admin.addSubcategory');
    }



    public function storeaddProduct(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|unique:products|max:100|min:2',
            'description'   => 'required|min:10|max:500',
            'price'         => 'required|integer|min:1',
            'pricediscount' => 'required|integer|min:0|max:100',
            'quantity'      => 'required|integer|min:1',
            'category'      => 'required',
            'subcategory'   => 'required',
            'image'         => 'required|image|max:2048',
        ]);

        $addProduct = Product::create([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'price'         => $request->input('price'),
            'pricediscount' => $request->input('pricediscount'),
            'quantity'      => $request->input('quantity'),
            'category'      => $request->input('category'),
            'subcategory'   => $request->input('subcategory'),
            'imageextension'=> $request->file('image')->getClientOriginalExtension(),
        ]);

        $image = $addProduct->id.'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->move(
            base_path() . '/public/images/products/', $image
        );

        if($addProduct && $image) {
            return redirect()->back()
                        ->with('message', 'Product added successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function storeaddCategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories|max:60|min:2',
        ]);

        $addCategory = Category::create([
            'category' => $request->input('category')
        ]);

        if($addCategory) {
            return redirect()->back()
                        ->with('message', 'Category added successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function storeaddSubcategory(Request $request)
    {
        $this->validate($request, [
            'subcategory' => 'required|max:60|min:2',
            'category' => 'required',
        ]);

        $check = Subcategory::where('category', $request->category)->where('subcategory', $request->subcategory)->first();

        if(count($check) <= 0) {
            $addSubategory = Subcategory::create([
                'category' => $request->input('category'),
                'subcategory' => $request->input('subcategory'),
            ]);

            if($addSubategory) {
                return redirect()->back()
                            ->with('message', 'Subcategory added successfully.');
            } else {
                return redirect()->back()
                            ->with('message', 'Something wrong. Please try again.');
            }
        } else {
            return redirect()->back()
                            ->with('message', 'Already add this subcategory.');
        }
    }

    public function destroyProduct($id)
    {
        $destroyProduct = Product::findOrFail($id);

        $imagePath = "images/products/".$destroyProduct->id.".".$destroyProduct->imageextension;

        $destroyImage = \File::delete($imagePath);

        $destroyProduct->delete();

        if($destroyProduct && $destroyImage) {
            return redirect()->back()
                        ->with('message', 'Product delete successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function destroyCategory($id)
    {
        $deleteCategory = Category::findOrFail($id);
        $deleteCategory->delete();

        if($deleteCategory) {
            return redirect()->back()
                        ->with('message', 'Category delete successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function destroySubcategory($id)
    {
        $deleteSubcategory = Subcategory::findOrFail($id);
        $deleteSubcategory->delete();

        if($deleteSubcategory) {
            return redirect()->back()
                        ->with('message', 'Subcategory delete successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::orderBy('subcategory', 'asc')->get();

        return view('admin.editProduct', compact('product', 'categories', 'subcategories'));
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.editCategory', compact('category'));
    }

    public function editSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        return view('admin.editSubcategory', compact('subcategory'));
    }

    public function updateProduct(Request $request,$id)
    {
        $this->validate($request, [
            'name'          => 'required|unique:products|max:100|min:2',
            'description'   => 'required|min:10|max:500',
            'price'         => 'required|integer|min:1',
            'pricediscount' => 'required|integer|min:0|max:100',
            'quantity'      => 'required|integer|min:1',
            'category'      => 'required',
            'subcategory'   => 'required',
            'image'         => 'image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $updateProduct                  = Product::findOrFail($id);
            $updateProduct->name            = $request->input('name');
            $updateProduct->description     = $request->input('description');
            $updateProduct->price           = $request->input('price');
            $updateProduct->pricediscount   = $request->input('pricediscount');
            $updateProduct->quantity        = $request->input('quantity');
            $updateProduct->category        = $request->input('category');
            $updateProduct->subcategory     = $request->input('subcategory');
            $updateProduct->imageextension  = $request->file('image')->getClientOriginalExtension();
            $updateProduct->save();

            $image = $updateProduct->id.'.'.$request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                base_path() . '/public/images/products/', $image
            );
        } else {
            $updateProduct                  = Product::findOrFail($id);
            $updateProduct->name            = $request->input('name');
            $updateProduct->description     = $request->input('description');
            $updateProduct->price           = $request->input('price');
            $updateProduct->pricediscount   = $request->input('pricediscount');
            $updateProduct->quantity        = $request->input('quantity');
            $updateProduct->category        = $request->input('category');
            $updateProduct->subcategory     = $request->input('subcategory');
            $updateProduct->save();
        }
               

        if($updateProduct) {
            return redirect()->back()
                        ->with('message', 'Product updated successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories|max:60|min:2',
        ]);

        $updateCategory = Category::findOrFail($id);
        $updateCategory->category = $request->input('category');
        $updateCategory->save();

        if($updateCategory) {
            return redirect()->back()
                        ->with('message', 'Category updated successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function updateSubcategory(Request $request, $id)
    {
        $this->validate($request, [
            'subcategory' => 'required|unique:subcategories|max:60|min:2',
        ]);

        $updateSubcategory = Subcategory::findOrFail($id);
        $updateSubcategory->subcategory = $request->input('subcategory');
        $updateSubcategory->save();

        if($updateSubcategory) {
            return redirect()->back()
                        ->with('message', 'Subategory updated successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    public function viewcomment()
    {
        $comments = Comment::all();

        return view('admin.viewComment', compact('comments'));
    }

    public function deletecomment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        if($comment)
        {
            return back();
        } else {
            return back();
        }
    }


    public function viewsell()
    {
        $order = Order::where('active', 1)->orderBy('id', 'desc')->get();

        return view('admin.viewSell', compact('order'));
    }

    public function viewNotification()
    {
        $notification = Notification::orderBy('id', 'desc')->get();

        return view('admin.viewNotification', compact('notification'));
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        if($notification) {
            return redirect()->back()
                        ->with('message', 'Notification delete successfully.');
        } else {
            return redirect()->back()
                        ->with('message', 'Something wrong. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
