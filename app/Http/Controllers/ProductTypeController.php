<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddProductTypeRequest;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Master Tipe Produk', ['only' => ['index']]);
        $this->middleware('permission:Create Master Tipe Produk', ['only' => ['create']]);
        $this->middleware('permission:Edit Master Tipe Produk', ['only' => ['edit']]);
        $this->middleware('permission:Store Master Tipe Produk', ['only' => ['store']]);
        $this->middleware('permission:Update Master Tipe Produk', ['only' => ['update']]);
        $this->middleware('permission:Delete Master Tipe Produk', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $productTypeCode = ProductType::count() + 1;
        $productTypeCode = 'J' . str_pad($productTypeCode, 3, '0', STR_PAD_LEFT);

        if ($request->ajax()) {
            $data = ProductType::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
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
        return view('pages.master.type.index', compact(['productTypeCode']));
    }

    public function create()
    {
        return view('pages.master.type.create');
    }

    public function edit($id)
    {
        try {
            $data = ProductType::findOrFail(Main::hashIdsDecode($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data',
                'data' => $data
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function store(AddProductTypeRequest $request)
    {
        try {
            $query = new ProductType();
            $query->code = $request->code;
            $query->name = $request->name;
            $query->desc = $request->desc;
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
            $query = ProductType::find($request->idEdit);
            $query->code = $request->codeEdit;
            $query->name = $request->nameEdit;
            $query->desc = $request->descEdit;
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
            $query = ProductType::find(Main::hashIdsDecode($id));
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
