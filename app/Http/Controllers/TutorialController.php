<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
  public function index()
  {
    $tutorial = Tutorial::with('tags','comments')->orderBy('id','desc')->get();
    // $tutorial = Tutorial::with('comments')->where('id')->count();

    return $tutorial;
  }

  public function store(Request $request)
  {
    // $tutorial = $request->user()->tutorials()->create([
    //   'title' => $request->json('title'),
    //   'slug' => str_slug($request->json('title')),
    //   'body' => $request->json('body'),
    // ]);

      $this->validate($request,[
        'title' => 'required',
        'body' => 'required',
      ]);

      $request->tags = Tag::find([2,4]);

      $tutorial = Tutorial::create([
          'title'   => $request->json('title'),
          'slug'    => str_slug($request->json('title')),
          'body'    => $request->json('body'),
          'user_id' => $request->user()->id
        ]);

      $tutorial->tags()->attach($request->tags);

      return $tutorial;
  }

  public function show($id)
  {
     $tutorial = Tutorial::with('comments')->where('id',$id)->first();
     return $tutorial;
  }

  public function update(Request $request,$id)
  {
    $this->validate($request,[
      'title' => 'required',
      'body' => 'required',
    ]);

    $tut = Tutorial::find($id);

    if ($request->user()->id != $tut->user_id) {
      return response()->json(['error' => 'Tidak Boleh Edit Tutorial Ini'], 403);
    }
    $tut->title = $request->title;
    $tut->slug = str_slug($request->title);
    $tut->body = $request->body;
    $tut->save();

    return $tut;

  }

  public function delete(Request $request,$id)
  {
     $tutorial = Tutorial::find($id);
     if ($request->user()->id != $tutorial->user_id) {
       return response()->json(['error' => 'Tidak Boleh delete Tutorial Ini'], 403);
     }
     $tutorial->delete();
     return response()->json([
        'tutorial' => $tutorial,
        'success' => true,
        'message' => "Successfully Delete"
     ],200);
   }
}
