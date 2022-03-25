<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Catalog;
use App\Models\Giftcode;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProductControllers extends Controller
{
    public function accept_order()
    {
        $code = $_GET['code'];
        $order = Order::where('ord_code', $code)->get();
        foreach ($order as $key => $values) {
            $user_id = $values->ord_id_user;
            $giftcode = $values->ord_giftcode;
        }

        $notCode = "Don't have";
        $isCode = "newcustomer";
        if ($giftcode == $isCode) {
            $gift = DB::table('users')->where('user_id', '=', $user_id)->first();
            $times = $gift->user_timesCode - 1;
            DB::table('users')->where('user_id', '=', $user_id)->update(['user_timesCode' => $times]);
        } elseif ($giftcode != $notCode) {
            $gift = DB::table('giftcode')->Where('giftcode_name', '=', $giftcode)->first();
            $times = $gift->giftcode_times - 1;
            Giftcode::where('giftcode_name', '=', $giftcode)->update(['giftcode_times' => $times]);
        }

        DB::table('order')->where('ord_code', '=', $code)->update(['ord_status' => 2]);

        return redirect()->back();
    }
    public function manage_order()
    {
        $order = DB::table('order')->orderBy('ord_id', 'desc')->get();
        return view('admin.manage-order')->with(compact('order'));
    }
    public function manage_view_order()
    {
        $code = $_GET['code'];
        $order = Order::where('ord_code', $code)->get();
        foreach ($order as $key => $values) {
            $user_id = $values->ord_id_user;
            $trans_id = $values->ord_transaction_id;
            $total_price = $values->ord_total;
            $giftcode = $values->ord_giftcode;
        }
        $user = User::where('user_id', $user_id)->get();
        $trans = Transaction::where('trans_id', $trans_id)->get();
        $order_details = Order_detail::where('detail_order_code', $code)->get();
        return view('admin.view-detail')->with(compact('user', 'trans', 'order_details', 'total_price', 'giftcode'));
    }
    public function add_coupon()
    {
        return view('admin.add-coupon');
    }
    public function show_coupon()
    {
        $userData = Giftcode::all();
        return view('admin.show-coupon')->with(compact('userData'));
    }
    public function delete_coupon()
    {
        $id = $_GET['id'];
        Giftcode::find($id)->delete();

        return redirect()->back();
    }
    public function handle_coupon(Request $request)
    {
        $data = array();

        $data['giftcode_name'] = $request->giftcode_name;
        $data['giftcode_times'] = $request->giftcode_times;
        $data['giftcode_condidtion'] = $request->giftcode_condidtion;
        $data['giftcode_discount'] = $request->giftcode_discount;

        $id = DB::table('giftcode')->insertGetId($data);

        return redirect('/add-coupon');
    }
    public function add_cate()
    {
        return view('admin.add-category');
    }
    public function show_cate()
    {
        $userData = Catalog::all();
        return view('admin.show-catalog', ['catalog' => $userData]);
    }
    public function add_product()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->get();
        return view('admin.add-product')->with(compact('catalog'));
    }
    public function edit_product()
    {
        $id = $_GET['id'];
        $catalog = Catalog::orderby('catalog_id', 'desc')->get();
        $product = Product::with('Catalog')->where('product_id', $id)->first();
        return view('admin.edit-product')->with(compact('catalog', 'product'));
    }
    public function edit_catalog()
    {
        $id = $_GET['id'];
        $catalog = Catalog::where('catalog_id', $id)->first();
        return view('admin.edit-category')->with(compact('catalog'));
    }
    public function handle_edit_catalog(Request $request)
    {
        $id = $_GET['id'];
        $catalog = Catalog::find($id);

        $catalog->catalog_name = $request->input('Category_name');
        $catalog->catalog_parent = $request->input('Category_main');

        $catalog->update();
        return redirect()->back()->with('message', 'Update sucessful!');
    }
    public function delete_catalog()
    {
        $id = $_GET['id'];
        Catalog::find($id)->delete();

        return redirect()->back()->with('message', 'Delete sucessful!');
    }
    public function delete_product()
    {
        $id = $_GET['id'];
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Delete sucessfull!');
    }
    public function handle_edit_product(Request $request)
    {
        $id = $_GET['id'];

        $product = Product::find($id);
        $product->product_catalog_id = $request->input('category_id');
        $product->product_name = $request->input('product_name');
        $product->product_quantity = $request->input('product_quantity');
        $product->product_price = $request->input('product_price');
        $product->product_content = $request->input('product_content');
        $product->product_discription = $request->input('product_discription');
        $product->product_discount = $request->input('product_discount');

        // image
        if ($request->hasFile('product_image')) {
            $path = 'uploads/' . $product->product_image_link;
            if (file_exists($path)) {
                unlink($path);
            }

            $file = $request->file('product_image');
            $extension = $file->getClientOriginalName();
            $file_name = current(explode('.', $extension));
            $file->move('uploads/', $file_name);

            $product->product_image_link = $file_name;
        }
        

        $product->update();

        return redirect()->back()->with('message', 'Update new successfull!');
    }
    public function show_product()
    {
        $product = Product::with('Catalog')->orderby('product_id', 'desc')->get();
        return view('admin.show-product')->with(compact('product'));
    }
    // handle
    public function handle_catalog(Request $request)
    {
        $data = array();

        $data['catalog_name'] = $request->Category_name;
        $data['catalog_parent'] = $request->Category_main;

        $id = DB::table('catalog')->insertGetId($data);

        return redirect('/add-category')->with('message', 'Add new category sucessful!');
    }
    public function handle_product(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|max:255',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_content' => 'required',
            'product_discription' => 'required',
            'product_discount' => 'required',
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width:100,min_height:100,max_width:1000,max_height:1000'   
        ]);

        $product = new Product();
        $product->product_catalog_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_price = $data['product_price'];
        $product->product_content = $data['product_content'];
        $product->product_discription = $data['product_discription'];
        $product->product_discount = $data['product_discount'];


        // image
        $get_image = $request->file('product_image');
        $path = 'uploads/';
        $get_image_name = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_image_name));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $product->product_image_link = $new_image;
       

        $product->save();

        return redirect()->back()->with('message', 'Add new successfull!');
    }
}
