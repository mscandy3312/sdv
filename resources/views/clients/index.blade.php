@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Clients</h2>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">New Client</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>DNI</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->lastname }}</td>
                                        <td>{{ $client->dni }}</td>
                                        <td>{{ $client->phone ?? 'N/A' }}</td>
                                        <td>{{ $client->email ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge {{ $client->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $client->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.edit', $client) }}" 
                                               class="btn btn-sm btn-info">Edit</a>
                                            
                                            <form action="{{ route('clients.destroy', $client) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 