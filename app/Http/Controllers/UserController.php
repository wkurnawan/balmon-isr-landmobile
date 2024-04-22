<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(User $user, UserRequest $userRequest)
    {
        $data = $userRequest->validated();
        $data['password'] = Hash::make($userRequest->password);

        $user->create($data);
        return redirect(route('users.index'))->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserRequest $updateUserRequest)
    {
        $data = $updateUserRequest->validated();
        $user->update($data);
        return redirect(route('users.index'))->with('success', 'Data user berhasil diperbarui.');
    }

    public function updatePassword(User $user, UpdatePasswordRequest $updatePasswordRequest)
    {
        $data = $updatePasswordRequest->validated();
        $data['password'] = Hash::make($updatePasswordRequest->password);
        $user->update($data);
        return redirect(route('users.index'))->with('success', 'Password berhasil diubah.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'Data user berhasil dihapus.');
    }

    public function editProfile(User $user)
    {
        return view('pages.users.profile', compact('user'));
    }

    public function updateProfile(User $user, UpdateProfileUserRequest $updateProfileUserRequest)
    {
        $data = $updateProfileUserRequest->validated();

        if ($updateProfileUserRequest->avatar) {
            // cek apakah file sudah terupload
            if ($updateProfileUserRequest->hasFile('avatar') && $updateProfileUserRequest->file('avatar')->isValid()) {
                $fileName = time() . '.' . $updateProfileUserRequest->avatar->extension();
                $updateProfileUserRequest->avatar->storeAs('public/avatars', $fileName);
                $data['avatar'] = $fileName;
            } else {
                return back()->with('error', 'Kesalahan Dalam Upload File.');
            }
        }
        $user->update($data);
        return back()->with('success', 'Data profile berhasil di perbarui.'); //mengembali ke halaman sebelumnya
    }

    public function updatePasswordProfile(User $user, UpdatePasswordProfileRequest $updatePasswordProfileRequest)
    {
        $data = $updatePasswordProfileRequest->validated();
        $data['password'] = Hash::make($updatePasswordProfileRequest->password);
        $user->update($data);
        return back()->with('success', 'Password profile berhasil di perbarui.');
    }
}
