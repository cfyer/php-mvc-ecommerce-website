<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\CSRFToken;
use App\Core\FileUpload;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct()
    {
        Role::admin();
    }

    public function index()
    {
        $slides = Slider::all();
        return View::blade('admin.slider.index', compact('slides'));
    }

    public function create()
    {
        return View::blade('admin.slider.create');
    }

    public function store()
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'link' => ['required' => true]
        ]);
        if (!$validation)
            RequestValidation::sendErrorsAndRedirect('/admin/slider/create');

        $image_path = $this->uploadSlideImage();

        Slider::create([
            'link' => $request->link,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Slide added successfuly');
        return redirect('/admin/slider/');
    }

    protected function uploadSlideImage()
    {
        $file = Request::get('file');
        $file_name = $file->image_path->name;

        if (!FileUpload::isImage($file_name)) {
            Session::add('invalids', ['s' => 'The image is invalid']);
            return redirect('/admin/slider/create');
        }

        $file_temp = $file->image_path->tmp_name;
        return FileUpload::move($file_temp, 'images/slides', $file_name)->getPath();
    }

    public function delete($id)
    {
        $slide = Slider::where('id', $id)->first();
        unlink($slide->image_path);
        $slide->delete();
        Session::add('message', 'slide deleted successfuly');
        return redirect('/admin/slider');
    }

    public function activeSwitch($id)
    {
        $slide = Slider::where('id', $id)->first();
        $slide->update([
            'is_active' => 1 - $slide->is_active
        ]);
        return redirect('/admin/slider');
    }
}
