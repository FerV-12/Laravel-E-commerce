<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preorder;

class PreorderController extends Controller
{
    public function index()
    {
        $preorders = Preorder::with(['product', 'user'])->latest()->paginate(20);
        return view('admin.preorders.index', compact('preorders'));
    }
}
