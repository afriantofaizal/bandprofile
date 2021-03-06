@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Postingan - Liat Postingan')

@section('title', 'Liat Postingan')


<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::previous() }}" class="btn btn-danger">
            <i class="material-icons">keyboard_backspace</i>
        </a>
        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-success">
            <i class="material-icons">edit</i>
        </a>
        
        @if ($post->is_approved == false)
            <button type="button" class="btn btn-info pull-right"
                onclick="approvePost({{ $post->id }})">
                <i class="material-icons">notification_important</i>
                <span>Approve !!</span>
            </button>
        <form action="{{ route('admin.post.approve', $post->id) }}"
                method="POST" id="approval-form" style="display: none;">
            @csrf
            @method('PUT')
        </form>
        @else
            <button type="button" class="btn btn-info pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <div class="clearfix"></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">{{ $post->title }}</h4>
                <p class="card-category">Yang bikin <strong>{{ $post->user->name }}</strong>
                    <span class="pull-right"><i class="material-icons">access_time</i> {{ $post->created_at->toFormattedDateString() }}</span>
                    
                </p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>{!! $post->body !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Kategorinya</h4>
                <p class="card-category">Liat Kategori Postingan ini</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($post->categories as $category)
                            <span class="badge badge-pill badge-info">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>   
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Tagnya</h4>
                <p class="card-category">Liat Tag Postingan ini</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-pill badge-info">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>   
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-rose">
                <h4 class="card-title">Gambar Postingan</h4>
                <p class="card-category">Liat Gambar Postingan ini</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-avatar">
                            <img class="rounded img-fluid" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  function approvePost(id) 
  {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Approve Postingan?',
      text: "Approve biar bisa dipublish postingan nya!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yaudah, Approve Aja!',
      cancelButtonText: 'Kagak Jadi, Batal!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        event.preventDefault();
        document.getElementById('approval-form').submit();
        
        swalWithBootstrapButtons.fire(
          'Berhasil diapprove!',
          'Yoi postingan udah diapprove sob.',
          'success'
        )
      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Gak Jadi Diapprove',
          'Postingan masih pending :)',
          'info'
        )
      }
    })
  }
</script>

@endsection