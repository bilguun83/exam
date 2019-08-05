@extends('layouts.app')

@section('content')
    <h1>Шалгалт нэмэх EXCEL</h1>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Laravel 5.8 Import Export Excel to database Example - ItSolutionStuff.com
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import User Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection

