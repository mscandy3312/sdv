@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Sales</h2>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">New Sale</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->number }}</td>
                                        <td>{{ $sale->client->name }} {{ $sale->client->lastname }}</td>
                                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                                        <td>${{ number_format($sale->total, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $sale->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                                {{ ucfirst($sale->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('sales.show', $sale) }}" 
                                               class="btn btn-sm btn-info">View</a>
                                            
                                            @if($sale->status !== 'cancelled')
                                                <form action="{{ route('sales.destroy', $sale) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to cancel this sale?')">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 