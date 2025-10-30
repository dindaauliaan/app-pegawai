@extends('layouts.master')
@section('title', 'Form Edit Data Position')
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
    <form action="/position/{{ $position->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan" value="{{ $position->nama_jabatan }}">
        </div>
        <div class="mb-3">
            <select class="form-select" name="salary_id" aria-label="Default select example">
                <option disabled>Open this select menu</option>
                @foreach ($salaries as $id => $gaji_pokok)
                    <option value="{{ $id }}" 
                        {{ $position->salary_id == $id ? 'selected' : '' }}>
                        {{ number_format($gaji_pokok, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
    <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection
