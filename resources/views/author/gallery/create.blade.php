@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Gallery - Bikin Gallery')

@section('title', 'Bikin Gallery')

<form action="{{ route('author.gallery.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-rose">
                    <h4 class="card-title">Tambahin Poto Baru Sob</h4>
                    <p class="card-category">Isi dibawah sokin</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Judul Poto</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="status" class="form-check-input" type="checkbox" value="1">
                                        Publish
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ URL::previous() }}" class="btn btn-danger" title="GAK JADI" rel="tooltip">
                                <i class="material-icons">keyboard_backspace</i>
                            </a>
                            <button type="submit" class="btn btn-info" title="SIMPEN" rel="tooltip">      
                                <i class="material-icons">save</i>
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection