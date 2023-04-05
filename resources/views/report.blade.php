@extends('layouts.admin')

@section('content')
    
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                      <h2 class="text-white pb-2 fw-bold"> <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i></a> Reports</h2>
                        <h5 class="text-white op-7 mb-2">Generate auction's report</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5 row justify-content-center">
            <div class="card p-3 col-md-7 row">
              <h2 class="fw-bold">Generate auctions report by date</h2>
              <form id="report_by_date" action="{{ route('reports.generate') }}" method="post">
                @csrf
                <input type="text" name="method" value="by_date" hidden>
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">From :</label>
                      <input name="from" type="date" class="form-control @error('from') is-invalid @enderror" value="{{ old('from') }}">
                      @error('from')
                        <span class="text-danger">{{ $message }}</span>                    
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">To :</label>
                      <input name="to" type="date" class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}">
                      @error('to')
                        <span class="text-danger">{{ $message }}</span>                    
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>

        <iframe hidden id="doc" src="" frameborder="0"></iframe>

    @section('js')

        <script>

        $('#report_by_date').off().on('submit', (e) => {
          e.preventDefault();
          var formData = new FormData($(e.target)[0])
          var route = "{{ route('reports.generate') }}"
          $("#report_by_date button[type=submit]").prop('disabled', true)
          
          $.ajax({
              'method': 'POST',
              'url': `${route}`,
              'data': formData,   
              processData: false,
              contentType: false,
              cache: false,
              success: (res) => {
                  console.log(res);
                  if (res.status == false) {
                      Object.keys(res.messages).forEach(key => {
                        $.notify({
                            // options
                            message: res.messages[key][0],
                            icon: 'fas fa-exclamation-triangle'
                        },{
                            // settings
                            type: 'danger'
                        });
                      });
                  }else{
                    let frm = document.getElementById('doc').contentWindow
                    frm.document.write(res.data)
                    setTimeout(() => {
                      frm.print()
                    }, 2000);
                  }
              },
              complete: () => {
                  $("#report_by_date button[type=submit]").prop('disabled', false)

              }
          })
        });
        </script>

    @endsection


@endsection