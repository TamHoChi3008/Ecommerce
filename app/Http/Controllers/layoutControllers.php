<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Giftcode;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class layoutControllers extends Controller
{
    public function Load_more_sale(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data_sale = DB::table('product')
                    ->where('product_discount', '>', '0')
                    ->where('product_id', '<', $request->id)
                    ->orderBy('product_id', 'DESC')
                    ->limit(4)
                    ->get();
            }

            $output = '';
            $last_id = '';

            if (!$data_sale->isEmpty()) {
                $output .= '<div class="product-center container">';
                foreach ($data_sale as $key => $value) {
                    $output .= '
                        <div class="product">
                            <div class="product-header">
                            <img src="./uploads/' . $value->product_image_link . '" class="small" alt="product">
                            </div>
                            <div class="product-footer">
                                <h3>' . $value->product_name . '</h3>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                </br>
                                <div class="product-price">
                                    <h4>' . number_format($value->product_price) . " " . "VND" . '</h4>
                                </div>
                            </div>
                            <ul>
                            <li>
                                <a href="/product-detail?id=' . $value->product_id . '">
                                <i class="far fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="far fa-heart"></i>
                                </a>
                            </li>
                            </ul>
                        </div>
                    ';
                    $last_id = $value->product_id;
                }
                $output .= '
                </div>
                <br>
                <div class="container" id="removed_row_sale">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                        <button type="button" id="load_more_sale" data-id="' . $last_id . '" class="btn btn-dark" style="font-size: large;">Load more</button>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            } else {
                $output .= '
                <br>
                <div class="container" id="removed_row_sale">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                            <h2>Nothing to show!</h2>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            }
            echo $output;
        }
    }
    public function Load_more_lastest(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data_lastest = DB::table('product')
                    ->where('product_discount', '=', '0')
                    ->where('product_id', '<', $request->id)
                    ->orderBy('product_id', 'DESC')
                    ->limit(4)
                    ->get();
            }

            $output = '';
            $last_id = '';

            if (!$data_lastest->isEmpty()) {
                $output .= '<div class="product-center container">';
                foreach ($data_lastest as $key => $value) {
                    $output .= '
                        <div class="product">
                            <div class="product-header">
                            <img src="./uploads/' . $value->product_image_link . '" class="small" alt="product">
                            </div>
                            <div class="product-footer">
                                <h3>' . $value->product_name . '</h3>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="product-price">
                                    <h4>' . number_format($value->product_price) . " " . "VND" . '</h4>
                                </div>
                            </div>
                            <ul>
                            <li>
                                <a href="/product-detail?id=' . $value->product_id . '">
                                <i class="far fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="far fa-heart"></i>
                                </a>
                            </li>
                            </ul>
                        </div>
                    ';
                    $last_id = $value->product_id;
                }
                $output .= '
                </div>
                <br>
                <div class="container" id="removed_row_lastest">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                        <button type="button" id="load_more_lastest" data-id="' . $last_id . '" class="btn btn-dark" style="font-size: large;">Load more</button>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            } else {
                $output .= '
                <br>
                <div class="container" id="removed_row_lastest">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                            <h2>Nothing to show!</h2>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            }
            echo $output;
        }
    }
    public function Load_more(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('order_details')
                    ->where('detail_product_id', '<', $request->id)
                    ->orderBy('detail_product_id', 'DESC')
                    ->limit(4)
                    ->distinct('detail_product_id')
                    ->get();
            }

            $output = '';
            $last_id = '';

            if (!$data->isEmpty()) {
                $output .= '<div class="product-center container">';
                foreach ($data as $key => $value) {
                    $output .= '
                        <div class="product">
                            <div class="product-header">
                            <img src="./uploads/' . $value->detail_product_image . '" class="small" alt="product">
                            </div>
                            <div class="product-footer">
                                <h3>' . $value->detail_product_name . '</h3>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="product-price">
                                    <h4>' . number_format($value->detail_product_price) . " " . "VND" . '</h4>
                                </div>
                            </div>
                            <ul>
                            <li>
                                <a href="/product-detail?id=' . $value->detail_product_id . '">
                                <i class="far fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="far fa-heart"></i>
                                </a>
                            </li>
                            </ul>
                        </div>
                    ';
                    $last_id = $value->detail_product_id;
                }
                $output .= '
                </div>
                <br>
                <div class="container" id="removed_row">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                        <button type="button" id="load_more" data-id="' . $last_id . '" class="btn btn-dark" style="font-size: large;">Load more</button>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            } else {
                $output .= '
                <br>
                <div class="container" id="removed_row">
                  <div class="row">
                    <div class="col-md-12">
                      <center>
                            <h2>Nothing to show!</h2>
                      </center>
                    </div>
                  </div>
                </div>
       ';
            }
            echo $output;
        }
    }
    public function Home()
    {
        $product = Product::orderby('product_id', 'desc')->limit(4)->get();
        $catalog = Catalog::orderby('catalog_id', 'desc')->get();

        $Ban_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Bàn')
            ->orderby('product.product_id', 'desc')->get();
        $count_Ban_items = count($Ban_product);
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();


        $Ghe_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Ghế')
            ->orderby('product.product_id', 'desc')->get();
        $count_Ghe_items = count($Ghe_product);
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();

        $Tu_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Tủ')
            ->orderby('product.product_id', 'desc')->get();
        $count_Tu_items = count($Tu_product);
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();

        $SOFA_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'SOFA')
            ->orderby('product.product_id', 'desc')->get();
        $count_SOFA_items = count($SOFA_product);
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();

        $saleoff = DB::table('product')
            ->where('product_discount', '>', '0')
            ->orderBy('product_id', 'DESC')
            ->limit(4)->get();

        $lastest = DB::table('product')
            ->orderBy('product_id', 'DESC')
            ->where('product_discount', '=', '0')->limit(4)->get();

        // $trending = Order_detail::distinct()->orderby('detail_product_id', 'DESC')->limit(4)->get();
        $trending = DB::table('order_details')
            ->select('detail_product_name', 'detail_product_image', 'detail_product_price', 'detail_product_id')
            ->distinct('detail_product_id')
            ->limit(4)
            ->get();

        return view('home')->with(compact('trending', 'lastest', 'saleoff', 'product', 'catalog', 'count_Ban_items', 'count_Ghe_items', 'count_Tu_items','count_SOFA_items','Ban_product','Ghe_product','Tu_product','SOFA_product','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function view_history()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $id = Session::get('user_id');
        $order = Order::where('ord_id_user', $id)->orderby('ord_created', 'desc')->get();
        return view('login.view-history')->with(compact('order','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function view_details()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $code = $_GET['code'];
        $view_details = DB::table('order_details')
            ->join('order', 'order.ord_code', '=', 'order_details.detail_order_code')
            ->where('detail_order_code', '=', $code)
            ->get();
        return view('login.view-details')->with(compact('view_details','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function view_giftcode()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $id = $_GET['id'];
        $view_giftcode = DB::table('users')
            ->where('user_id', '=', $id)->first();

        return view('login.view-giftcode')->with(compact('view_giftcode','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }

    public function Dashboard()
    {
        return view('admin.dash');
    }

    public function Login()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('login.login-account')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function Register()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('login.register-account')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }

    public function admin_login()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('admin.login')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }

    public function admin_register()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('admin.register')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
}
