<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Sop,
    Department,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class SopController extends Controller
{
    /**
     * SOP listing page
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        
        $sopsuggestions = Sop::where('party_id', $companyId)
            ->where('is_suggestion', '1')
            ->latest()
            ->get();


        $sops = Sop::with('department')
            ->where('party_id', $companyId)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();

        return view('admin.sop.index' , compact('sops', 'departments', 'sopsuggestions'));
    }


    /**
     * Show the form for creating a new SOP.
     */
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();
        return view('admin.sop.create', compact('departments'));
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
            'sop_upload'    => 'required|file',
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

            if ($request->hasFile('sop_upload')) {

                $file = $request->file('sop_upload');
                $fileName = 'sop_' . time() . '.' . $file->getClientOriginalExtension();

                // Store file publicly
                $filePath = $file->storeAs('sop', $fileName, 'public');

                // Public URL
                $fileUrl = asset('storage/' . $filePath);
            }


            // ---------------- CREATE SOP ----------------
            Sop::create([
                'title'         => $request->title,
                'department_id' => $request->department_id ?? '0',
                'description'   => $request->description,
                'sop_upload'    => $fileUrl,   // FULL URL stored
                'is_suggestion'     => $request->is_suggestion,
                'party_id'      => $companyId,
            ]);

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP created successfully.');

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
        $sop = Sop::where('id', $id)->where('party_id', $companyId)->first();
        

        return view('admin.sop.edit', compact('departments', 'sop'));
    }


    /**
     * update function
     */

    public function update(Request $request, $id){
        $companyId = auth()->user()->company_id;

        // ---------------- VALIDATION ----------------
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'sop_upload'    => 'nullable|file',
            'description'   => 'nullable|string',
            'is_suggestion'     => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $sop = Sop::where('id', $id)
                ->where('party_id', $companyId)
                ->firstOrFail();

            // ---------------- FILE UPLOAD ----------------
            if ($request->hasFile('sop_upload')) {

                $file = $request->file('sop_upload');
                $fileName = 'sop_' . time() . '.' . $file->getClientOriginalExtension();

                // Store file publicly
                $filePath = $file->storeAs('sop', $fileName, 'public');

                // Public URL
                $fileUrl = asset('storage/' . $filePath);

                // Update sop_upload
                $sop->sop_upload = $fileUrl;
            }

            // ---------------- UPDATE SOP ----------------
            $sop->title = $request->title;
            $sop->department_id = $request->department_id ?? '0';
            $sop->description = $request->description;
            $sop->is_suggestion = $request->is_suggestion;
            $sop->save();

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP updated successfully.');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
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
            $sop = Sop::where('id', $id)
                ->firstOrFail();

            $sop->delete(); // SOFT DELETE

            return redirect()->back()
                ->with('success', 'SOP deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Unable to delete SOP.');
        }
    }
}
