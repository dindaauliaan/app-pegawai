<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Position;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Summary untuk admin dashboard
        $totalPegawai    = Employee::count();
        $absenHariIni    = Attendance::whereDate('tanggal', Carbon::today())->count();
        $totalDepartment = Department::count();
        $totalPosisi     = Position::count();

        // 🔥 Tambahan: ambil 10 absensi terbaru untuk ditampilkan di dashboard admin
        $attendances = Attendance::with('employee')
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu_masuk', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPegawai',
            'absenHariIni',
            'totalDepartment',
            'totalPosisi',
            'attendances'
        ));
    }
}
