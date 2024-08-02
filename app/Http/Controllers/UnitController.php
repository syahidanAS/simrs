<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddProductUnitRequest;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Master Satuan Produk', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductUnit::orderBy('created_at', 'DESC')->get();
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
                    $btn .= "<button type='button' class='btn btn-warning btn-sm' type='button' id='editUnit' data-id='" . Main::hashIdsEncode($row->id) . "'>Ubah</button>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.master.unit.index');
    }

    public function create()
    {
        return view('pages.master.unit.create', compact(['countUnit']));
    }

    public function edit($id)
    {
        try {
            $user = ProductUnit::findOrFail(Main::hashIdsDecode($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data',
                'data' => $user,
                'role' => $user->roles[0]->name ?? null
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function store(AddProductUnitRequest $request)
    {
        try {
            $query = new ProductUnit();
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

    public function update(Request $request)
    {
        try {
            $query = ProductUnit::find($request->idEdit);
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
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $query = ProductUnit::find(Main::hashIdsDecode($id));
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
