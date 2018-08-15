<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
      $tags = Tag::all();
      return $tags;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'title' => 'required',
        ]);

        $tag = Tag::create([
          'title' => $request->json('title'),
        ]);
        return $tag;
    }

    public function update(Request $request,$id)
    {
      $this->validate($request,[
        'title' => 'required',
      ]);

      $tag = Tag::find($id);
      $tag->update([
        'title' => $request->json('title'),
      ]);
      return $tag;
    }

    public function delete($id)
    {
      $tag = Tag::find($id);
      $tag->delete();
      return response()->json([
         'tag' => $tag,
         'success' => true,
         'message' => "Successfully Delete"
      ],200);
    }
}
