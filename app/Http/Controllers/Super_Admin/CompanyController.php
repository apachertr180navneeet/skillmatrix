<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;
use Exception;

class CompanyController extends Controller
{
    /**
     * Show company index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.company.index');
    }

    /**
     * Return all companies for DataTable.
     */
    public function getall(Request $request)
    {
        $companies = Company::latest()->get();

        return response()->json([
            'data' => $companies,
        ]);
    }

    /**
     * Update status (active / inactive) from table switch.
     */
    public function status(Request $request)
    {
        try {
            // from jQuery: companyId
            $company = Company::findOrFail($request->companyId);
            $company->status = $request->status;
            $company->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete a company by ID.
     */
    public function destroy($id)
    {
        try {
            Company::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Company deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store new company (Add modal).
     */
    public function store(Request $request)
    {
        $rules = [
            'name'    => 'required|string|max:191',
            'email'   => 'nullable|email|max:191|unique:companies,email',
            'phone'   => 'nullable|numeric|digits_between:7,15|unique:companies,phone',
            'address' => 'nullable|string|max:255',
            'city'    => 'nullable|string|max:100',
            'state'   => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'city'    => $request->city,
            'state'   => $request->state,
            'country' => $request->country,
            'status'  => 'active',
        ];

        // ✅ Logo upload + FULL URL store
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company', 'public'); // storage/app/public/company/...
            $fullUrl = asset('storage/' . $path);                       // https://yourdomain.com/storage/company/xyz.png
            $data['logo'] = $fullUrl;
        }

        Company::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Company saved successfully!',
        ]);
    }


    /**
     * Fetch single company for edit modal.
     */
    public function get($id)
    {
        $company = Company::findOrFail($id);

        return response()->json($company);
    }

    /**
     * Update company (Edit modal).
     */
    public function update(Request $request)
    {
        $rules = [
            'id'      => 'required|integer|exists:companies,id',
            'name'    => 'required|string|max:191',
            'email'   => [
                'nullable',
                'email',
                'max:191',
                Rule::unique('companies', 'email')->ignore($request->id),
            ],
            'phone'   => [
                'nullable',
                'numeric',
                'digits_between:7,15',
                Rule::unique('companies', 'phone')->ignore($request->id),
            ],
            'address' => 'nullable|string|max:255',
            'city'    => 'nullable|string|max:100',
            'state'   => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $company = Company::findOrFail($request->id);

        $updateData = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'city'    => $request->city,
            'state'   => $request->state,
            'country' => $request->country,
        ];

        // ✅ If new logo uploaded on update
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company', 'public');
            $fullUrl = asset('storage/' . $path);
            $updateData['logo'] = $fullUrl;
        }

        $company->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Company updated successfully',
        ]);
    }
}
