@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0">Manage Absens</h5>
                    <a href="{{ route('absens.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus-circle"></i>Absen
                    </a>
                </div>

                <div class="card-body">
                    <!-- Flash message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Check if data exists -->
                    @if($absens->isEmpty())
                        <div class="text-center my-5">
                            <h5 class="text-muted">No Absen records available.</h5>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Check-In</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absens as $absen)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $absen->user->name }}</td>
                                        <td>{{ $absen->date }}</td>
                                        <td>{{ $absen->check_in ?? 'N/A' }}</td>
                                        <td>
                                            <!-- Action buttons -->
                                            <a href="{{ route('absens.edit', $absen->id) }}" class="btn btn-sm btn-muted">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('absens.destroy', $absen->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $absens->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
