<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = [
        'karyawan_id', 
        'tanggal', 
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi'
    ];
    protected $casts = [
        'tanggal' => 'date',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
    public function getIsLateAttribute()
    {
        if ($this->waktu_masuk && $this->status_absensi === 'Hadir') {
            return Carbon::parse($this->waktu_masuk)->format('H:i:s') > '08:00:00';
        }
        return false;
    }
}
