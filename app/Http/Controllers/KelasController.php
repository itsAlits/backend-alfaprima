<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;

class KelasController extends Controller
{
    //get all kelas
    public function getAllKelas(){
        try {
            $kelas = kelas::with(['matakuliah', 'user'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Kelas retrieved successfully',
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //create kelas
    public function createKelas(Request $request){
        try {
            $data = $request->validate([
                'matakuliah_id' => 'required|exists:matakuliahs,id',
                'user_id' => 'required|exists:users,id',
                'tahun_ajaran' => 'required|string|max:10',
                'nama_kelas' => 'required|string|max:255',
            ]);

            $kelas = kelas::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Kelas created successfully',
                'data' => $kelas
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    //edit kelas

    public function editKelas(Request $request, $id){
        try {
            $kelas = kelas::find($id);
            if(!$kelas){
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas not found'
                ], 404);
            }

            $data = $request->validate([
                'matakuliah_id' => 'sometimes|exists:matakuliahs,id',
                'user_id' => 'sometimes|exists:users,id',
                'tahun_ajaran' => 'sometimes|string|max:10',
                'nama_kelas' => 'sometimes|string|max:255',
            ]);

            $kelas->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Kelas updated successfully',
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //delete kelas

    public function deleteKelas($id){
        try {
            $kelas = kelas::find($id);
            if(!$kelas){
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas not found'
                ], 404);
            }

            $kelas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kelas deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
