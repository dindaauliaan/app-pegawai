<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->get();
        return view('attendance.index', compact('attendances'));
    }
    public function create()
    {
        $employees = DB::table('employees')->pluck('nama_lengkap', 'id');
        return view('attendance.create', compact('employees'));
    }
    public function store(Request $request){
        $request->validate([
        'karyawan_id' => 'required',
    ]);

    Attendance::create([
        'karyawan_id' => $request->karyawan_id,
        'tanggal' => now()->toDateString(),
        'waktu_masuk' => now()->toTimeString(),
        'status_absensi' => 'Hadir', // hanya diisi saat absen masuk
    ]);

    return redirect()->route('attendance.index')->with('success', 'Absen masuk berhasil.');
    }
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
            $attendance->update([
                'waktu_keluar' => now()->toTimeString(),
            ]);

            return redirect()->route('attendance.index')->with('success', 'Absen keluar berhasil.');
    }
    public function destroy(String $id){
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->route('attendance.index')->with('error', 'Data absensi tidak ditemukan.');
        }

        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil dihapus!');
    }
    public function checkIn()
    {
        $employeeId = auth()->user()->employee_id;

        // Cek apakah sudah absen hari ini
        $today = Attendance::where('karyawan_id', $employeeId)
            ->whereDate('tanggal', now()->toDateString())
            ->first();

        if ($today) {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini.');
        }

        Attendance::create([
            'karyawan_id' => $employeeId,
            'tanggal' => now()->toDateString(),
            'waktu_masuk' => now()->toTimeString(),
            'status_absensi' => 'Hadir',
        ]);

        return redirect()->back()->with('success', 'Check-in berhasil!');
    }

    public function checkOut()
    {
        $employeeId = auth()->user()->employee_id;

        // Ambil absensi hari ini
        $today = Attendance::where('karyawan_id', $employeeId)
            ->whereDate('tanggal', now()->toDateString())
            ->first();

        if (!$today) {
            return redirect()->back()->with('error', 'Anda belum check-in.');
        }

        if ($today->waktu_keluar) {
            return redirect()->back()->with('error', 'Anda sudah check-out hari ini.');
        }

        $today->update([
            'waktu_keluar' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Check-out berhasil!');
    }

}
