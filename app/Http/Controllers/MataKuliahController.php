<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MataKuliahController extends Controller
{
    //create matkul
    public function CreateMatkul(){
        try {
            $data = request()->validate([
                'kode_matakuliah' => 'required|string|max:10|unique:matakuliahs',
                'nama_matakuliah' => 'required|string|max:255',
                'semester' => 'required|integer|min:1|max:8',
                'sks' => 'required|integer|min:1|max:4',
            ]);

            $matakuliah = Matakuliah::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Matakuliah created successfully',
                'data' => $matakuliah
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create matakuliah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //get All matkul
    public function GetAllMatkul(){
        try{
            $matakuliah = Matakuliah::all();
            return response()->json([
                'success' => true,
                'data' => $matakuliah
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve matakuliah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //get matkul
    public function GetMatkul($id){
        try {
            $matakuliah = Matakuliah::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $matakuliah
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve matakuliah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    //edit matkul
    public function EditMatkul($id){
        try {
            $data = request()->validate([
                'kode_matakuliah' => 'required|string|max:10|unique:matakuliahs,kode_matakuliah,'.$id,
                'nama_matakuliah' => 'required|string|max:255',
                'semester' => 'required|integer|min:1|max:8',
                'sks' => 'required|integer|min:1|max:4',
            ]);

            $matakuliah = Matakuliah::findOrFail($id);
            $matakuliah->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Matakuliah updated successfully',
                'data' => $matakuliah
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update matakuliah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    //delete matukul
    public function DeleteMatkul($id){
        try {
            $matakuliah = Matakuliah::findOrFail($id);
            $matakuliah->delete();

            return response()->json([
                'success' => true,
                'message' => 'Matakuliah deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete matakuliah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
