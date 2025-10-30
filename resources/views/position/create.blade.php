@extends('layouts.master')
@section('title', 'Form Input Position')
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
    <form action="/position" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan" >
        </div>
        <div class="mb-3">
            <select class="form-select" name="gaji_pokok" aria-label="Default select example">
                <option selected>Open this select menu</option>
                @foreach ($salaries as $id => $gaji_pokok)
                    <option value="{{ $gaji_pokok }}">{{ $gaji_pokok }}</option>
                @endforeach
            </select>
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
