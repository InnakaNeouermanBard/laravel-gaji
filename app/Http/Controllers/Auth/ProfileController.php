<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        //cek auth
        $this->checkAuth([0]);

        $user = User::find(auth()->user()->id_user);

        return view('ubah_profile')
            ->with('user', $user);
    }

    public function ubah_profile(Request $request)
    {
        $user = User::find(auth()->user()->id_user);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id_user . ',id_user',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return $this->setResponse(true, "Berhasil merubah profile");
    }

    public function ubah_avatar(Request $request)
    {
        $user = User::find(auth()->user()->id_user);

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'avatar.required' => 'Pilih file terlebih dahulu',
            'avatar.image' => 'File harus bertipe gambar',
            'avatar.mimes' => 'File yang diperbolehkan berformat jpeg,png,jpg,gif,svg',
            'avatar.max' => 'Maksimal ukuran file 2mb'
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        //remove old avatar
        $oldAvatar = public_path('assets/img/avatar/') . $user->avatar;
        if (file_exists($oldAvatar) && $user->avatar) {
            unlink($oldAvatar);
        }

        $avatar = $request->file('avatar');
        $random = rand(1, 100000);
        $avatarName = $random . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('assets/img/avatar'), $avatarName);

        $user->avatar = $avatarName;


        $user->save();

        return $this->setResponse(true, "Avatar Updated");
    }

    public function ubah_password(Request $request)
    {
        $user = User::find(auth()->user()->id_user);

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'old_password' => 'required',
        ], [
            'old_password.required' => 'Password lama tidak boleh kosong',
            'password.required' => 'Password baru tidak boleh kosong',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password baru tidak sama dengan password lama',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        //check old password
        if (!password_verify($request->old_password, $user->password)) {
            return $this->setResponse(false, "Password lama salah");
        }

        $user->password = bcrypt($request->password);

        $user->save();

        return $this->setResponse(true, "Sukses mengubah password");
    }
}
