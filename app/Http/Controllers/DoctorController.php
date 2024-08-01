<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\AddDoctorRequest;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Master Dokter', ['only' => ['index']]);
        $this->middleware('permission:Edit Dokter', ['only' => ['edit']]);
        $this->middleware('permission:Delete Dokter', ['only' => ['destroy']]);
        $this->middleware('permission:Store Dokter', ['only' => ['store']]);
        $this->middleware('permission:Update Dokter', ['only' => ['update']]);
    }
    public function index(Request $request)
    {
        $res = Doctor::with('specialist')->get();

        if ($request->ajax()) {
            $data = Doctor::with('specialist')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $name = "";
                    if (!$row->front_degree) {
                        $name = $row->name . ". " . $row->back_degree;
                    } else if (!$row->back_degree) {
                        $name = $row->front_degree . ". " . $row->name;
                    } else if (!$row->front_degree && !$row->back_degree) {
                        $name = $row->name;
                    } else {
                        $name = $row->front_degree . ". " . $row->name . ", " . $row->back_degree;
                    }
                    return $name;
                })
                ->addColumn('specialist', function ($row) {
                    return $row->specialist->name;
                })
                ->addColumn('gender', function ($row) {
                    return ($row->gender == "male") ? "Laki-laki" : "Perempuan";
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-2">';
                    $btn .= "<a href='" . route('master.doctors.edit', ['id' => Main::hashIdsEncode($row->id)]) . "' class='btn btn-warning text-light btn-sm' type='button' id='editDocter'>Ubah</a>";;
                    $btn .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-item' data-id='" . Main::hashIdsEncode($row->id) . "' data-name='" . $row->name . "'>Hapus</a>";
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.master.doctor.index');
    }

    public function create()
    {
        return view('pages.master.doctor.create');
    }

    public function specialitiesList(Request $request)
    {
        try {
            $query = $request->get('q');
            $specialities = Specialist::where('name', 'like', "%$query%")->get();
            return $specialities;
        } catch (\Throwable $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan data karena terjadi kesalahan!',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function store(AddDoctorRequest $request)
    {
        try {
            $query = new Doctor();
            $query->id_number = $request->id_number;
            $query->front_degree = $request->front_degree;
            $query->back_degree = $request->back_degree;
            $query->name = $request->name;
            $query->address = $request->address;
            $query->specialist_id = $request->specialist_id;
            $query->phone_number = $request->phone_number;
            $query->gender = $request->gender;
            $query->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan data!',
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
        $decodeId = Main::hashIdsDecode($id);
        $doctor = Doctor::with('specialist')->findOrFail($decodeId);
        return view('pages.master.doctor.edit', compact(['doctor']));
    }

    public function update(Request $request)
    {
        try {
            $query = Doctor::find($request->id);
            $query->id_number = $request->id_number;
            $query->front_degree = $request->front_degree;
            $query->back_degree = $request->back_degree;
            $query->name = $request->name;
            $query->address = $request->address;
            $query->specialist_id = $request->specialist_id;
            $query->phone_number = $request->phone_number;
            $query->gender = $request->gender;
            $query->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah data!',
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
            $query = Doctor::find(Main::hashIdsDecode($id));
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
