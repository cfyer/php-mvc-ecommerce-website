<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\{CSRFToken, FileUpload, Request, RequestValidation, Session, View};
use App\Middlewares\Role;
use App\Models\Slider;
use Exception;

class SliderController extends Controller
{
    public function __construct()
    {
        Role::admin();
    }

    public function index(): View
    {
        $slides = Slider::all();

        return View::render()->blade('admin.slider.index', compact('slides'));
    }

    public function create(): View
    {
        return View::render()->blade('admin.slider.create');
    }

    /**
     * @throws Exception
     */
    public function store(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'link' => ['required' => true]
        ]);

        $image_path = $this->uploadSlideImage();

        Slider::create([
            'link' => $request->link,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Slide added successfully');
        redirect('/admin/slider/');
    }

    protected function uploadSlideImage()
    {
        $file = Request::get('file');
        $file_name = $file->image_path->name;

        if (!FileUpload::isImage($file_name)) {
            Session::add('invalids', ['s' => 'The image is invalid']);
            redirect('/admin/slider/create');
        }

        $file_temp = $file->image_path->tmp_name;
        return FileUpload::move($file_temp, 'images/slides', $file_name)->getPath();
    }

    public function delete($id)
    {
        $slide = Slider::where('id', $id)->first();
        unlink($slide->image_path);
        $slide->delete();
        Session::add('message', 'slide deleted successfully');
        redirect('/admin/slider');
    }

    public function activeSwitch($id): void
    {
        $slide = Slider::where('id', $id)->first();
        $slide->update([
            'is_active' => 1 - $slide->is_active
        ]);
        redirect('/admin/slider');
    }
}
