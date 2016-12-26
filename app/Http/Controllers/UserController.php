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
        $this->middleware('jwt.auth', ['except' => ['show', 'showPosts']]);
    }

    public function index()
    {
        return User::all();
    }

    public function profile() 
    {
        $user = Auth::user();
        $count = $user->articles()->count();
        $user->count = $count;
        return $user;

    }

    public function show($name)
    {
        $user = User::where('name', $name)->first();
        if (is_null($user))
        {
            return response()->json(['error' => 'user not found'], 404);
        }

        $count = $user->articles()->count();
        $user->count = $count;
        return $user;
        //return view('user.profile', compact('user'));
    }

    public function showPosts($name) {
        $user = User::where('name', $name)->first();
        return $user->articles()->with('user')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request, $id)
    {
        if (Gate::denies('add-to-user', $id)) {
            abort(403);
        }

        $user = Auth::user();
        
        

        if ($request->file('avatar') != null)
        {
            $path = $request->file('avatar')->store(
            'images/'.$id
            );

            $user->avatar = $path;
        }


        if ($request->input('info') != null)
        {
            $user->info = $request->input('info');
        }

        if ($request->input('rank') != null)
        {
            $user->rank = $request->input('rank');
        }

        
        $user->save();

        return response()->json([
            'avatar' => $user->avatar,
            'info' => $user->info,
            'rank' => $user->rank
        ]);

        //return back();
    }
}
