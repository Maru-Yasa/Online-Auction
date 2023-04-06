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
                            <td class="">Created at</td>
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
                                <td>@if ($auction->bids->count() !== 0)
                                    @if ($auction->bids->where('offer', $auction->best_offer)->first())
                                        <a href="{{ route('users.detail',$auction->bids->where('offer', $auction->best_offer)->first()->user->id ) }}">{{ $auction->bids->where('offer', $auction->best_offer)->first()->user->username }}</a>                                        
                                    @endif
                                @else
                                    Unknown
                                @endif</td>
                                <td>{{ $auction->bids->count() }}</td>
                                <td class="text-center">@if ($auction->status == 'closed')
                                    <i class="fa fa-circle text-danger"></i>
                                @elseif ($auction->status == 'open')
                                    <i class="fa fa-circle text-success"></i>
                                @else
                                    <i class="fa fa-trophy text-warning"></i>
                                @endif
                                </td>
                                <td>{{ $auction->created_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if ($auction->status != 'complete')
                                        <a href="{{ route('auctions.detail', $auction->id) }}" class="btn btn-secondary btn-round mr-2"><i class="fas fa-eye"></i></a>
                                        @if ($auction->bids->count() !== 0)
                                            <a href="{{ route('auctions.confirm_winner', $auction->id) }}" class="btn btn-success btn-round mr-2"><i class="fas fa-trophy"></i></a>                                            
                                        @endif
                                        <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-primary btn-round mr-2"><i class="fas fa-edit"></i></a>
                                        @else
                                        <a href="{{ route('auctions.detail', $auction->id) }}" class="btn btn-secondary btn-round mr-2"><i class="fas fa-eye"></i></a>
                                        @endif

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