<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of all notifications.
     */
    public function index()
    {
        // Saari notifications pagination ke sath
        $notifications = Notification::latest()->paginate(15);
        $unreadCount = Notification::where('is_read', 0)->count();

        return view('admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark all notifications as read (AJAX & Direct support).
     */
    public function markAsRead(Request $request)
    {
        Notification::where('is_read', 0)->update(['is_read' => 1]);

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'All notifications marked as read.'
            ]);
        }

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Mark a single notification as read and redirect to relevant link.
     */
    public function read($id)
    {
        $notification = Notification::findOrFail($id);
        
        if (!$notification->is_read) {
            $notification->update(['is_read' => 1]);
        }

        // Agar notification ke sath link attach ho to wahan redirect kare, nahi to default bookings par
        if (!empty($notification->link)) {
            return redirect($notification->link);
        }

        return redirect()->route('bookings.index');
    }

    /**
     * Delete a single notification.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Clear/Delete all read notifications.
     */
    public function clearAll()
    {
        Notification::where('is_read', 1)->delete();

        return redirect()->back()->with('success', 'All read notifications cleared successfully.');
    }
}