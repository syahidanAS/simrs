<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGroup;
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
                ->addColumn('product_name', function ($row) {
                    $name = "<a href='javascript:void(0)' id='btnDetailProduct' data-id='" . Main::hashIdsEncode($row->id) . "'>$row->name</a>";
                    return $name;
                })
                ->addColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('basic_price', function ($row) {
                    return Main::formatRupiah($row->basic_price);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2 text-center">';
                    $btn .= "<a href='javascript:void(0)' class='btn btn-primary btn-sm' type='button' id='btnDetailProduct' data-id='" . Main::hashIdsEncode($row->id) . "'>Detail</a>";
                    $btn .= "<a href='" . route('master.cost.products.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning btn-sm' type='button' id='editMenu'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'product_name'])
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

    public function create()
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
        $categories = ProductCategory::where('name', 'like', "%$query%")->get();
        return $categories;
    }

    public function groups(Request $request)
    {
        $query = $request->get('q');
        $groups = ProductGroup::where('name', 'like', "%$query%")->get();
        return $groups;
    }

    public function store(AddProductRequest $request)
    {
        try {
            $query = new Product();
            $query->code = $request->code;
            $query->kfa_code = $request->kfa_code;
            $query->name = $request->name;
            $query->industry_id = $request->industry_id;
            $query->large_unit_id = $request->large_unit_id;
            $query->fill = $request->fill;
            $query->small_unit_id = $request->small_unit_id;
            $query->capacity = $request->capacity;
            $query->type_id = $request->type_id;
            $query->category_id = $request->category_id;
            $query->group_id = $request->group_id;
            $query->minimum_stock = $request->minimum_stock;
            $query->current_stock = $request->current_stock;
            $query->expired_date = $request->expired_date;
            $query->basic_price = $request->basic_price;
            $query->purchase_price = $request->purchase_price;
            $query->outpatient_price = $request->outpatient_price;
            $query->inpatient_price_class_1 = $request->inpatient_price_class_1;
            $query->inpatient_price_class_2 = $request->inpatient_price_class_2;
            $query->inpatient_price_class_3 = $request->inpatient_price_class_3;
            $query->inpatient_price_bpjs = $request->inpatient_price_bpjs;
            $query->inpatient_price_vip = $request->inpatient_price_vip;
            $query->inpatient_price_vvip = $request->inpatient_price_vvip;
            $query->content = $request->content;
            $query->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menyimpan data',
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $decodedId = Main::hashIdsDecode($id);
            $data = Product::with(['category', 'type', 'group', 'industry', 'smallUnit', 'largeUnit'])->findOrFail($decodedId);
            return view('pages.master.costs.medical_product.edit', compact(['data']));
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $query = Product::findOrFail($request->id);
            $query->code = $request->code;
            $query->kfa_code = $request->kfa_code;
            $query->name = $request->name;
            $query->industry_id = $request->industry_id;
            $query->large_unit_id = $request->large_unit_id;
            $query->fill = $request->fill;
            $query->small_unit_id = $request->small_unit_id;
            $query->capacity = $request->capacity;
            $query->type_id = $request->type_id;
            $query->category_id = $request->category_id;
            $query->group_id = $request->group_id;
            $query->minimum_stock = $request->minimum_stock;
            $query->current_stock = $request->current_stock;
            $query->expired_date = $request->expired_date;
            $query->basic_price = $request->basic_price;
            $query->purchase_price = $request->purchase_price;
            $query->outpatient_price = $request->outpatient_price;
            $query->inpatient_price_class_1 = $request->inpatient_price_class_1;
            $query->inpatient_price_class_2 = $request->inpatient_price_class_2;
            $query->inpatient_price_class_3 = $request->inpatient_price_class_3;
            $query->inpatient_price_bpjs = $request->inpatient_price_bpjs;
            $query->inpatient_price_vip = $request->inpatient_price_vip;
            $query->inpatient_price_vvip = $request->inpatient_price_vvip;
            $query->content = $request->content;
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
            $query = Product::find(Main::hashIdsDecode($id));
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
