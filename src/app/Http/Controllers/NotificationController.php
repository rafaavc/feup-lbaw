<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    /**
     * Check if user can update the notification.
     *
     * @param  String  $type
     * @param  array  $listIds
     * @return boolean
     */
    public function checkCanUpdate($type, $listIds) {
        if($type == 'deleteNotification') {
            return DB::table('tb_delete_notification')->whereIn('id', $listIds)->where('id_receiver', Auth::user()->id)->count() == count($listIds);
        }
        else if($type == 'favouriteNotification') {
            $favouritedRecipes = DB::table('tb_favourite_notification')->select('id_recipe')->whereIn('id', $listIds)->get();
            $newFavouritedRecipes = $favouritedRecipes->map(function($id) {
                return $id->id_recipe;
            });
            $newFavouritedRecipes = $newFavouritedRecipes->toArray();
            return Recipe::whereIn('id', $newFavouritedRecipes)->where('id_member', Auth::user()->id)->count() == count($newFavouritedRecipes);
        }
        else if($type == 'commentNotification') {
            $refComments = DB::table('tb_comment_notification')->select('id_comment')->whereIn('id', $listIds)->get();
            $newRefComments = $refComments->map(function($id) {
                return $id->id_comment;
            });
            $newRefComments = $newRefComments->toArray();
            $userRecipes = Comment::select('id_recipe')->whereIn('id', $newRefComments)->get();
            $userRecipesIds = $userRecipes->map(function($id) {
                return $id->id_recipe;
            });
            $userRecipesIds = $userRecipesIds->toArray();
            return Comment::whereIn('id', $newRefComments)->where('id_recipe', $userRecipesIds)->count() == count($newRefComments);
        }

        return false;
    }

    /**
     * Update read state of notifications.
     *
     * @param  Request  $request
     * @param  String  $notificationType
     * @return boolean
     */
    public function updateReadState(Request $request, $notificationType)
    {
        if(!Auth::check())
            return response()->json(['message' => 'Operation Forbidden!'], 403);

        $notificationIds = explode(",", $request->input('notificationIds'));

        if(!$this->checkCanUpdate($notificationType, $notificationIds))
            return response()->json(['message' => 'Operation Forbidden!'], 403);

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
