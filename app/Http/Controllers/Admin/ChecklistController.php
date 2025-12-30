<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Checklist,
    Department,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class ChecklistController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        
        $checklistsuggestions = Checklist::where('party_id', $companyId)
            ->where('is_suggestion', '1')
            ->latest()
            ->get();


        $checklists = Checklist::with('department')
            ->where('party_id', $companyId)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();
        return view('admin.checklist.index', compact('checklistsuggestions', 'checklists', 'departments'));
    }

    /**
     * Show the form for creating a new SOP.
     */
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        return view('admin.checklist.create', compact('departments'));
    }

    /**
     * Store a newly created SOP in storage.
     */
    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;
        
        // ---------------- VALIDATION ----------------
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'checklist_upload'    => 'required|file',
            'description'   => 'nullable|string',
            'is_suggestion'     => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            // ---------------- FILE UPLOAD ----------------
            $fileUrl = null;

            if ($request->hasFile('checklist_upload')) {

                $file = $request->file('checklist_upload');
                $fileName = 'checklist_' . time() . '.' . $file->getClientOriginalExtension();

                // Store file publicly
                $filePath = $file->storeAs('checklists', $fileName, 'public');

                // Public URL
                $fileUrl = asset('storage/' . $filePath);
            }


            // ---------------- CREATE Checklist ----------------
            Checklist::create([
                'title'             => $request->title,
                'department_id'     => $request->department_id ?? '0',
                'description'       => $request->description,
                'file'              => $fileUrl,   // FULL URL stored
                'is_suggestion'     => $request->is_suggestion,
                'party_id'          => $companyId,
            ]);

            return redirect()->route('admin.checklist.index')
                ->with('success', 'Checklist created successfully.');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing a new SOP.
     */
    public function edit($id)
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        $checklist = Checklist::where('id', $id)->where('party_id', $companyId)->first();
        return view('admin.checklist.edit', compact('departments', 'checklist'));
    }

    /**
     * Update the specified Checklist in storage.
     */

    public function update(Request $request, $id)
    {
        $companyId = auth()->user()->company_id;

        // ---------------- VALIDATION ----------------
        $validator = Validator::make($request->all(), [
            'title'             => 'required|string|max:255',
            'department_id'     => 'nullable|exists:departments,id',
            'checklist_upload'  => 'nullable|file',
            'description'       => 'nullable|string',
            'is_suggestion'     => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ---------------- FIND CHECKLIST ----------------
        $checklist = Checklist::where('id', $id)
            ->where('party_id', $companyId)
            ->firstOrFail();

        // ---------------- FILE UPLOAD ----------------
        if ($request->hasFile('checklist_upload')) {

            $file = $request->file('checklist_upload');
            $fileName = 'checklist_' . time() . '.' . $file->getClientOriginalExtension();

            // Store file publicly
            $filePath = $file->storeAs('checklists', $fileName, 'public');

            // Public URL
            $fileUrl = asset('storage/' . $filePath);

            // Update checklist_upload
            $checklist->file = $fileUrl;
        }

        // ---------------- UPDATE DATA ----------------
        $checklist->update([
            'title'          => $request->title,
            'department_id'  => $request->department_id,
            'description'    => $request->description,
            'is_suggestion'  => $request->is_suggestion,
        ]);

        return redirect()
            ->route('admin.checklist.index')
            ->with('success', 'Checklist updated successfully');
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
            $checklist = Checklist::where('id', $id)
                ->firstOrFail();

            $checklist->delete(); // SOFT DELETE

            return redirect()->back()
                ->with('success', 'Checklist deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to delete Checklist.');
        }
    }


    public function filter(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $query = Checklist::with('department')
            ->where('party_id', $companyId);

        // 🔍 Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Department filter
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $checklists = $query->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $checklists
        ]);
    }
}
