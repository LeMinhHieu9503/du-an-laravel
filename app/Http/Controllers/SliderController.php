<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function manage_slider()
    {
        $all_slide = Slider::orderBy('slider_id', 'DESC')->get();
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function add_slider()
    {
        return view('admin.slider.add_slider');
    }

    public function insert_slider(Request $request) 
    {
        $data = $request->all();
        dd($data);
    }
}
