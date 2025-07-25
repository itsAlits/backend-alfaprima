<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = [
        'matakuliah_id',
        'user_id',
        'tahun_ajaran',
        'nama_kelas',
    ];

    /**
     * Get the user that owns the KRS.
     */
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
