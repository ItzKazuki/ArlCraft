<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate();

        return view('dashboard.notifications.index')->with([
            'title' => 'My Notification',
            'notifications' => $notifications
        ]);
    }

    /** Display the specified resource. */
    public function show(string $id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);

        $notification->markAsRead();
        return view('dashboard.notifications.show')->with([
            'title' => $notification->data['title'],
            'notification' => $notification
        ]);
    }
}
