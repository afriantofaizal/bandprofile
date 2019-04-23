@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Tag')

@section('title', 'Tag')


<div class="row">
    <div class="col-md-12">

    <a href="{{ route('admin.tag.create') }}" title="Tambah Tag" rel="tooltip" class="btn btn-info btn-round">
        <i class="material-icons">add</i>
    </a>
  
      {{-- search post --}}
      <form method="GET" action="{{ route('admin.searchTag') }}" class="pull-right">
          @csrf
          <div class="input-group no-border">
              <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
              <span class="input-group-prapend">
                <button type="submit" class="btn btn-sm btn-round btn-warning btn-just-icon">
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
        <div class="card-header card-header-warning">
          <h4 class="card-title ">Semua Tag Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $tags->total() }} Tag</span>
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
                  Nama Tag nya
                </th>
                <th>
                  Postingan
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
                @foreach ($tags as $key=>$tag)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ $tag->name }}
                  </td>
                  <td>
                    {{ $tag->posts->count() }}
                  </td>
                  <td>
                    {{ $tag->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $tag->updated_at->format('d M Y') }}
                  </td>
                  <td>
                      <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn btn-success btn-sm" title="Edit Tag" rel="tooltip">
                          <i class="material-icons">edit</i>
                      </a>

                      <button class="btn btn-danger btn-sm" title="Apus Tag" rel="tooltip" type="button" onclick="deleteTag({{ $tag->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('admin.tag.destroy',$tag->id) }}"
                            id="delete-form-{{ $tag->id }}"
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
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
    function deleteTag(id) 
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
            'Yoi data tag lu udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data tag lu masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection