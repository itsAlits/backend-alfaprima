<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\krs;

class KrsController extends Controller
{
    //read krs by user_id
    public function getKrsByUserId($userId)
    {
        try {
            $krs = krs::with(['kelas','kelas.matakuliah', 'user'])
                ->where('user_id', $userId)
                ->get();

            //count sks
            $totalSks = 0;
            foreach ($krs as $k) {
                $totalSks += $k->kelas->matakuliah->sks;
            }

            return response()->json([
                'success' => true,
                'message' => 'KRS retrieved successfully',
                'data' => $krs,
                'total_sks' => $totalSks
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve KRS',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getKrsByUserIdAndTahunAkademik($userId, $tahunAkademik)
    {
        try {
            // Validate parameters directly from URL path
            $validator = \Validator::make([
                'userId' => $userId,
                'tahunAkademik' => $tahunAkademik
            ], [
                'tahunAkademik' => 'required|string|max:10',
                'userId' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $krs = krs::with(['kelas','kelas.matakuliah', 'user'])
                ->where('user_id', $userId)
                ->where('tahun_akademik', $tahunAkademik)
                ->get();

            //COUNT SKS
            $totalSks = 0;
            foreach ($krs as $k) {
                $totalSks += $k->kelas->matakuliah->sks;
            }

            return response()->json([
                'success' => true,
                'message' => 'KRS retrieved successfully',
                'data' => $krs,
                'total_sks' => $totalSks
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve KRS',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //create krs by user_id
    public function CreateKrs(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'kelas_id' => 'required|exists:kelas,id',
                'tahun_akademik' => 'required|string|max:10',
                'nilai_huruf' => 'nullable|string|max:5',
                'nilai_angka' => 'nullable|numeric|min:0|max:100',
                'status' => 'required|string|max:20',
            ]);

            $data['status'] = 'menunggu'; // Default status for new KRS
            $krs = krs::create($data);

            return response()->json([
                'success' => true,
                'message' => 'KRS created successfully',
                'data' => $krs
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create KRS',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //edit krs - dosen by user_id
    public function editKrsByUserIdForDosen(Request $request, $userId, $krsId)
    {
        try {
            $krs = krs::where('user_id', $userId)->find($krsId);
            if (!$krs) {
                return response()->json([
                    'success' => false,
                    'message' => 'KRS not found'
                ], 404);
            }

            $data = $request->validate([
                'kelas_id' => 'sometimes|exists:kelas,id',
                'tahun_akademik' => 'sometimes|string|max:10',
                'nilai_huruf' => 'sometimes|string|max:5',
                'nilai_angka' => 'sometimes|numeric|min:0|max:100',
                'status' => 'sometimes|string|max:20',
            ]);

            $krs->update($data);

            return response()->json([
                'success' => true,
                'message' => 'KRS updated successfully',
                'data' => $krs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update KRS',
                'error' => $e->getMessage()
            ], 500);
        }
    }
  
  // delete krs by user_id
    public function DeleteKrsByUserId($userId, $krsId)
    {
        try {
            $krs = krs::where('user_id', $userId)->find($krsId);
            if (!$krs) {
                return response()->json([
                    'success' => false,
                    'message' => 'KRS not found'
                ], 404);
            }

            $krs->delete();

            return response()->json([
                'success' => true,
                'message' => 'KRS deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete KRS',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
