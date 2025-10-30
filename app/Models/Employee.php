<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'department_id',
        'jabatan_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
    // Relasi ke Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    // Relasi ke Salary
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }
}
