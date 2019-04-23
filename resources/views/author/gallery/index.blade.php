@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Galleries')

@section('title', 'Gallery')


<div class="row">
  <div class="col-md-12">

    <a href="{{ route('author.gallery.create') }}" title="Tambah Gallery" rel="tooltip" class="btn btn-info btn-round">
        <i class="material-icons">add</i>
    </a>

    {{-- search gallery --}}
    <form method="GET" action="{{ route('author.searchGall') }}" class="pull-right">
      @csrf
      <div class="input-group no-border">
          <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
          <span class="input-group-prapend">
            <button type="submit" class="btn btn-sm btn-round btn-just-icon">
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
        <div class="card-header card-header-rose">
          <h4 class="card-title ">Semua Gallery Poto Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $galleries->count() }} Poto</span>
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
                @foreach ($galleries as $key=>$gallery)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ str_limit($gallery->title, '10') }}
                  </td>
                  <td>
                    {{ $gallery->user->name }}
                  </td>
                  <td>
                    @if ($gallery->is_approved == true)
                    <span class="label badge-pill badge-info" data-color="info">Approved</span>
                    @else
                    <span class="label badge-pill badge-danger" data-color="danger">Pending</span>
                    @endif
                  </td>
                  <td>
                      @if ($gallery->status == true)
                      <span class="label badge-pill badge-info" data-color="info">Published</span>
                      @else
                      <span class="label badge-pill filter badge-danger" data-color="danger">Pending</span>
                      @endif
                    </td>
                  <td>
                    {{ $gallery->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $gallery->updated_at->format('d M Y') }}
                  </td>
                  <td>
                      <a href="{{ route('author.gallery.show', $gallery->id) }}"
                          class="btn btn-info btn-sm" title="Liat Detil Gallery" rel="tooltip">     
                          <i class="material-icons">visibility</i>
                      </a>
                      <a href="{{ route('author.gallery.edit', $gallery->id) }}"
                          class="btn btn-success btn-sm" title="Edit Gallery" rel="tooltip">
                          <i class="material-icons">edit</i>
                      </a>

                      <button class="btn btn-danger btn-sm" title="Apus Gallery" rel="tooltip" type="button" onclick="deleteGallery({{ $gallery->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('author.gallery.destroy',$gallery->id) }}"
                            id="delete-form-{{ $gallery->id }}"
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
          {{ $galleries->links() }}
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
    function deleteGallery(id) 
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
            'Yoi data gallery lu udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data gallery lu masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection