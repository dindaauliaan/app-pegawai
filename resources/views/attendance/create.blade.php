@extends('layouts.master')
@section('title', 'Absensi Pegawai')
@section('content')
<form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                <option value="">-- Pilih --</option>
                @foreach($employees as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Absen Masuk Sekarang</button>
</form>
@endsection