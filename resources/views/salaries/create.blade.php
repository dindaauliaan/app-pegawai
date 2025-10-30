@extends('layouts.master')
@section('title', 'Form Input Salaries')
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
<form action="/salaries" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Karyawan</label>
        <select class="form-select" aria-label="Default select example"name="karyawan_id">
            <option selected>Open this select menu</option>
            @foreach ($employees as $id => $nama)
                <option value="{{ $id }}">{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Bulan</label>
        <select class="form-select" aria-label="Default select example" name="bulan">
            <option selected>Open this select menu</option>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Gaji Pokok</label>
        <input type="Number" class="form-control" name="gaji_pokok">
    </div>
    <div class="mb-3">
        <label class="form-label">Tunjangan</label>
        <input type="Number" class="form-control" name="tunjangan">
    </div>
    <div class="mb-3">
        <label class="form-label">Potongan</label>
        <input type="Number" class="form-control" name="potongan">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection