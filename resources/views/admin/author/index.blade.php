@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Authors')

@section('title', 'Authors')

<div class="row">
  <div class="col-md-12">

    {{-- search post --}}
    <form method="GET" action="{{ route('admin.searchAuthor') }}" class="pull-right">
        @csrf
        <div class="input-group no-border">
            <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
            <span class="input-group-prapend">
              <button type="submit" class="btn btn-sm btn-round btn-primary btn-just-icon">
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
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Semua Author Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $authors->total() }} Author</span>
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
                  Nama Author
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
                @foreach ($authors as $key=>$author)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ $author->name }}
                  </td>
                  <td>
                    {{ $author->posts->count() }}
                  </td>
                  <td>
                    {{ $author->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $author->updated_at->format('d M Y') }}
                  </td>
                  <td>

                      <button class="btn btn-danger btn-sm" title="Apus Author" rel="tooltip" type="button" onclick="deleteAuthor({{ $author->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('admin.author.destroy',$author->id) }}"
                            id="delete-form-{{ $author->id }}"
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
    function deleteAuthor(id) 
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
            'Yoi data author udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data author lu masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection