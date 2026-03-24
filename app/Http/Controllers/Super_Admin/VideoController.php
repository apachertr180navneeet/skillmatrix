<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\{Video, VedioQuesans, Department};
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

        $departments = Department::get()->keyBy('id');

        foreach ($videos as $video) {
            $deptNames = [];

            if (!empty($video->department_id)) {
                $ids = explode(',', $video->department_id);

                foreach ($ids as $id) {
                    if (isset($departments[$id])) {
                        $deptNames[] = $departments[$id]->department_name;
                    }
                }
            }

            $video->department_names = implode(', ', $deptNames);
        }

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

        $deptNames = [];

        if (!empty($video->department_id)) {
            $departmentIds = explode(',', $video->department_id);

            $deptNames = Department::whereIn('id', $departmentIds)
                ->pluck('department_name')
                ->toArray();
        }

        $video->department_names = implode(', ', $deptNames);

        return view('super_admin.video.show', compact('video'));
    }


    public function showQA(Request $request, $id)
    {
        $video = Video::with(['department', 'company'])->find($id);

        $videoQUesAns = VedioQuesans::where('vedio_id', $id)->get();

        if (!$video) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.video.showqa', compact('video' , 'videoQUesAns'));
    }
}
