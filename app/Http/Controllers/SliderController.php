<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function add_slider(){
        $this->AuthLogin();
        return view('admin.slider.add_slider');
    }

    public function all_slider(){
        $this->AuthLogin();
        $all_slider = Slider::orderBy('tbl_slider.slider_id', 'DESC')->get();  
        return view('admin.slider.all_slider', compact('all_slider'));
    }

    public function save_slider(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $slider = new Slider();
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];

        $get_image = $request->slider_image;
        $path = 'upload/slider/';
        $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $slider->slider_image = $new_image;
        $slider->save();
        return Redirect::to('all-slider')->with('status', 'Thêm slider thành công');
    }

    public function unactive_slider($slider_id){
        $this->AuthLogin();
        $slider = Slider::find($slider_id);
        $slider->update(['slider_status'=>0]);
        return Redirect::to('all-slider')->with('status', 'Không kích hoạt slider thành công');
    }

    public function active_slider($slider_id){
        $this->AuthLogin();
        $slider = Slider::find($slider_id);
        $slider->update(['slider_status'=>1]);
        return Redirect::to('all-slider')->with('status', 'Kích hoạt slider thành công');
    }

    public function edit_slider($slider_id){
        $this->AuthLogin();
        $edit_slider = Slider::where('slider_id', $slider_id)->get();
        return view('admin.slider.edit_slider', compact('edit_slider'));    }

    public function update_slider(Request $request, $slider_id){ // Request để lấy yêu cầu dữ liệu
        $this->AuthLogin();
        $data = $request->all();
        
        $slider = Slider::find($slider_id);
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];

        $get_image = $request->slider_image;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'upload/slider/'.$slider->slider_image;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'upload/slider/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $slider->slider_image = $new_image;
        }
        $slider->save();
        return Redirect::to('all-slider')->with('status', 'Cập nhật slider thành công');
    }

    public function delete_slider($slider_id){
        $this->AuthLogin();
        $slider = Slider::find($slider_id);
        $path_unlink = 'upload/slider/'.$slider->slider_image;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $slider->delete();
        return Redirect::to('all-slider')->with('status', 'Xóa slider thành công');
    }
}
