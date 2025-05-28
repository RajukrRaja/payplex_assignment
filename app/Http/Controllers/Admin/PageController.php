<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
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

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
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
            if ($page->logo) {
                Storage::disk('public')->delete($page->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($page->banner_image) {
                Storage::disk('public')->delete($page->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        if ($page->logo) {
            Storage::disk('public')->delete($page->logo);
        }
        if ($page->banner_image) {
            Storage::disk('public')->delete($page->banner_image);
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }

    public function toggleStatus(Page $page)
    {
        $page->status = !$page->status;
        $page->save();
        return redirect()->route('admin.pages.index')->with('success', 'Page status updated');
    }
}