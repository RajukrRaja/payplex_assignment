<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($id)
    {
        $page = Page::where('id', $id)->where('status', true)->firstOrFail();
        return view('user.page', compact('page'));
    }
}