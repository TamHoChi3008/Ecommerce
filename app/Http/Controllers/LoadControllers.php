<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth_Users;
use App\Models\Catalog;
use App\Models\District;
use App\Models\Giftcode;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\User;
use App\Mail\SendEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoadControllers extends Controller
{
    public function Load_tracker()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('pages.order-tracker')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function Handle_tracker(Request $request)
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $order_code = $request->input('order-code');
        $email = $request->input('order-email');
        $user = Session::get('user_id');
        
        $dataBack = DB::table('order')->where('ord_code', $order_code)->get();
        $dataCall = DB::table('order_details')->where('detail_order_code', $order_code)->get();

        $check_condidtion = DB::table('order')
            ->join('users', 'users.user_id', '=', 'order.ord_id_user')
            ->where('users.user_email', $email)
            ->where('ord_code', $order_code)->first();

        if ($check_condidtion == TRUE) {
            return view('pages.view-order-tracker')->with(compact('dataBack', 'dataCall','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
        } else {
            return redirect()->back()->with('error', 'Cannot access your order, please correct your order code and email again!');
        }
    }
    public function Search(Request $request)
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $key = $request->input('search');
        $catalog = Catalog::orderby('catalog_id', 'desc')->get();
        $product = Product::with('catalog')->where('product_name', 'LIKE', '%' . $key . '%')->paginate(8);

        return view('pages.search')->with(compact('product','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'key'));
    }
    public function Load_form()
    {   
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $province = Province::orderby('matp', 'asc')->get();
        return view('pages.checkout')->with(compact('province','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function User_data(Request $request)
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $id = $request->id;
        $userData = Auth_Users::where('user_id', $id)->first();
        return view('login.my-account')->with(compact('userData','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function handle_province(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'province') {
                $select_district = District::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---SELECT DISTRICT---</option>';
                foreach ($select_district as $key => $district) {
                    $output .= '<option value="' . $district->maqh . '">' . $district->name . '</option>';
                }
            }
        }
        echo $output;
    }
    public function Load_product_detail(Request $request)
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $id = $request->id;
        $productData = Product::with('catalog')->where('product_id', $id)->first();
        $product_related = Product::with('catalog')->where('product_catalog_id', $productData->catalog->catalog_id)->whereNotin('product_id', [$productData->product_id])->get();

        return view('product.product-detail')->with(compact('productData','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'product_related'));
    }
    public function Load_product_Ban()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Bàn')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ban_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Bàn')
            ->orderby('product.product_id', 'desc')->paginate(8);

        return view('product.Ban-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ban_product'));
    }
    public function Load_ban_hocsinh()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Bàn')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ban_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Bàn Học Sinh')
            ->orderby('product.product_id', 'desc')->paginate(4);

        return view('product.Ban-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ban_product'));
    }
    public function Load_ban_vanphong()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Bàn')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ban_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Bàn Văn Phòng')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Ban-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ban_product'));
    }
    public function Load_ban_an()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Bàn')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ban_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Bàn Ăn')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Ban-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ban_product'));
    }

    public function Load_product_Ghe()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Ghế')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ghe_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Ghế')
            ->orderby('product.product_id', 'desc')->paginate(8);

        return view('product.Ghe-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ghe_product'));
    }
    public function Load_ghe_vanphong()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Ghế')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ghe_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Ghế Văn Phòng')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Ghe-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ghe_product'));
    }
    public function Load_ghe_lanhdao()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Ghế')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ghe_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Ghế Lãnh Đạo')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Ghe-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ghe_product'));    
    }
    public function Load_ghe_gaming()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Ghế')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Ghe_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Ghế Gaming')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Ghe-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Ghe_product'));    
    }

    public function Load_product_Tu()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Tủ')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Tu_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Tủ')
            ->orderby('product.product_id', 'desc')->paginate(8);

        return view('product.Tu-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Tu_product'));
    }
    public function Load_tu_sachvanphong()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Tủ')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Tu_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Tủ Sách Văn Phòng')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Tu-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Tu_product'));
    }
    public function Load_tu_daugiuong()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'Tủ')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $Tu_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_name', 'Tủ Đầu Giường')
            ->orderby('product.product_id', 'desc')->paginate(4);

            return view('product.Tu-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'Tu_product'));
    }
    public function Load_product_SOFA()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'SOFA')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $SOFA_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'SOFA')
            ->orderby('product.product_id', 'desc')->paginate(8);

        return view('product.SOFA-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'SOFA_product'));
    }
    public function Load_bo_sofa()
    {
        $catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent', 'SOFA')->get();
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        $SOFA_product = DB::table('product')
            ->join('catalog', 'catalog.catalog_id', '=', 'product.product_catalog_id')
            ->where('catalog.catalog_parent', 'Bộ sofa')
            ->orderby('product.product_id', 'desc')->paginate(8);

        return view('product.SOFA-product')->with(compact('catalog','Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog', 'SOFA_product'));
    }

    public function check_gitfcode(Request $request)
    {
        $data = $request->all();
        $coupon = Giftcode::where('giftcode_name', $data['giftcode'])->first();
        $id = Session::get('user_id');
        $times_user = User::where('user_id', $id)->first();

        if ($coupon == false) {
            return redirect()->back()->with('error', 'Cannot add this coupon, giftcode not exists');
        } else {
            if ($coupon->giftcode_name == "newcustomer" && $times_user->user_timesCode > 0) {
                $cou[] = array(
                    'giftcode_name' => $coupon->giftcode_name,
                    'giftcode_condidtion' => $coupon->giftcode_condidtion,
                    'giftcode_discount' => $coupon->giftcode_discount,
                    'giftcode_times' => $coupon->giftcode_times,
                );
                Session::put('coupon', $cou);
                return redirect()->back()->with('message', 'Add coupon sucessful!');
            } else {
                if ($coupon && $coupon->giftcode_times > 0) {
                    $cou[] = array(
                        'giftcode_name' => $coupon->giftcode_name,
                        'giftcode_condidtion' => $coupon->giftcode_condidtion,
                        'giftcode_discount' => $coupon->giftcode_discount,
                        'giftcode_times' => $coupon->giftcode_times,
                    );
                    Session::put('coupon', $cou);
                    return redirect()->back()->with('message', 'Add coupon sucessful!');
                } else {
                    return redirect()->back()->with('error', 'Cannot add this coupon, giftcode not exists or expired!');
                }
            }
        }
    }
    public function handle_order(Request $request)
    {
        $data = $request->all();

        $district = $data['district'];
        $huyen = District::where('maqh', $district)->first();
        $province = $data['province'];
        $tp = Province::where('matp', $province)->first();

        $transaction = new Transaction();
        $transaction->trans_user_fullname = $data['fullname'];
        $transaction->trans_user_phone = $data['phonenumber'];
        $transaction->trans_user_address = $data['detail_address'] . ', ' . $huyen->name . ', ' . $tp->name;
        $transaction->trans_note = $data['other_infor'];
        $transaction->save();

        $transaction_id = $transaction->trans_id;
        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);


        // put order
        $order = new Order();
        $order->ord_id_user = Session::get('user_id');
        $order->ord_transaction_id = $transaction_id;
        $order->ord_status = 1;
        $order->ord_code = $checkout_code;
        $order->ord_name = Session::get('user_name');
        $order->ord_giftcode = $data['giftcode'];
        $order->ord_total = $data['total_price'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->ord_created = now();

        $order->save();

        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                // put in order-details and clear cart
                $order_details = new Order_detail();
                $order_details->detail_order_code = $checkout_code;
                $order_details->detail_product_id = $cart['product_id'];
                $order_details->detail_product_name = $cart['product_name'];
                $order_details->detail_product_image = $cart['product_image_link'];
                $order_details->detail_qty = $cart['product_qty'];
                // $order_details->detail_size = $cart['product_size'];
                $order_details->detail_product_price = $cart['product_price'];
                $order_details->detail_product_discount = $cart['product_discount'];

                $order_details->save();
            }
        }

        $title_mail = "Confirm your order at GREEN" . ' #' . $checkout_code;

        $customer = Auth_Users::find(Session::get('user_id'));
        $data['email'][] = $customer->user_email;
        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart_email) {
                $cart_mail[] = array(
                    'product_name' => $cart_email['product_name'],
                    // 'product_size' => $cart_email['product_size'],
                    'product_price' => $cart_email['product_price'],
                    'product_sales_quantity' => $cart_email['product_qty']
                );
            }
        }
        $shipping_mail = array(
            'user_name' => $customer->user_name,
            'trans_user_fullname' => $data['fullname'],
            'trans_user_phone' => $data['phonenumber'],
            'trans_user_address' => $data['detail_address'] . ', ' . $huyen->name . ', ' . $tp->name,
            'trans_note' => $data['other_infor'],
        );

        $order_mail = array(
            'coupon_code' => $data['giftcode'],
            'order_code' => $checkout_code
        );
        Mail::send(
            'pages.Email',
            ['cart_mail' => $cart_mail, 'shipping_mail' => $shipping_mail, 'order_mail' => $order_mail],
            function ($message) use ($title_mail, $data) {
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'], $title_mail);
            }
        );

        Session::forget('coupon');
        Session::forget('cart');

        return redirect('/');
    }
}
