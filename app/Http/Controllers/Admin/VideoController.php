<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Video,
    Department,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class VideoController extends Controller
{
    /**
     * Video listing page
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;
        
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        
        $videosuggestions = Video::where('party_id', $companyId)
            ->where('is_suggestion', '1')
            ->latest()
            ->get();


        $videos = Video::with('department')
            ->where('party_id', $companyId)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();

        return view('admin.video.index' , compact('videos', 'departments', 'videosuggestions'));
    }

    /**
     * Show the form for creating a new Video.
     */
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        return view('admin.video.create', compact('departments'));
    }

    /**
     * Store a newly created Video in storage.
     */
    public function store(Request $request)
    {

        
        try {
            
            $companyId = auth()->user()->company_id;
            // ---------------- VALIDATION ----------------
            $request->validate([
                'title'         => 'required|string|max:255',
                'department_id' => 'nullable|exists:departments,id',
                'is_link'       => 'required|in:yes,no',
                'video_link'    => 'required_if:is_link,yes|nullable|url',
                'video_upload'  => 'required_if:is_link,no|nullable|file',
                'description'   => 'nullable|string',
                'is_suggestion' => 'required|boolean',
            ]);

            $videoFileUrl = null;
            $videoLinkUrl = null;

            // ---------------- IF UPLOAD ----------------
            if ($request->is_link === 'no' && $request->hasFile('video_upload')) {

                $file = $request->file('video_upload');
                $fileName = 'video_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('video', $fileName, 'public');

                $videoFileUrl = asset('storage/' . $filePath);
            }

            // ---------------- IF LINK ----------------
            if ($request->is_link === 'yes') {
                $videoLinkUrl = $request->video_link;
            }

            // ---------------- CREATE VIDEO ----------------
            Video::create([
                'title'         => $request->title,
                'department_id' => $request->department_id ?? 0,
                'description'   => $request->description,
                'video_file'    => $videoFileUrl,
                'video_link'    => $videoLinkUrl,
                'is_link'       => $request->is_link,
                'is_suggestion' => $request->is_suggestion,
                'party_id'      => $companyId,
            ]);

            return redirect()->route('admin.video.index')
                ->with('success', 'Video created successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing a new Video.
     */
    public function edit($id)
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        $video = Video::where('id', $id)->where('party_id', $companyId)->first();
        

        return view('admin.video.edit', compact('departments', 'video'));
    }


    /**
     * Update Video
     */
    public function update(Request $request, $id)
    {
        $companyId = auth()->user()->company_id;

        /* -------------------------------------------------
        VALIDATION
        ------------------------------------------------- */
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',

            'is_link'       => 'required|in:yes,no',
            'video_link'    => 'required_if:is_link,yes|nullable|url',
            'video_upload'  => 'required_if:is_link,no|nullable|file|mimes:mp4,mov,avi',

            'description'   => 'nullable|string',
            'is_suggestion' => 'required|boolean',
        ]);

        try {

            /* -------------------------------------------------
            FETCH VIDEO (SECURITY CHECK)
            ------------------------------------------------- */
            $video = Video::where('id', $id)
                ->where('party_id', $companyId)
                ->firstOrFail();

            $videoFileUrl = $video->video_file; // keep old
            $videoLinkUrl = $video->video_link; // keep old

            /* -------------------------------------------------
            HANDLE VIDEO SOURCE
            ------------------------------------------------- */

            // ---------- UPLOAD VIDEO ----------
            if ($validated['is_link'] === 'no') {

                // If new file uploaded
                if ($request->hasFile('video_upload')) {

                    // Delete old file if exists
                    if ($video->video_file) {
                        $oldPath = str_replace(asset('storage/'), '', $video->video_file);
                        Storage::disk('public')->delete($oldPath);
                    }

                    $file = $request->file('video_upload');
                    $fileName = 'video_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('videos', $fileName, 'public');

                    $videoFileUrl = asset('storage/' . $filePath);
                }

                // Clear link
                $videoLinkUrl = null;
            }

            // ---------- VIDEO LINK ----------
            if ($validated['is_link'] === 'yes') {

                $videoLinkUrl = $validated['video_link'];

                // Delete old uploaded file if exists
                if ($video->video_file) {
                    $oldPath = str_replace(asset('storage/'), '', $video->video_file);
                    Storage::disk('public')->delete($oldPath);
                }

                $videoFileUrl = null;
            }

            /* -------------------------------------------------
            UPDATE VIDEO DATA
            ------------------------------------------------- */
            $video->update([
                'title'         => $validated['title'],
                'department_id' => $validated['department_id'] ?? null,
                'description'   => $validated['description'] ?? null,

                'is_link'       => $validated['is_link'],
                'video_file'    => $videoFileUrl,
                'video_link'    => $videoLinkUrl,

                'is_suggestion' => $validated['is_suggestion'],
            ]);

            return redirect()
                ->route('admin.video.index')
                ->with('success', 'Video updated successfully.');

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Video update failed. Please try again.');
        }
    }

    /**
     * Remove the specified SOP from storage.
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $video = Video::where('id', $id)
                ->firstOrFail();

            $video->delete(); // SOFT DELETE

            return redirect()->back()
                ->with('success', 'Video deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to delete Video.');
        }
    }

    public function filter(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $query = Video::with('department')
            ->where('party_id', $companyId);

        // 🔍 Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Filter by department
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $videos = $query->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }
}
