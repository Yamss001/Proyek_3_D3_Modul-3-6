<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateActivityRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $activities = Activity::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy(
                'activity_date',
                $request->sort === 'oldest' ? 'asc' : 'desc'
            )
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $activity = Activity::create($request->validated());

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'status' => ['required'],
        ]);
        if ($activity->status === 'Done' && $request->status === 'Planned') {

            return back()->withErrors([
                'status' => 'Status tidak boleh mundur.',
            ]);

        }

        if (! in_array($request->status, ['Planned', 'Ongoing', 'Done'])) {
            return back()->withErrors(['status' => 'Status tidak dikenal.']);

        }
        $activity->title = $request->title;
        $activity->category_id = $request->category_id;
        $activity->status = $request->status;
        $activity->save();

        return redirect('/activities/'.$activity->id)
            ->with('success', 'Data diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
    public function publish(Activity $activity): RedirectResponse
    {
        if ($activity->status !== 'draft') {
            return back()->withErrors([
                'status' => 'Hanya kegiatan draft yang dapat dipublikasikan.',
            ]);
        }

        if (
            empty($activity->title) ||
            empty($activity->code) ||
            empty($activity->category_id) ||
            empty($activity->activity_date)
        ) {
            return back()->withErrors([
                'status' => 'Kegiatan belum lengkap dan belum dapat dipublikasikan.',
            ]);
        }

        $activity->status = 'published';
        $activity->save();

        return back()->with('success', 'Kegiatan berhasil dipublikasikan.');
    }

    public function complete(Activity $activity): RedirectResponse
    {
        if ($activity->status !== 'published') {
            return back()->withErrors([
                'status' => 'Hanya kegiatan published yang dapat diselesaikan.',
            ]);
        }

        $activity->status = 'completed';
        $activity->save();

        return back()->with('success', 'Kegiatan berhasil diselesaikan.');
    }
    public function restore($id): RedirectResponse
    {
        $activity = Activity::withTrashed()->findOrFail($id);

        $activity->restore();

        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil dipulihkan.');
    }
}
