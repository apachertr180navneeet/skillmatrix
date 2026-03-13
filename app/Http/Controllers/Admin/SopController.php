<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Exception;

class SopController extends Controller
{
    /**
     * SOP listing page
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)
            ->where('status', 'active')
            ->get();

        $departmentList = $departments->pluck('department_name','id')->toArray();

        $sops = Sop::where('party_id', $companyId)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();

        foreach ($sops as $sop) {

            $deptNames = [];

            if (!empty($sop->department_id)) {

                $ids = explode(',', $sop->department_id);

                foreach ($ids as $id) {

                    $id = trim($id);

                    if(isset($departmentList[$id])){
                        $deptNames[] = $departmentList[$id];
                    }
                }
            }

            $sop->department_names = implode(', ', $deptNames);
        }


        return view('admin.sop.index', compact('sops','departments'));
    }

    /**
     * Show create SOP form
     */
    public function create()
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)
            ->where('status', 'active')
            ->get();

        return view('admin.sop.create', compact('departments'));
    }

    /**
     * Store SOP (PRIVATE FILE)
     */
    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $validator = Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'department_id'  => 'nullable|array',
            'department_id.*'=> 'exists:departments,id',
            'sop_upload'     => 'required|file|mimes:pdf|max:10240',
            'description'    => 'nullable|string',
            'is_suggestion'  => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $filePath = null;

            if ($request->hasFile('sop_upload')) {

                $file = $request->file('sop_upload');

                $fileName = 'sop_' . time() . '.' . $file->getClientOriginalExtension();

                // private storage
                $filePath = $file->storeAs('sop', $fileName, 'local');
            }

            // Convert department array to comma separated
            $departmentIds = null;

            if ($request->department_id) {
                $departmentIds = implode(',', $request->department_id);
            }

            Sop::create([
                'title'          => $request->title,
                'department_id'  => $departmentIds,
                'description'    => $request->description,
                'sop_upload'     => $filePath,
                'is_suggestion'  => $request->is_suggestion,
                'party_id'       => $companyId,
            ]);

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP created successfully.');

        } catch (Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong.')
                ->withInput();
        }
    }

    /**
     * Edit SOP
     */
    public function edit($id)
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)
            ->where('status', 'active')
            ->get();

        $sop = Sop::where('id', $id)
            ->where('party_id', $companyId)
            ->firstOrFail();

        return view('admin.sop.edit', compact('departments', 'sop'));
    }

    /**
     * Update SOP
     */
    public function update(Request $request, $id)
    {
        $companyId = auth()->user()->company_id;

        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'department_id'   => 'nullable|array',
            'department_id.*' => 'exists:departments,id',
            'sop_upload'      => 'nullable|file|mimes:pdf|max:10240',
            'description'     => 'nullable|string',
            'is_suggestion'   => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $sop = Sop::where('id', $id)
                ->where('party_id', $companyId)
                ->firstOrFail();

            // Convert department array to comma separated
            $departmentIds = null;

            if ($request->department_id) {
                $departmentIds = implode(',', $request->department_id);
            }

            // File Upload
            if ($request->hasFile('sop_upload')) {

                $file = $request->file('sop_upload');

                $fileName = 'sop_' . time() . '.' . $file->getClientOriginalExtension();

                // Delete old file
                if ($sop->sop_upload && Storage::exists($sop->sop_upload)) {
                    Storage::delete($sop->sop_upload);
                }

                $filePath = $file->storeAs('sop', $fileName, 'local');

                $sop->sop_upload = $filePath;
            }

            $sop->title = $request->title;
            $sop->department_id = $departmentIds;
            $sop->description = $request->description;
            $sop->is_suggestion = $request->is_suggestion;

            $sop->save();

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP updated successfully.');

        } catch (Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong.')
                ->withInput();
        }
    }

    /**
     * Delete SOP (Soft Delete)
     */
    public function destroy($id)
    {
        try {
            $sop = Sop::where('id', $id)->firstOrFail();
            $sop->delete();

            return redirect()->back()->with('success', 'SOP deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to delete SOP.');
        }
    }

    /**
     * AJAX Filter (Search + Department)
     */
    public function filter(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $query = Sop::where('party_id', $companyId);

        /* 🔍 Search by title */
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        /* 🏷️ Department filter (comma separated ids) */
        if ($request->filled('department_id')) {
            $query->whereRaw("FIND_IN_SET(?, department_id)", [$request->department_id]);
        }

        $sops = $query->latest()->get();

        /* -------- Get Departments -------- */
        $departments = Department::where('company_id', $companyId)
            ->get()
            ->keyBy('id');

        /* -------- Convert department ids to names -------- */
        foreach ($sops as $sop) {

            $deptNames = [];

            if (!empty($sop->department_id)) {

                $ids = explode(',', $sop->department_id);

                foreach ($ids as $id) {
                    if (isset($departments[$id])) {
                        $deptNames[] = $departments[$id]->department_name;
                    }
                }
            }

            $sop->department_names = implode(', ', $deptNames);
        }

        return view('admin.sop.table_rows', compact('sops'))->render();
    }

    /**
     * 🔐 SECURE VIEW SOP PDF (ENCRYPTED)
     */
    public function view($encryptedId)
    {
        try {
            $sopId = Crypt::decryptString($encryptedId);
        } catch (Exception $e) {
            abort(403, 'Invalid link');
        }

        $sop = Sop::where('id', $sopId)
            ->where('party_id', auth()->user()->company_id)
            ->firstOrFail();

        return redirect($sop->sop_upload);
    }
}
