<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddProductIndustryRequest;
use App\Models\ProductIndustry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndustryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Master Industri Produk', ['only' => ['index']]);
        $this->middleware('permission:Create Master Industri Produk', ['only' => ['create']]);
        $this->middleware('permission:Edit Master Industri Produk', ['only' => ['edit']]);
        $this->middleware('permission:Store Master Industri Produk', ['only' => ['store']]);
        $this->middleware('permission:Update Master Industri Produk', ['only' => ['update']]);
        $this->middleware('permission:Delete Master Industri Produk', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $industryGroup = ProductIndustry::count() + 1;
        $industryGroup = 'IN' . str_pad($industryGroup, 2, '0', STR_PAD_LEFT);

        if ($request->ajax()) {
            $data = ProductIndustry::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('address', function ($row) {
                    return $row->address;
                })
                ->addColumn('city', function ($row) {
                    return $row->city;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= "<button type='button' class='btn btn-warning btn-sm' type='button' id='editIndustry' data-id='" . Main::hashIdsEncode($row->id) . "'>Ubah</button>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.master.industry.index', compact(['industryGroup']));
    }

    public function create()
    {
        return view('pages.master.industries.create');
    }

    public function edit($id)
    {
        try {
            $data = ProductIndustry::findOrFail(Main::hashIdsDecode($id));
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

    public function store(AddProductIndustryRequest $request)
    {
        try {
            $query = new ProductIndustry();
            $query->code = $request->code;
            $query->name = $request->name;
            $query->address = $request->address;
            $query->city = $request->city;
            $query->phone = $request->phone;
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
            $query = ProductIndustry::find($request->idEdit);
            $query->code = $request->codeEdit;
            $query->name = $request->nameEdit;
            $query->address = $request->addressEdit;
            $query->city = $request->cityEdit;
            $query->phone = $request->phoneEdit;
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
            $query = ProductIndustry::find(Main::hashIdsDecode($id));
            $query->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus data',
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
