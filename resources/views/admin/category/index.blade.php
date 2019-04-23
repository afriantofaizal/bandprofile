@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Kategori')

@section('title', 'Kategori')

<div class="row">
  <div class="col-md-12">

    <a href="{{ route('admin.category.create') }}" title="Tambah Kategori" rel="tooltip" class="btn btn-info btn-round">
        <i class="material-icons">add</i>
    </a>

    {{-- search post --}}
    <form method="GET" action="{{ route('admin.searchCategory') }}" class="pull-right">
        @csrf
        <div class="input-group no-border">
            <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
            <span class="input-group-prapend">
              <button type="submit" class="btn btn-sm btn-round btn-success btn-just-icon">
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
        <div class="card-header card-header-success">
          <h4 class="card-title ">Semua Kategori Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $categories->total() }} Kategori</span>
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
                  Nama Kategori nya
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
                @foreach ($categories as $key=>$category)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ $category->name }}
                  </td>
                  <td>
                    {{ $category->posts->count() }}
                  </td>
                  <td>
                    {{ $category->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $category->updated_at->format('d M Y') }}
                  </td>
                  <td>
                      <a href="{{ route('admin.category.show', $category->id) }}"
                          class="btn btn-info btn-sm" title="Liat Detil Category" rel="tooltip">     
                          <i class="material-icons">visibility</i>
                      </a>

                      <a href="{{ route('admin.category.edit', $category->id) }}" title="Edit Kategori" rel="tooltip" class="btn btn-success btn-sm">
                          <i class="material-icons">edit</i>
                      </a>

                      <button class="btn btn-danger btn-sm" title="Apus Kategori" rel="tooltip" type="button" onclick="deleteKategori({{ $category->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('admin.category.destroy',$category->id) }}"
                            id="delete-form-{{ $category->id }}"
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
          {{ $categories->links() }}
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
    function deleteKategori(id) 
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
            'Yoi data kategori lu udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data kategori lu masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection