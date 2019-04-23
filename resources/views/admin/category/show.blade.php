@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Kategori - Liat Kategori')

@section('title', 'Liat Kategori')

<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::previous() }}" class="btn btn-danger">
            <i class="material-icons">keyboard_backspace</i>
        </a>
        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-success">
            <i class="material-icons">edit</i>
        </a>
        <div class="clearfix"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">{{ $category->name }}</h4>
                <p class="card-category">
                    <i class="material-icons">calendar_today</i> 
                    {{ $category->created_at->toFormattedDateString() }}
                </p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-avatar">
                            <img class="rounded img-fluid" src="{{ Storage::disk('public')->url('category/'.$category->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection