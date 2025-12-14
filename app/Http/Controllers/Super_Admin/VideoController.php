<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Show video index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.video.index');
    }

    /**
     * Return all videos for DataTable.
     */
    public function getall(Request $request)
    {
        $videos = Video::with(['department', 'company'])
            ->latest()
            ->get();

        return response()->json([
            'data' => $videos,
        ]);
    }

    /**
     * Show single video.
     */
    public function show(Request $request, $id)
    {
        $video = Video::with(['department', 'company'])->find($id);

        if (!$video) {
            abort(404, 'Video not found');
        }

        return view('super_admin.video.show', compact('video'));
    }
}
