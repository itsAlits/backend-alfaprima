<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class krs extends Model
{
    protected $fillable = [
        'user_id',
        'kelas_id',
        'nilai_huruf',
        'nilai_angka',
        'status',
    ];

    /**
     * Get the user that owns the KRS.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kelas associated with the KRS.
     */
    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }
}
