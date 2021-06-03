<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function updateReadState(Request $request, $notificationType)
    {
        // Need to check if user can really change this state
        $notificationIds = explode(",", $request->input('notificationIds'));
        if($notificationType == 'commentNotification') {
            DB::table('tb_comment_notification')->whereIn('id', $notificationIds)->update(['read' => true]);
        } else if($notificationType == 'favouriteNotification') {
            DB::table('tb_favourite_notification')->whereIn('id', $notificationIds)->update(['read' => true]);
        } else if($notificationType == 'deleteNotification') {
            DB::table('tb_delete_notification')->whereIn('id', $notificationIds)->update(['read' => true]);
        }
        return response()->json(['message' => 'Succeed!']);
    }
}
