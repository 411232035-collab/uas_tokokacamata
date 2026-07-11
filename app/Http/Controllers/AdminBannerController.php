<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminBannerController extends Controller
{
    public function index(): View
    {
        return view('admin.banner');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'banner.' . $extension;

            foreach (['banner.jpg', 'banner.jpeg', 'banner.png', 'banner.webp'] as $existing) {
                Storage::disk('public')->delete('landing/' . $existing);
            }

            Storage::disk('public')->putFileAs('landing', $file, $filename);
        }

        return redirect()->route('admin.banner')->with('success', 'Banner berhasil diunggah.');
    }
}
