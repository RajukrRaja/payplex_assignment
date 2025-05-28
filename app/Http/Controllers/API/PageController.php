<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $user = Session::get('user');
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mail_id' => 'required|email',
            'contact' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'header' => 'required|string',
            'text' => 'required|string',
            'address' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        $page = Page::create($data);

        return response()->json(['message' => 'Page created successfully', 'page' => $page], 201);
    }
}