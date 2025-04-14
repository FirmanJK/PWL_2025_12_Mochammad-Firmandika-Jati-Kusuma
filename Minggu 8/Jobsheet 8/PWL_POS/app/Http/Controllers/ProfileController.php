<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profil()
    {
    $user = auth()->user(); // Ambil user yang sedang login
    $activeMenu = 'profil'; // Set menu yang aktif
    $breadcrumb = (object) [
        'title' => 'Profil Saya',
        'list'  => ['Home', 'Profil Saya']
    ];

    $page = (object) [
        'title' => 'Daftar user yang terdaftar dalam sistem'
    ];

    return view('profile.index', compact('user', 'activeMenu', 'breadcrumb', 'page'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
            'activeMenu' => 'profile',
            'breadcrumb' => (object)[
                'title' => 'Edit Profil',
                'list' => ['Home', 'Profil', 'Edit']
            ]
        ]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|max:5120', // maksimal 5MB
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists('profile/' . $user->profile_photo)) {
                Storage::disk('public')->delete('profile/' . $user->profile_photo);
            }

            $file = $request->file('profile_photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $filename, 'public');

            $user->profile_photo = $filename;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}