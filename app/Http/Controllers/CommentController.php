<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tutorial;
use App\Models\Notification;

class CommentController extends Controller
{
  public function index()
  {
     $comments = Comment::with('tutorial')->orderBy('id','desc')->get();
     return $comments;
  }

  public function store(Request $request,$id)
  {
      $this->validate($request,[
        'body' => 'required',
      ]);

      $tutorial = Tutorial::find($id);

      $comment = $request->user()->comments()->create([
        'body' => $request->json('body'),
        'tutorial_id' => $id
      ]);

      if ($tutorial->user->id != $request->user()->id) {
        $notification = Notification::create([
          "subject" => "Ada Komentar dari ".$request->user()->username,
          "user_id" => $tutorial->user->id,
          "tutorial_id" => $id
        ]);
        
        return response()->json([
          'comment' => $comment,
           'notification' => $notification,
           'success' => true,
           'message' => "Successfully Insert Notification And Comment"
        ],200);
      }

      return response()->json([
        'comment' => $comment,
         'success' => true,
         'message' => "Successfully Insert And Comment"
      ],200);  }

  public function update(Request $request,$id)
  {

      $this->validate($request,[
        'body' => 'required',
      ]);

      $comment = Comment::find($id);
      if ($request->user()->id != $comment->user_id) {
        return response()->json(['error' => 'Tidak Boleh Edit Comment Ini'], 403);
      }
      $comment->body = $request->body;
      $comment->save();
      return $comment;
  }

  public function show($id)
  {
    $comment = Comment::with('tutorial')->where('id',$id)->first();
      if ($comment == null) {
        return response()->json(['error' => 'id tidak di temukan'], 403);
      }
     return $comment;
  }

  public function delete(Request $request, $id)
  {
    $comment = Comment::find($id);
    if ($request->user()->id != $comment->user_id) {
      return response()->json(['error' => 'Tidak Boleh Delete Comment Ini'], 403);
    }
    $comment->delete();
    return response()->json([
       'comment' => $comment,
       'success' => true,
       'message' => "Successfully Delete"
    ],200);
  }
}
