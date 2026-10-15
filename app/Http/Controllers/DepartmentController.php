<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function create(){
        return view('department.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
        'nama_department' => 'required|min:3|max:255',
    ]);
    Department::create($validated);

    return redirect()->route('department.create')
                    ->with('success', 'Department ' . $validated['nama_department'] . ' berhasil ditambahkan!');
    }

    public function index(){
        $departments = Department::latest()->get();
        return view('department.index',compact('departments'));
    }

    public function show(string $id)
    {
        $departments = Department::find($id);
        return view('department.show', compact('departments'));
    }
    public function edit(string $id)
    {
        $departments = Department::find($id);
        return view('department.edit',compact('departments'));
    }
    public function update(Request $request, String $id){
        $validated = $request->validate([
        'nama_department' => 'required|min:3|max:255',
        ]);
        $departments = Department::find($id);
        $departments->update($validated);
        return redirect()->route('department.index')->with('success', 'Data department ' . $validated['nama_department'] . ' berhasil diupdate!');
    }
    public function destroy(string $id)
    {
        $department = Department::find($id);

    if (!$department) {
        return redirect()->route('department.index')->with('error', 'Department tidak ditemukan.');
    }

    $departmentName = $department->nama_department;
    $department->delete();

    return redirect()->route('department.index')->with('success', 'Data department ' . $departmentName . ' berhasil dihapus!');
    }
}
