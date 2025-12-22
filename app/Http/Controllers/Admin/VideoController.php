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
        $companyId = auth()->user()->company_id;

        // ---------------- VALIDATION ----------------
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'video_upload'    => 'required|file',
            'description'   => 'nullable|string',
            'is_suggestion' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            // ---------------- FILE UPLOAD ----------------
            $fileUrl = null;

            if ($request->hasFile('video_upload')) {

                $file = $request->file('video_upload');

                // Example: video_1700000000.mp4
                $fileName = 'video_' . time() . '.' . $file->getClientOriginalExtension();

                // Store in storage/app/public/video
                $filePath = $file->storeAs('video', $fileName, 'public');

                // Generate FULL public URL
                $fileUrl = asset('storage/' . $filePath);
            }

            // ---------------- CREATE VIDEO ----------------
            Video::create([
                'title'         => $request->title,
                'department_id' => $request->department_id ?? 0,
                'description'   => $request->description,
                'video_file'  => $fileUrl,      // full URL
                'is_suggestion' => $request->is_suggestion,
                'party_id'      => $companyId,
            ]);

            return redirect()->route('admin.video.index')
                ->with('success', 'Video created successfully.');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
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
            'video_upload'  => 'nullable|file', // 50MB
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

            /* -------------------------------------------------
            VIDEO FILE UPLOAD
            ------------------------------------------------- */
            if ($request->hasFile('video_upload')) {

                // Delete old video if exists
                if ($video->video_upload) {
                    $oldPath = str_replace(asset('storage/'), '', $video->video_upload);
                    Storage::disk('public')->delete($oldPath);
                }

                $file = $request->file('video_upload');
                $fileName = 'video_' . time() . '.' . $file->getClientOriginalExtension();

                // Store in storage/app/public/videos
                $filePath = $file->storeAs('videos', $fileName, 'public');

                // Save public URL
                $video->video_file = asset('storage/' . $filePath);
            }

            /* -------------------------------------------------
            UPDATE VIDEO DATA
            ------------------------------------------------- */
            $video->update([
                'title'         => $validated['title'],
                'department_id' => $validated['department_id'] ?? null,
                'description'   => $validated['description'] ?? null,
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
}
