<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Mail\SendMail;
use App\Models\CatePost;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

session_start();
class HomeController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function sendMail(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'message' => $request->input('message'),
        ];

        Mail::to('recipient@example.com')->send(new SendMail($data));
        return response()->json(['message' => 'Email sent successfully']);
    }
    public function index(Request $request)
    {
        //slider
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();

        // Post-category
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();

        // URL Canonical
        $url_canonical = $request->url();

        // Lấy tất cả thể loại sản phẩm
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();

        // Lấy tất cả thương hiệu sản phẩm
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        // Lọc sản phẩm theo trạng thái sản phẩm
        $products = DB::table('tbl_product')
            ->where('product_status', '0');

        // Lọc theo category nếu có
        if ($request->has('category_id') && $request->category_id != '') {
            $products = $products->where('category_id', $request->category_id);
        }

        // Lọc theo brand nếu có
        if ($request->has('brand_id') && $request->brand_id != '') {
            $products = $products->where('brand_id', $request->brand_id);
        }

        // Kiểm tra và áp dụng sắp xếp theo các tiêu chí
        if ($request->has('sort')) {
            $sort_by = $request->get('sort');
            switch ($sort_by) {
                case 'giam_dan':
                    $products = $products->orderBy('product_price', 'DESC');
                    break;
                case 'tang_dan':
                    $products = $products->orderBy('product_price', 'ASC');
                    break;
                case 'kytu_az':
                    $products = $products->orderBy('product_name', 'ASC');
                    break;
                case 'kytu_za':
                    $products = $products->orderBy('product_name', 'DESC');
                    break;
                default:
                    $products = $products->orderBy('product_id', 'DESC');
            }
        } else {
            $products = $products->orderBy('product_id', 'DESC');
        }

        // Lấy sản phẩm đã lọc
        $all_product = $products->get();
        
        return view('pages.home')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('all_product', $all_product)
            ->with('url_canonical', $url_canonical)
            ->with('slider', $slider)
            ->with('category_post', $category_post);
    }


    public function search(Request $request)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();

        $keywords = $request->keywords_submit;


        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        $search_product = DB::table('tbl_product')
            ->where('product_name', 'like', '%' . $keywords . '%')
            ->get();

        return view('pages.sanpham.search')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('search_product', $search_product)
            ->with('slider', $slider);
    }
}
