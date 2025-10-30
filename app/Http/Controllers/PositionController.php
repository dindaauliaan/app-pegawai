<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index(){
        $positions = Position::latest()->get();
        return view('position.index',compact('positions'));
    }
    public function create(){
        $salaries = DB::table('salaries')->pluck('gaji_pokok', 'id');
        return view('position.create', compact('salaries'));
    }
    public function store(Request $request){
        $validated = $request->validate([
        'nama_jabatan' => 'required|min:3|max:255',
        'gaji_pokok' => 'required|numeric'
        ]);
        Position::create($validated);

        return redirect()->route('position.create')
                        ->with('success', 'Position ' . $validated['nama_jabatan'] . ' berhasil ditambahkan!');
    }
    public function show(string $id)
    {
        $positions = Position::find($id);
        return view('position.show', compact('positions'));
    }
    public function edit(string $id)
    {
        $position = Position::find($id);
        $salaries = DB::table('salaries')->pluck('gaji_pokok', 'id');
        return view('position.edit',compact('position','salaries'));
    }
    public function update(Request $request,String $id){
        $validated = $request->validate([
        'nama_jabatan' => 'required|min:3|max:255',
        'gaji_pokok' => 'required|numeric'
        ]);
        $position = Position::find($id);
        $position->update($validated);
        return redirect()->route('position.index')->with('success', 'Data position ' . $validated['nama_jabatan'] . ' berhasil diupdate!');
    }
    public function destroy(string $id){
        $position = Position::find($id);
        if (!$position) {
            return redirect()->route('position.index')->with('error', 'Position tidak ditemukan.');
        }
        $position->delete();
        return redirect()->route('position.index')->with('success', 'Position berhasil dihapus!');
    }
}
