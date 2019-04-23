@extends('layouts.back_design')

@section('content')

@section('breadcrumb', 'Subscribers')

@section('title', 'Subscribers')

<div class="row">
  <div class="col-md-12">

    {{-- search post --}}
    <form method="GET" action="{{ route('admin.searchsub') }}" class="pull-right">
        @csrf
        <div class="input-group no-border">
            <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Cari...">
            <span class="input-group-prapend">
              <button type="submit" class="btn btn-sm btn-round btn-info btn-just-icon">
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
        <div class="card-header card-header-info">
          <h4 class="card-title ">Semua Subscriber Ada Disini</h4>
          <span class="label badge-pill badge-primary pull-right">{{ $subscribers->total() }} Subscriber</span>
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
                  Email
                </th>
                <th>
                  Dibikin Tanggal
                </th>
                <th>
                  Diedit Tanggal
                </th>
                <th>
                  Ngapus Subscriber
                </th>
              </thead>
              <tbody>
                @foreach ($subscribers as $key=>$subscriber)
                <tr>
                  <td>
                    {{ $key + 1 }}
                  </td>
                  <td>
                    {{ $subscriber->email }}
                  </td>
                  <td>
                    {{ $subscriber->created_at->format('d M Y') }}
                  </td>
                  <td>
                    {{ $subscriber->updated_at->format('d M Y') }}
                  </td>
                  <td>
                      <button class="btn btn-danger btn-sm" title="Apus Subscriber" rel="tooltip" type="button" onclick="deleteSubs({{ $subscriber->id }})">
                          <i class="material-icons">delete</i>
                      </button>

                      <form method="POST"
                            action="{{ route('admin.subscriber.destroy',$subscriber->id) }}"
                            id="delete-form-{{ $subscriber->id }}"
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
    function deleteSubs(id) 
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
            'Yoi data subscriber udah diapus sob.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Gak Jadi Ngapus',
            'Data subscriber masih aman sob :)',
            'error'
          )
        }
      })
    }
  </script>

@endsection