<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CmsController extends Controller
{
    /**
     * Show CMS index page.
     */
    public function index()
    {
        return view('super_admin.cms.index');
    }

    /**
     * Return all CMS records for DataTable.
     */
    public function getall()
    {
        $cms = Cms::latest()->get();

        return response()->json([
            'data' => $cms,
        ]);
    }

    /**
     * Store new CMS page (Add modal).
     */
    public function store(Request $request)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        Cms::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'CMS page created successfully',
        ]);
    }

    /**
     * Fetch single CMS page for edit modal.
     */
    public function get($id)
    {
        $cms = Cms::findOrFail($id);
        return response()->json($cms);
    }

    /**
     * Update CMS page (Edit modal).
     */
    public function update(Request $request)
    {
        $rules = [
            'id'          => 'required|exists:cms,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $cms = Cms::findOrFail($request->id);

        $cms->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'CMS page updated successfully',
        ]);
    }

    /**
     * Update CMS status (Active / Inactive switch).
     */
    public function status(Request $request)
    {
        try {
            $request->validate([
                'id'     => 'required|exists:cms,id',
                'status' => 'required|in:active,inactive',
            ]);

            $cms = Cms::findOrFail($request->id);
            $cms->status = $request->status;
            $cms->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete CMS page (Soft Delete).
     */
    public function destroy($id)
    {
        try {
            Cms::findOrFail($id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'CMS page deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
