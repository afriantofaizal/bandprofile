@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Gallery - Liat Gallery')

@section('title', 'Liat Gallery')

<div class="row">
  <div class="col-md-12">
      <a href="{{ URL::previous() }}" class="btn btn-danger">
          <i class="material-icons">keyboard_backspace</i>
      </a>
      <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-success">
          <i class="material-icons">edit</i>
      </a>
      
      @if ($gallery->is_approved == false)
          <button type="button" class="btn btn-info pull-right"
              onclick="approvegallery({{ $gallery->id }})">
              <i class="material-icons">notification_important</i>
              <span>Approve !!</span>
          </button>
      <form action="{{ route('admin.gallery.approve', $gallery->id) }}"
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
          <div class="card-header card-header-rose">
              <h4 class="card-title">{{ $gallery->title }}</h4>
              <p class="card-category">Yang bikin <strong>{{ $gallery->user->name }}</strong>
                  <span class="pull-right"><i class="material-icons">calendar_today</i> {{ $gallery->created_at->toFormattedDateString() }}</span>
              </p>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card-avatar">
                          <img class="rounded img-fluid" src="{{ Storage::disk('public')->url('gallery/'.$gallery->image) }}" alt="">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  function approvegallery(id) 
  {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Approve Gallery?',
      text: "Approve biar bisa dipublish Gallery nya!",
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
          'Yoi Gallery udah diapprove sob.',
          'success'
        )
      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Gak Jadi Diapprove',
          'Gallery masih pending :)',
          'info'
        )
      }
    })
  }
</script>

@endsection