@extends('layouts.blank')

@section('content')
    
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"></h2>
                        <h5 class="text-white op-7 mb-2"></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5 row justify-content-center">
            <div class="card p-3 col-md-5 row">
              <div class="col-12">
                <div class="text-center">
                  <i class="fa fa-check-circle text-success mb-3" style="font-size:100px;"></i>
                  <h2 class="fw-bold">The winner is {{ $winner->username }}</h2>
                </div>
                <div class="">
                  <div class="form-group text-start">
                    <label for="" class="">Winner</label>
                    <input type="text" class="form-control" value="{{ $winner->username }}" readonly>
                  </div>
                  <div class="form-group text-start">
                    <label for="" class="">Auction</label>
                    <input type="text" class="form-control" value="{{ $auction->item->name }}" readonly>
                  </div>
                  <div class="form-group text-start">
                    <label for="" class="">Best bid</label>
                    <input type="text" class="form-control" value="@currency($auction->best_offer)" readonly>
                  </div>
                  <div class="form-group text-start">
                    <label for="" class="">Time</label>
                    <input type="text" class="form-control" value="{{ $last_bid->created_at }}" readonly>
                  </div>
                </div>
                <div class="form-group mt-3">
                  @if ($auction->status != 'complete')
                    <a href="{{ route('auctions.post_confirm_winner', $auction->id) }}" class="btn btn-primary d-block text-white">Confirm Winner</a>                      
                  @endif
                  <a class="btn d-block text-primary" href="{{ route('auctions.index') }}">Back</a>
                </div>
              </div>
            </div>
            
        </div>



    @section('js')

        <script>
            $('#data_table').DataTable()
        </script>

    @endsection


@endsection