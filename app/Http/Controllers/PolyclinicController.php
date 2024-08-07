<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\PolyclinicRequest;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PolyclinicController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Master Poliklinik', ['only' => ['index']]);
        $this->middleware('permission:Create Master Poliklinik', ['only' => ['create']]);
        $this->middleware('permission:Edit Master Poliklinik', ['only' => ['edit']]);
        $this->middleware('permission:Store Master Poliklinik', ['only' => ['store']]);
        $this->middleware('permission:Update Master Poliklinik', ['only' => ['update']]);
        $this->middleware('permission:Delete Master Poliklinik', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Polyclinic::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_poli', function ($row) {
                    return $row->kd_poli;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('open_at', function ($row) {
                    return $row->open_at;
                })
                ->addColumn('closed_at', function ($row) {
                    return $row->closed_at;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= "<a href='" . route('master.polyclinics.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning btn-sm' type='button' id='editMenu'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.master.polyclinic.index');
    }

    public function create()
    {
        $countPolyclinic = Polyclinic::count() + 1;
        $countPolyclinic = 'PC_' . str_pad($countPolyclinic, 3, '0', STR_PAD_LEFT);
        return view('pages.master.polyclinic.create', compact(['countPolyclinic']));
    }

    public function store(PolyclinicRequest $request)
    {
        try {
            $query = new Polyclinic();
            $query->name = $request->name;
            $query->kd_poli = $request->kd_poli;
            $query->open_at = $request->open_at;
            $query->closed_at = $request->closed_at;
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
        $polyclinic = Polyclinic::findOrFail($decodedId);
        return view('pages.master.polyclinic.edit', compact(['polyclinic']));
    }

    public function update(Request $request)
    {
        try {
            $query = Polyclinic::find($request->id);
            $query->name = $request->name;
            $query->kd_poli = $request->kd_poli;
            $query->open_at = $request->open_at;
            $query->closed_at = $request->closed_at;
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
            $query = Polyclinic::find(Main::hashIdsDecode($id));
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
