@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Tag - Ngedit Tag')

@section('title', 'Ngedit Tag')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Edit Tag nya disini sob</h4>
                <p class="card-category">Isi dibawah sokin</p>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nama Tag nya</label>
                                <input type="text" class="form-control" name="name" value="{{ $tag->name }}">
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="{{ URL::previous() }}" class="btn btn-danger" title="GAK JADI" rel="tooltip">
                        <i class="material-icons">keyboard_backspace</i>
                    </a>
                    <button type="submit" class="btn btn-info" title="SIMPEN" rel="tooltip">      
                            <i class="material-icons">save</i>
                    </button>
                    <div class="clearfix"></div>
                </form>

            </div>
        </div>
    </div>
</div>
    
@endsection