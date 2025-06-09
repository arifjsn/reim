<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Reimbursement;
use App\Models\ReimbursementDetail;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ReimbursementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $department = $user->department->nama_departemen ?? null;

        if ($department === "HR") {
            $data = Reimbursement::orderBy('status')->get();
            return view('hr-reimbursement', ['reimbursement' => $data]);
        } elseif ($department === "FINANCE") {
            $data = Reimbursement::where(function ($query) {
                $query->where('status', 'accepted')
                      ->orWhere('status', 'claimed');
            })->orderBy('status')->get();
            return view('fin-reimbursement', ['reimbursement' => $data]);
        } else {
            $data = Reimbursement::where('id_user', $user->nip)->get()->map(function ($item) {
                $item->tanggal = $item->created_at->format('d F Y');
                return $item;
            });
            return view('reimbursement', ['reimbursement' => $data]);
        }
    }

    public function claimFormFilled($id)
    {
        $data = Reimbursement::find($id);

        if (!$data) {
            return redirect()->route('reimbursement.index');
        }

        $department = Auth::user()->department->nama_departemen ?? null;

        if ($department === "HR") {
            return view('hr-claim-form-filled', ['detail' => $data]);
        } elseif ($department === "FINANCE") {
            return view('fin-claim-form-filled', ['detail' => $data]);
        } else {
            return view('claim-form-filled', ['detail' => $data]);
        }
    }

    public function claimForm()
    {
        return view('claim-form');
    }

    public function claim(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $request->validate([
                    'kategori' => 'nullable',
                    'from' => 'required',
                    'to' => 'required',
                    'bukti' => 'nullable|mimes:zip,rar'
                ]);

                $reimbursementValue = [
                    'id_user' => Auth::user()->nip,
                    'kategori' => $request->kategori,
                    'bukti' => '',
                    'from' => $request->from,
                    'to' => $request->to,
                    'status' => 'accepted'
                ];

                // Simpan data reimbursement dan dapatkan id-nya
                $id = Reimbursement::create($reimbursementValue)->id;

                // Upload file jika ada
                if ($request->hasFile('bukti')) {
                    $file = $request->file('bukti');
                    $setNamaFile = $id . Auth::user()->nip . "." . $file->getClientOriginalExtension();
                    $file->storeAs('public/bukti', $setNamaFile);

                    // Simpan nama file pada database
                    Reimbursement::where('id', $id)->update(['bukti' => $setNamaFile]);
                }

                // Simpan data detail reimbursement
                $jumlahRow = count($request->tanggal);
                for ($i = 0; $i < $jumlahRow; $i++) {
                    $request->validate([
                        'tanggal' => 'required',
                        'deskripsi' => 'required',
                        'pengeluaran' => 'required'
                    ]);

                    $detailValue = [
                        'id_reimbursement' => $id,
                        'tanggal' => $request->tanggal[$i],
                        'deskripsi' => $request->deskripsi[$i],
                        'pengeluaran' => $request->pengeluaran[$i]
                    ];

                    ReimbursementDetail::create($detailValue);
                }
            });

            return redirect()->route('reimbursement.index')->with('success', 'Reimbursement anda telah berhasil diajukan');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Maaf Terjadi Kesalahan, Claim Gagal Diajukan")->withInput();
        }
    }

    public function verification(Request $request)
    {
        // Implementasi verifikasi jika diperlukan
    }

    public function markClaimed(Request $request)
    {
        // Implementasi mark claimed jika diperlukan
    }

    public function updateStatus(Request $request)
    {
        $reimbursement = Reimbursement::find($request->id);
        if ($reimbursement) {
            $reimbursement->update(['status' => $request->status]);
        }
        return redirect()->route('reimbursement.index');
    }

    public function cancelClaim(Request $request)
    {
        $reimbursement = Reimbursement::find($request->id);

        if ($reimbursement) {
            // Hapus file bukti jika ada
            $path = storage_path('app/public/bukti/' . $reimbursement->bukti);
            if ($reimbursement->bukti && file_exists($path)) {
                unlink($path);
            }
            // Hapus data reimbursement
            $reimbursement->delete();
        }

        return redirect()->route('reimbursement.index');
    }
}
