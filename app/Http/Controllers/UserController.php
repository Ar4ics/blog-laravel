<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
        //return view('user.profile', compact('user'));
    }

    public function storeAvatar(Request $request, $id)
    {
        if (Gate::denies('add-to-user', $id)) {
            abort(403);
        }

        $user = Auth::user();
        $path = $request->file('avatar')->store(
            'images/'.$id
        );
        $user->avatar = $path;

        $user->save();

        return response()->json([
            'avatar' => $path
        ]);
        //return back();
    }

    public function storeInfo(Request $request, $id)
    {
        if (Gate::denies('add-to-user', $id)) {
            abort(403);
        }

        $user = Auth::user();

        $user->info = $request->input('info');

        $user->save();

        return response()->json([
            'info' => $user->info
        ]);

        //return back();
    }
}
