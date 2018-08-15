<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutorial;
use App\Models\Comment;
use App\Models\Tag;

class UserController extends Controller
{
    public function show(Request $request)
    {
      $user = User::with('tutorials.tags')
              ->where('id', $request->user()->id)
              ->first();
      return $user;
    }
}
