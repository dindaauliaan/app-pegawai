<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salaries;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    public function index()
    {
        $salaries = Salaries::with('employee')->get();

        return view('salaries.index', compact('salaries'));
    }
    public function create(){
        $employees = DB::table('employees')->pluck('nama_lengkap', 'id');
        return view('salaries.create', compact('employees'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'=>'required|max:255',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
        ]);
        $validated['total_gaji'] = $this->hitungTotalGaji(
            $validated['gaji_pokok'],
            $validated['tunjangan'],
            $validated['potongan']
        );
        Salaries::create($validated);
        return redirect()->route('salaries.create')
                        ->with('success', 'Data gaji untuk bulan ' . $validated['bulan'] . ' berhasil ditambahkan!');
    }
    public function show(string $id)
    {
        return redirect()->route('salaries.index');
    }
    public function edit(string $id)
    {
        $salary = Salaries::find($id);
        $employees = DB::table('employees')->pluck('nama_lengkap', 'id');
        return view('salaries.edit',compact('salary','employees'));
    }
    public function update(Request $request, String $id){
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'=>'required|max:255',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
        ]);
        $validated['total_gaji'] = $this->hitungTotalGaji(
            $validated['gaji_pokok'],
            $validated['tunjangan'],
            $validated['potongan']
        );
        $salary = Salaries::find($id);
        $salary->update($validated);
        return redirect()->route('salaries.show', $id)->with('success', 'Data gaji untuk bulan ' . $validated['bulan'] . ' berhasil diupdate!');
    }
    public function destroy(string $id)
    {
        $salary = Salaries::find($id);
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus!');
    }
    private function hitungTotalGaji($gaji_pokok, $tunjangan, $potongan)
    {
        return ($gaji_pokok + $tunjangan) - $potongan;
    }
}
