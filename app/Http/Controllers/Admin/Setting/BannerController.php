<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\PopupBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Show the form for editing the popup banner
     */
    public function edit()
    {
        // Get the latest active banner or create a new empty one
        $banner = PopupBanner::latest()->first() ?? new PopupBanner();

        return view('admin.setting.banner', compact('banner'));
    }

    /**
     * Update the popup banner in storage
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        // Get the existing banner or create new if none exists
        $banner = PopupBanner::latest()->first() ?? new PopupBanner();

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = $request->file('image')->store('popup_banners', 'public');
            $banner->image = $imagePath;
        }

        // Update banner properties
        $banner->title = $request->title;
        $banner->is_active = $request->has('is_active');
        $banner->save();

        return redirect()->route('admin.setting.banner')
            ->with('success', 'Popup banner updated successfully');
    }

    /**
     * Display active banner on frontend
     */
    public function showActive()
    {
        $popupBanner = PopupBanner::where('is_active', true)->latest()->first();
        return view('user.home', compact('popupBanner'));
    }
}
