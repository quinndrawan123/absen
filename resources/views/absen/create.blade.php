@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add New Absen</h5>
                    <a href="{{ route('absens.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Absens
                    </a>
                </div>

                <div class="card-body">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Please check the form for any mistakes.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Create Absen Form -->
                    <form action="{{ route('absens.store') }}" method="POST">
                        @csrf

                        <!-- Select User -->
                        <div class="form-group mb-4">
                            <label for="user_id" class="form-label">Select User <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="" disabled selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date Field -->
                        <div class="form-group mb-4">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                        </div>

                        <!-- Check-In Time Field -->
                        <div class="form-group mb-4">
                            <label for="check_in" class="form-label">Check-In Time</label>
                            <input type="time" name="check_in" id="check_in" class="form-control" value="{{ old('check_in') }}">
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle"></i> Absen
                            </button>
                            <a href="{{ route('absens.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
