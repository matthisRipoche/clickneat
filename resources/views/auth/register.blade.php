@extends('layout.login')

@section('main')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Create an account</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label class="form-label" for="name">Full Name</label>
                                    <input class="form-control form-control-lg" type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus />
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter password" required />
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input class="form-control form-control-lg" type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter password" required />
                                    @error('password_confirmation')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="mb-3">
                                    <label class="form-label" for="role">Role</label>
                                    <select class="form-select form-select-lg" id="role" name="role" required>
                                        <option value="user">Client</option>
                                        <option value="manager">Manager</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Register Button -->
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center mb-3">
                    Already have an account? <a href="{{ route('login') }}">Log In</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
