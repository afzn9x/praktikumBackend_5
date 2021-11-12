<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Stub\Stub;

class StudentController extends Controller {

    public function index()
    {
        $data = Student::all();

        return response()->json($data, 200);
    }


    public function create(Request $request)
    {
       //menerima data requst dari body
        $data = [
            'nama' => 'required',
            'nim' => 'numeric|required',
            'jurusan' => 'required',
            'email' => 'email|required'
        ];

        $validator = Validator::make($request->all(), $data);
        if ($validator->fails()) {
            $valid = [
                'message' => 'salah satu inputan salah'
            ];
            return response()->json($valid, 404);
        } else {
            //menerima data requst dari body
            $nama = $request->nama;
            $nim = $request->nim;
            $jurusan = $request->jurusan;
            $email = $request->email;

            $student = Student::create(
                [
                    //insert data ke database->Student
                    'nama' => $nama,
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'email' => $email
                ]
            );

            $data = [
                'message' => 'Student is Created Successfully',
                'data' => $student
            ];
            return response()->json($data, 201);
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'mendapatkan detail data',
                'data' => $student
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'data tidak ditemukan',
                'data' => $student
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->update([
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ]);

            $data = [
                'message' => 'data berhasil diupdate',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'data tidak ditemukan',
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();

            $data = [
                'message' => 'data berhasil dihapus'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'data tidak ditemukan'
            ];
            return response()->json($data, 404);
        }
    }
}
