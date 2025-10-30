@extends('layouts.master')
@section('title', 'Edit Data Gaji Karyawan')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="/salaries/{{ $salary->id }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Karyawan</label>
        <select class="form-select" aria-label="Default select example"name="karyawan_id">
            <option selected>Open this select menu</option>
            @foreach ($employees as $id => $nama)
                <option value="{{ $id }}" {{ $salary->karyawan_id == $id ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Bulan</label>
        <select class="form-select" aria-label="Default select example" name="bulan">
            <option selected>Open this select menu</option>
            @php
            $months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            @endphp
            @foreach ($months as $month)
                <option value="{{ $month }}" {{ $salary->bulan == $month ? 'selected' : '' }}>{{ $month }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Gaji Pokok</label>
        <input type="Number" class="form-control" name="gaji_pokok" value="{{ $salary->gaji_pokok }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Tunjangan</label>
        <input type="Number" class="form-control" name="tunjangan" value="{{ $salary->tunjangan }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Potongan</label>
        <input type="Number" class="form-control" name="potongan" value="{{ $salary->potongan }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection