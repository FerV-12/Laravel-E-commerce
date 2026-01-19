<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = SiteNotification::latest()->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markRead($id)
    {
        $note = SiteNotification::find($id);
        if ($note) {
            $note->update(['is_read' => true]);
            if (request()->wantsJson()) {
                return response()->json(['status' => 'ok']);
            }
        }

        return back();
    }

     public function markAllRead(Request $request)
    {
        $unread = $request->query('unread', false);
        $is_read = $unread ? false : true;

        SiteNotification::where('is_read', !$is_read)->update(['is_read' => $is_read]);

        if (request()->wantsJson()) {
            return response()->json(['status' => 'ok']);
        }

        return back();
    }
}
