@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Postingan - Bikin Postingan')

@section('title', 'Bikin Postingan')

<link href="{{ asset('assets/back/css/tail.select-bootstrap4.css') }}" rel="stylesheet" />

<script src="{{ asset('assets/back/js/tail.select-full.min.js') }}"></script>

        <form action="{{ route('author.post.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Tambahin Postingan Baru Sob</h4>
                            <p class="card-category">Isi dibawah sokin</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul Postingan</label>
                                            <input type="text" class="form-control" style="color: #000000;" name="title">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file" name="image">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
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
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Kategori sama Tag</h4>
                            <p class="card-category">Pilih Kategori sama Tag nya</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-error {{ $errors->has('categories') ? ' focused error' : '' }}">
                                        <label for="category" class="control-label">Pilih Kategori</label>
                                        <div class="form-group bmd-form-group">
                                            <select name="categories[]" id="category" multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group label-floating has-error {{ $errors->has('tags') ? ' focused error' : '' }}">
                                        <label for="tag" class="control-label">Pilih Tag</label>
                                        <div class="form-group bmd-form-group">
                                            <select name="tags[]" id="tag" multiple>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Isi Postingan nya</h4>
                            <p class="card-category">Isi dibawah sokin</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" id="summernote" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
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
        </form>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        tail.select('#category', {
            search: true,
            hideSelected: true,
            hideDisabled: true,
            multiLimit: 2,
            multiShowCount: false,
            multiContainer: true,
        });
        tail.select('#tag', {
            search: true,
            hideSelected: true,
            hideDisabled: true,
            multiLimit: 2,
            multiShowCount: false,
            multiContainer: true,
        });
    </script>

@endsection