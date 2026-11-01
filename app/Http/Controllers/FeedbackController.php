<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Feedback;
use Illuminate\Http\Request;

/**
 * @group Feedback
 *
 * Users send, edit and delete feedback on announcements.
 */
class FeedbackController extends Controller
{
    private function authorizeOwner(Feedback $feedback)
    {
        if (session('user_id') != $feedback->user_id && session('user_role') !== 'admin') {
            abort(403);
        }
    }

    public function store(Request $request, Announcement $announcement)
    {
        $data = $request->validate(['message' => 'required|max:1000']);
        $announcement->feedback()->create([
            'user_id' => session('user_id'),
            'message' => $data['message'],
        ]);
        return back()->with('success', 'Feedback submitted.');
    }

    public function edit(Feedback $feedback)
    {
        $this->authorizeOwner($feedback);
        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $this->authorizeOwner($feedback);
        $data = $request->validate(['message' => 'required|max:1000']);
        $feedback->update($data);
        return redirect()->route('announcements.show', $feedback->announcement_id)->with('success', 'Feedback updated.');
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorizeOwner($feedback);
        $announcementId = $feedback->announcement_id;
        $feedback->delete();
        return redirect()->route('announcements.show', $announcementId)->with('success', 'Feedback deleted.');
    }
}