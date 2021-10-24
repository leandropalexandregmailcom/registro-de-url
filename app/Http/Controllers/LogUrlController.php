<?php

namespace App\Http\Controllers;

use App\Models\LogUrlModel;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

class LogUrlController extends Controller
{
    private $model;

    function __construct(LogUrlModel $url)
    {
        $this->model = $url;
    }

    public function index($id)
    {
        return view('log_url/index')->with('urls',
            $this->model->where(["id_url" => $id])
            ->paginate(10));
    }

}
