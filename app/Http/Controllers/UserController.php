<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //get all users
    public function getAllUser(){
        try {
            $users = User::with('role')->get();
            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //update user
    public function updateUser(Request $request, $id){
        try {
            $user = User::find($id);
            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $data = $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users,email,'.$user->id,
                'phone_number' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:500',
                'birth_date' => 'nullable|date',
                'gender' => 'nullable|string|in:Laki-laki,Perempuan',
                'religion' => 'nullable|string|in:Islam,Katolik,Protestan,Hindu,Budha',
                'profile_picture' => 'nullable|string',
            ]);

            $user->update($data);
            $user->load('role');

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //delete user
    public function deleteUser($id){
        try {
            $user = User::find($id);
            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    //get user by roles mahasiswa
    public function getMahasiswa(){
        try{
            $mahasiswaUsers = User::whereHas('role', function($query) {
                $query->where('name', 'Mahasiswa');
            })->with('role')->get();

            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa retrieved successfully',
                'data' => $mahasiswaUsers
            ], 200);

        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve mahasiswa users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDosen(){
        try{
            $mahasiswaUsers = User::whereHas('role', function($query) {
                $query->where('name', 'Dosen');
            })->with('role')->get();

            return response()->json([
                'success' => true,
                'message' => 'Dosen retrieved successfully',
                'data' => $mahasiswaUsers
            ], 200);

        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve mahasiswa users',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
