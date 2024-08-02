<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Models\ProductIndustry;
use App\Models\ProductType;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicalProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Harga Obat/Alkes', ['only' => ['index']]);
        $this->middleware('permission:Detail Obat/Alkes', ['only' => ['detail']]);
        $this->middleware('permission:Create Harga Obat/Alkes', ['only' => ['create']]);
    }
    public function index(Request $request)
    {
        $data = Product::with(['category', 'group', 'industry', 'type', 'smallUnit', 'largeUnit'])->get();
        if ($request->ajax()) {
            $data = Product::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('kfa_code', function ($row) {
                    return $row->kfa_code;
                })
                ->addColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('large_unit', function ($row) {
                    return $row->largeUnit->name;
                })
                ->addColumn('fill', function ($row) {
                    return $row->fill;
                })
                ->addColumn('small_unit', function ($row) {
                    return $row->smallUnit->name;
                })
                ->addColumn('capacity', function ($row) {
                    return $row->capacity;
                })
                ->addColumn('basic_price', function ($row) {
                    return Main::formatRupiah($row->basic_price);
                })
                ->addColumn('current_stock', function ($row) {
                    return $row->current_stock;
                })
                ->addColumn('minimum_stock', function ($row) {
                    return $row->minimum_stock;
                })
                ->addColumn('expired_date', function ($row) {
                    return $row->expired_date;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2 text-center">';
                    $btn .= "<a href='javascript:void(0)' class='btn btn-primary text-light btn-sm' type='button' id='btnDetailProduct' data-id='" . Main::hashIdsEncode($row->id) . "'>Detail</a>";
                    $btn .= "<a href='" . route('setting.access-utilities.permissions.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning text-light btn-sm' type='button' id='editMenu'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.master.costs.medical_product.index');
    }
    public function detail($id)
    {
        try {
            $product = Product::with(['category', 'group', 'industry', 'type', 'smallUnit', 'largeUnit'])->findOrFail(Main::hashIdsDecode($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data',
                'data' => $product,
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function create(AddProductRequest $request)
    {
        $product = Product::count() + 1;
        $countProduct = 'PR' . str_pad($product, 3, '0', STR_PAD_LEFT);
        return view('pages.master.costs.medical_product.create', compact(['countProduct',]));
    }

    public function industries(Request $request)
    {
        $query = $request->get('q');
        $industries = ProductIndustry::where('name', 'like', "%$query%")->get();
        return $industries;
    }
    public function units(Request $request)
    {
        $query = $request->get('q');
        $units = ProductUnit::where('name', 'like', "%$query%")->get();
        return $units;
    }
    public function types(Request $request)
    {
        $query = $request->get('q');
        $types = ProductType::where('name', 'like', "%$query%")->get();
        return $types;
    }

    public function categories(Request $request)
    {
        $query = $request->get('q');
        $categories = ProductType::where('name', 'like', "%$query%")->get();
        return $categories;
    }

    public function groups(Request $request)
    {
        $query = $request->get('q');
        $groups = ProductType::where('name', 'like', "%$query%")->get();
        return $groups;
    }

    public function store(Request $request)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data',
                'data' => $request->all(),
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
