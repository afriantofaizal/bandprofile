@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Postingan')

@section('title', 'Postingan')

<div class="row">
  <div class="col-md-12">

    {{-- create post --}}
    <a href="{{ route('admin.post.create') }}" title="Tambah Postingan" rel="tooltip" class="btn btn-info btn-round">
        <i class="material-icons">add</i>
    </a>

    {{-- search post --}}
    <form method="GET" action="{{ route('admin.search') }}" class="pull-right">
      @csrf
      <div class="input-group no-border">
          <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
          <span class="input-group-prapend">
            <button type="submit" class="btn btn-sm btn-round btn-danger btn-just-icon">
                <i class="material-icons">search</i>
            </button>
          </span>
      </div>
    </form>

  </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-danger">
          <h4 class="card-title ">Semua Postingan Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $posts->total() }} Postingan</span>
          <p class="card-category"> Liat Aje</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th>
                  Nomer
                </th>
                <th>
                  Judulnya
                </th>
                <th>
                  Yang bikin
                </th>
                <th>
                    <i class="fa fa-eye"></i>
                </th>
                <th>
                  Is Approved
                </th>
                <th>
                    Status
                  </th>
                <th>
                  Dibikin Tanggal
                </th>
                <th>
                  Diedit Tanggal
                </th>
                <th>
                  Ngedit sama Ngapus
                </th>
              </thead>
              <tbody>
                @foreach ($posts as $key=>$post)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ str_limit($post->title, '10') }}
                  </td>
                  <td>
                    {{ $post->user->name }}
                  </td>
                  <td>
                    {{ $post->view_count }}
                  </td>
                  <td>
                    @if ($post->is_approved == true)
                    <span class="label badge-pill badge-info" data-color="info">Approved</span>
                    @else
                    <span class="label badge-pill badge-danger" data-color="danger">Pending</span>
                    @endif
                  </td>
                  <td>
                    @if ($post->status == true)
                    <span class="label badge-pill badge-info" data-color="info">Published</span>
                    @else
                    <span class="label badge-pill filter badge-danger" data-color="danger">Pending</span>
                    @endif
                  </td>
                  <td>
                    {{ $post->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $post->updated_at->format('d M Y') }}
                  </td>
                  <td>
                      <a href="{{ route('admin.post.show', $post->id) }}"
                          class="btn btn-info btn-sm" title="Liat Detil Postingan" rel="tooltip">     
                          <i class="material-icons">visibility</i>
                      </a>

                      <a href="{{ route('admin.post.edit', $post->id) }}"
                          class="btn btn-success btn-sm" title="Edit Postingan" rel="tooltip">
                          <i class="material-icons">edit</i>
                      </a>

                      <button class="btn btn-danger btn-sm" title="Apus Postingan" rel="tooltip" type="button" onclick="deletePost({{ $post->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('admin.post.destroy',$post->id) }}"
                            id="delete-form-{{ $post->id }}"
                            style="display: none;">
                          @csrf
                          @method('DELETE')
                      </form>

                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
    function deletePost(id) 
    {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
      })

      swalWithBootstrapButtons.fire({
        title: 'Yakin Mau diapus?',
        text: "Kalo diapus bakalan ilang sob!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yaudah, Apus Aja!',
        cancelButtonText: 'Kagak Jadi, Batal!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {

          event.preventDefault();
          document.getElementById('delete-form-'+id).submit();
          
          swalWithBootstrapButtons.fire(
            'Diapus!',
            'Yoi data postingan lu udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data postingan lu masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection