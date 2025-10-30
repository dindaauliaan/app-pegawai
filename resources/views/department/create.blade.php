@extends('layouts.master')
@section('title', 'Form Input Department')
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
    <form action="/department" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Department</label>
            <input type="text" class="form-control" name="nama_department" >
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
