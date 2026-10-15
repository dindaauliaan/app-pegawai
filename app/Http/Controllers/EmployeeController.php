<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employees.index', compact('employees')); 
    }


    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create',compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|string|max:50',
        'department_id' => 'required|exists:departments,id',
        'jabatan_id' => 'required|exists:positions,id',
        ]);
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404, 'Data pegawai tidak ditemukan');
        }

        return view('employees.show', compact('employee'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        if (auth()->user()->role === 'employee' && auth()->id() != $id) {
            return redirect()->back()->with('error', 'Anda hanya bisa mengedit data Anda sendiri.');
        }
        return view('employees.edit',compact('employee','departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|string|max:50',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
                    'nama_lengkap',
                    'email',
                    'nomor_telepon',
                    'tanggal_lahir',
                    'alamat',
                    'tanggal_masuk',
                    'status',
        ]));
        if (auth()->user()->role === 'employee' && auth()->id() != $id) {
            return redirect()->back()->with('error', 'Anda tidak punya izin mengubah data ini.');
        }
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dihapus!');
    }
    public function dashboard()
    {
        $user = auth()->user();

        // safe-get employee id (fallback kalau belum diset)
        $employeeId = $user->employee_id ?? null;

        // jika employee_id belum diisi, jangan crash — beri nilai default
        if (!$employeeId) {
            // Kamu bisa redirect ke halaman profile agar admin mengaitkan user->employee,
            // atau tetap tampilkan dashboard tapi dengan data kosong:
            $todayAttendance   = null;
            $monthlyAttendance = 0;
            $workingDays       = 0;
            $lateCount         = 0;
            $remainingLeave    = 0;
            $salary            = 0;
            $recentAttendances = collect();
            $announcements     = collect();

            return view('employees.dashboard', compact(
                'todayAttendance',
                'monthlyAttendance',
                'workingDays',
                'lateCount',
                'remainingLeave',
                'salary',
                'recentAttendances',
                'announcements'
            ));
        }

        $today = Carbon::today();

        // Absensi hari ini (null jika belum absen)
        $todayAttendance = Attendance::where('karyawan_id', $employeeId)
            ->whereDate('tanggal', $today)
            ->first();

        // Absensi bulan ini (hanya yang status 'Hadir')
        $monthlyAttendance = Attendance::where('karyawan_id', $employeeId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->where('status_absensi', 'Hadir')
            ->count();

        // Hitung hari kerja (Senin-Jumat) di bulan ini
        $workingDays = $this->calculateWorkingDays(Carbon::now()->month, Carbon::now()->year);

        // Keterlambatan: masuk setelah 08:00:00
        $lateCount = Attendance::where('karyawan_id', $employeeId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->where('status_absensi', 'Hadir')
            ->where('waktu_masuk', '>', '08:00:00')
            ->count();

        // Cuti tersisa — contoh sederhana: total 12 hari/tahun dikurangi Izin/Sakit
        $totalLeave = 12;
        $usedLeave = Attendance::where('karyawan_id', $employeeId)
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereIn('status_absensi', ['Izin', 'Sakit'])
            ->count();
        $remainingLeave = max(0, $totalLeave - $usedLeave);

        // Gaji — ambil dari tabel employees jika ada kolom salary, kalau tidak set 0
        $employee = Employee::find($employeeId);
        $salary = optional($employee->salary)->total_gaji ?? 0;

        // Riwayat absensi terakhir (7 baris) untuk ditampilkan di dashboard
        $recentAttendances = Attendance::where('karyawan_id', $employeeId)
            ->orderBy('tanggal', 'desc')
            ->limit(7)
            ->get();

        // Pengumuman — jika belum ada model/tabel Announcement, ganti dengan collect()
        if (class_exists(\App\Models\Announcement::class)) {
            $announcements = Announcement::latest()->limit(5)->get();
        } else {
            $announcements = collect();
        }

        return view('employees.dashboard', compact(
            'todayAttendance',
            'monthlyAttendance',
            'workingDays',
            'lateCount',
            'remainingLeave',
            'salary',
            'recentAttendances',
            'announcements'
        ));
    }
    private function calculateWorkingDays($month, $year)
    {
        $start = Carbon::createFromDate($year, $month, 1);
        $end = $start->copy()->endOfMonth();
        $workingDays = 0;

        while ($start->lte($end)) {
            if ($start->isWeekday()) $workingDays++;
            $start->addDay();
        }

        return $workingDays;
    }

}
