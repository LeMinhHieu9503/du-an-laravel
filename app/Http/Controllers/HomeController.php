<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;
session_start();
class HomeController extends Controller
{
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
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

        
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        // $all_product = DB::table('tbl_product')
        //     ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        //     ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        //     ->orderBy('tbl_product.product_id', 'desc')->get();

        $all_product = DB::table('tbl_product')
            ->where('product_status', '0')
            ->orderBy('product_id', 'desc')->limit(6)->get();

        return view('pages.home')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('all_product', $all_product)
            ->with('url_canonical', $url_canonical)
            ->with('slider',$slider);

        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //Cách 2
    }

    public function search(Request $request)
    {
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
            ->with('search_product', $search_product);
    }
}
