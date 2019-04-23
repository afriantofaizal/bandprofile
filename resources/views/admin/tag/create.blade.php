@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Tag - Bikin Tag')

@section('title', 'Bikin Tag')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Tambahin Tag Baru Sob</h4>
                <p class="card-category">Isi dibawah sokin</p>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.tag.store') }}" method="POST">

                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Nama Tag nya</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>

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