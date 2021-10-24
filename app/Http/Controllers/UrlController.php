<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Url\Requests\UpdateUrlRequest;
use App\Models\UrlModel;
use App\Http\Requests\Url\CreateUrlRequest;

class UrlController extends Controller
{
    private $model;

    function __construct(UrlModel $url)
    {
        $this->model = $url;
    }

    public function index()
    {
        return view('url/index')->with('urls',$this->model->paginate(10));
    }

    public function show()
    {
        return view('url/create');
    }

    public function create(CreateUrlRequest $request)
    {
        $this->model->create($request->all());

        session()->flash('msg', 'A url foi cadastrado com sucesso!');

        return redirect()->route('index.url');
    }

    public function delete(Request $request)
    {
        $this->model->where(['id_url' => $request->id])->delete();
        return true;
    }
}
