<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddIcdxRequest;
use App\Models\DiagnoseIcdX;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiagnoseIcdxController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show ICD-X', ['only' => ['index']]);
        $this->middleware('permission:Create ICD-X', ['only' => ['create']]);
        $this->middleware('permission:Edit ICD-X', ['only' => ['edit']]);
        $this->middleware('permission:Store ICD-X', ['only' => ['store']]);
        $this->middleware('permission:Update ICD-X', ['only' => ['update']]);
        $this->middleware('permission:Delete ICD-X', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DiagnoseIcdX::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('name_en', function ($row) {
                    return $row->name_en;
                })
                ->addColumn('name_id', function ($row) {
                    return $row->name_id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= "<a href='" . route('master.diagnose.icd_x.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning btn-sm' type='button' id='editMenu'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name_id . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $data;
        }
        return view('pages.master.diagnose_icd_x.index');
    }

    public function create()
    {
        return view('pages.master.diagnose_icd_x.create');
    }

    public function store(AddIcdxRequest $request)
    {
        try {
            $query = new DiagnoseIcdX();
            $query->code = $request->code;
            $query->name_en = $request->name_en;
            $query->name_id = $request->name_id;
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

    public function edit($id)
    {
        $decodedId = Main::hashIdsDecode($id);
        $data = DiagnoseIcdX::findOrFail($decodedId);
        return view('pages.master.diagnose_icd_x.edit', compact(['data']));
    }

    public function update(Request $request)
    {
        try {
            $query = DiagnoseIcdX::find($request->idEdit);
            $query->code = $request->codeEdit;
            $query->name_en = $request->name_enEdit;
            $query->name_id = $request->name_idEdit;
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


    public function destroy($id)
    {
        try {
            $query = DiagnoseIcdX::find(Main::hashIdsDecode($id));
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
}
