@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Absen</div>

                <div class="card-body">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Absen Form -->
                    <form action="{{ route('absens.update', $absen->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Select User -->
                        <div class="form-group mb-3">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $absen->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date Field -->
                        <div class="form-group mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $absen->date }}" required>
                        </div>

                        <!-- Check-In Time Field -->
                        <div class="form-group mb-3">
                            <label for="check_in">Check-In Time</label>
                            <input type="time" name="check_in" id="check_in" class="form-control" value="{{ $absen->check_in }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('absens.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
