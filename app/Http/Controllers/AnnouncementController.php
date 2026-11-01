<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @group Announcements
 *
 * Create, read, update, delete, search and filter community announcements.
 */
class AnnouncementController extends Controller
{
    // READ (list) + SEARCH + FILTER
    public function index(Request $request)
    {
        $q = Announcement::with('category', 'user');

        if ($request->filled('search')) {
            $q->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $q->where('category_id', $request->category);
        }
        if ($request->filled('priority')) {
            $q->where('priority', $request->priority);
        }

        return view('announcements.index', [
            'announcements' => $q->latest('publish_date')->paginate(9)->withQueryString(),
            'categories'    => Category::all(),
        ]);
    }

    // READ (one)
    public function show(Announcement $announcement)
    {
        $announcement->load('category', 'user', 'feedback.user');
        return view('announcements.show', compact('announcement'));
    }

    // CREATE (form)
    public function create()
    {
        return view('announcements.create', ['categories' => Category::all()]);
    }

    // CREATE (save)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|max:150',
            'body'         => 'required',
            'category_id'  => 'required|exists:categories,id',
            'priority'     => 'required|in:normal,important,urgent',
            'publish_date' => 'required|date',
        ]);
        $data['user_id'] = session('user_id');

        Announcement::create($data);
        return redirect()->route('announcements.index')->with('success', 'Announcement posted.');
    }

    // UPDATE (form)
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', [
            'announcement' => $announcement,
            'categories'   => Category::all(),
        ]);
    }

    // UPDATE (save)
    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title'        => 'required|max:150',
            'body'         => 'required',
            'category_id'  => 'required|exists:categories,id',
            'priority'     => 'required|in:normal,important,urgent',
            'publish_date' => 'required|date',
        ]);

        $announcement->update($data);
        return redirect()->route('announcements.show', $announcement)->with('success', 'Announcement updated.');
    }

    // DELETE
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted.');
    }
}