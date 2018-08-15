<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
      Notification::where('user_id', $request->user()->id)->where('seen',0)->update(['seen'=>1]);
      $notification = Notification::where('user_id', $request->user()->id)->orderBy('id','desc')->get();

      return response()->json([
        'notification' => $notification,
         'success' => true,
         'message' => "Successfully update Notification seen"
      ],200);

    }
}
