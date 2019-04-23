@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Kategori - Ngedit Kategori')

@section('title', 'Ngedit Kategori')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Edit category nya disini sob</h4>
                <p class="card-category">Isi dibawah sokin</p>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nama Category nya</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
<br>
    
                    <a href="{{ URL::previous() }}" class="btn btn-danger" title="GAK JADI" rel="tooltip">
                        <i class="material-icons">keyboard_backspace</i>
                    </a>
                    <button type="submit" class="btn btn-info" title="SIMPEN" rel="tooltip">      
                        <i class="material-icons">save</i>
                    </button>
                    <div class="clearfix">
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
    
@endsection