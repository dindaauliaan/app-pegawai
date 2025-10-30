<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employees.index',compact('employees')); 
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
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $positions = Position::all();
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
}
