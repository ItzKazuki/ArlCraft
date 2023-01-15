<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Notifications\DynamicNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationAdminController extends Controller
{
    /**
     * Show the form for seding notifications to the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function index(User $user)
    {
        return view('admin.user.notifications', [
            'title' => 'Send Notification'
        ]);
    }

    /**
     * Get a JSON response of users.
     *
     * @return \Illuminate\Support\Collection|\App\models\User
     */
    public function json(Request $request)
    {
        $users = QueryBuilder::for(User::query())
            ->allowedFilters(['id', 'name', 'email'])
            ->paginate(25);

        if ($request->query('user_id')) {
            $user = User::query()->findOrFail($request->input('user_id'));
            $user->avatarUrl = $user->getAvatar();

            return $user;
        }

        return $users->map(function ($item) {
            $item->avatarUrl = $item->getAvatar();

            return $item;
        });
    }

    /**
     * Notify the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function notify(Request $request)
    {
        $data = $request->validate([
            "via" => "required|min:1|array",
            "via.*" => "required|string|in:mail,database",
            "all" => "required_without:users|boolean",
            "users" => "required_without:all|min:1|array",
            "users.*" => "exists:users,id",
            "title" => "required|string|min:1",
            "content" => "required|string|min:1"
        ]);

        $mail = null;
        $database = null;
        $name = Auth::user()->name;

        if (in_array('database', $data["via"])) {
            $database = [
                'name' => $name,
                'email' => Auth::user()->email,
                "title" => $data["title"],
                "content" => $data["content"]
            ];
        }
        
        if (in_array('mail', $data["via"])) {
            $mail = (new MailMessage)
                ->subject($data["title"])
                ->line('From : ' . $name)
                ->line(new HtmlString($data["content"]));
        }

        $all = $data["all"] ?? false;
        $users = $all ? User::all() : User::whereIn("id", $data["users"])->get();

        Notification::send($users, new DynamicNotification($data["via"], $database, $mail));

        return redirect()->route('admin.notifications')->with('success', 'Notification sent!');
    }
}
