<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Sop,SopQuesAns};
use Exception;
use Illuminate\Support\Facades\Crypt;

class SopController extends Controller
{
    /**
     * Show sop index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.sop.index');
    }

    /**
     * Return all sop for DataTable.
     */
    public function getall(Request $request)
    {
        $sops = Sop::with(['department', 'company'])
           ->latest()
           ->get();

        return response()->json([
            'data' => $sops,
        ]);
    }

    /**
     * Return Show sop for.
     */
    public function show(Request $request, $id)
    {
        $sop = Sop::with(['department', 'company'])->find($id);

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.sop.show', compact('sop'));
    }

    public function showQA(Request $request, $id)
    {
        $sop = Sop::with(['department', 'company'])->find($id);

        $sopQuesAns = SopQuesAns::where('sop_id', $id)->get();

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.sop.showqa', compact('sop' , 'sopQuesAns'));
    }

    public function view($encryptedId)
    {
        try {
            $sopId = Crypt::decryptString($encryptedId);
        } catch (Exception $e) {
            abort(403, 'Invalid link');
        }

        $sop = Sop::findOrFail($sopId);

        $absolutePath = $this->resolveSopAbsolutePath($sop->sop_upload);

        abort_if(!$absolutePath, 404, 'SOP file not found');

        return response()->file($absolutePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($absolutePath) . '"',
        ]);
    }

    private function resolveSopAbsolutePath(?string $storedValue): ?string
    {
        if (!$storedValue) {
            return null;
        }

        $candidates = [];

        if (filter_var($storedValue, FILTER_VALIDATE_URL)) {
            $urlPath = ltrim((string) parse_url($storedValue, PHP_URL_PATH), '/');

            if ($urlPath !== '') {
                $candidates[] = public_path($urlPath);

                if (str_starts_with($urlPath, 'storage/')) {
                    $candidates[] = storage_path('app/public/' . substr($urlPath, 8));
                }
            }
        } else {
            $normalizedPath = ltrim(str_replace('\\', '/', $storedValue), '/');

            $candidates[] = storage_path('app/' . $normalizedPath);
            $candidates[] = storage_path('app/public/' . $normalizedPath);
            $candidates[] = public_path($normalizedPath);
        }

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
