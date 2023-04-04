@extends('layouts.admin')

@section('content')
    
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-auctions-left align-auctions-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Auctions</h2>
                        <h5 class="text-white op-7 mb-2">Manage data auctions</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            @if (Session::has('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="table-responsive card p-3">
                <table id="data_table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <td>No</td>
                            <td>Name</td>
                            <td>Start Price</td>
                            <td>Best Offer</td>
                            <td>Best Offer By</td>
                            <td>Bids Count</td>
                            <td class="text-center">Status</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach ($data as $auction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $auction->item->name }}</td>
                                <td>@currency($auction->item->start_price)</td>
                                <td>@currency($auction->best_offer)</td>
                                <td>{{ $auction->bids->where('offer', $auction->best_offer)->first()->user->username }}</td>
                                <td>{{ $auction->bids->count() }}</td>
                                <td class="text-center">@if ($auction->status == 'closed')
                                    <i class="fa fa-circle text-danger"></i>
                                @else
                                    <i class="fa fa-circle text-success"></i>
                                @endif</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('auction.detail', $auction->id) }}" class="btn btn-secondary btn-round mr-2"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-success btn-round mr-2"><i class="fas fa-trophy"></i></a>
                                        <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-primary btn-round mr-2"><i class="fas fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>
            </div>
            
        </div>



    @section('js')

        <script>
            $('#data_table').DataTable()
        </script>

    @endsection


@endsection