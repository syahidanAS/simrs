<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddIcdIxRequest;
use App\Models\ProcedureIcdIxCm;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcedureIcdIxCmController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show ICD-IX CM', ['only' => ['index']]);
        $this->middleware('permission:Create ICD-IX CM', ['only' => ['create']]);
        $this->middleware('permission:Edit ICD-IX CM', ['only' => ['edit']]);
        $this->middleware('permission:Store ICD-IX CM', ['only' => ['store']]);
        $this->middleware('permission:Update ICD-IX CM', ['only' => ['update']]);
        $this->middleware('permission:Delete ICD-IX CM', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProcedureIcdIxCm::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= "<a href='" . route('master.procedure.icd_ix_cm.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning btn-sm' type='button' id='editMenu'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $data;
        }
        return view('pages.master.procedure_icd_ix_cm.index');
    }

    public function create()
    {
        return view('pages.master.procedure_icd_ix_cm.create');
    }

    public function store(AddIcdIxRequest $request)
    {
        try {
            $query = new ProcedureIcdIxCm();
            $query->code = $request->code;
            $query->name = $request->name;
            $query->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan data',
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $query = ProcedureIcdIxCm::find(Main::hashIdsDecode($id));
            $query->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus data',
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $decodedId = Main::hashIdsDecode($id);
        $data = ProcedureIcdIxCm::findOrFail($decodedId);
        return view('pages.master.procedure_icd_ix_cm.edit', compact(['data']));
    }

    public function update(Request $request)
    {
        try {
            $query = ProcedureIcdIxCm::find($request->idEdit);
            $query->code = $request->codeEdit;
            $query->name = $request->nameEdit;
            $query->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengubah data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
