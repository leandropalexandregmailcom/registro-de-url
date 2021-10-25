<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Url;
use App\Models\UrlModel;
use App\Models\LogUrlModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Url\CreateUrlRequest;
use App\Http\Url\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    private $model;

    function __construct(UrlModel $url)
    {
        $this->model = $url;
    }

    public function index()
    {
        return view('url/index')->with('urls', $this->model->where(["id_user" => Auth::user()->id])->get());
    }

    public function status($id)
    {
        return response()->json(LogUrlModel::select('status_code')->where(["id_url" => $id])
        ->orderBy('created_at', 'desc')->first());
    }

    public function show()
    {
        return view('url/create');
    }

    public function create(CreateUrlRequest $request)
    {
        $this->model->url = $request->url;
        $this->model->descricao = $request->descricao;
        $this->model->id_user = Auth::user()->id;
        $this->model->save();

        session()->flash('msg', 'A url foi cadastrada com sucesso!');

        return redirect()->route('index.url');
    }

    public function delete(Request $request)
    {
        $this->model->where(['id_url' => $request->id])->delete();
        return true;
    }
}
