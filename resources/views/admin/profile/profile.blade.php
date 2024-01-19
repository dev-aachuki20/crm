<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "progressBar": true
        };
    </script>
</head>
<body>
    <div class="content-wrapper mt-4">
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card"></div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                <h4 class="card-title">Update Profile!</h4>
                <p class="card-description">
                    Here, You can update your profile!
                </p>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                @if (\Session::has('fail'))
                <div class="alert alert-danger">
                    <p>{{ \Session::get('fail') }}</p>

                </div>
                @endif
                <form action="{{route('profileUpdate')}}" class="forms-sample" id="" method="POST">
                @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $userInfo->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">{{sectorWiseLabel('first_name')}}</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $userInfo->first_name }}" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">{{sectorWiseLabel('last_name')}}</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $userInfo->last_name }}" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">{{sectorWiseLabel('name')}}</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $userInfo->name }}" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username">{{sectorWiseLabel('username')}}</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ $userInfo->username ?? old('username') }}" placeholder="Enter Username" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">{{sectorWiseLabel('email')}}</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $userInfo->email ?? old('email') }}" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dateofbirth">{{sectorWiseLabel('date_of_birth')}}</label>
                                <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" value="{{ $userInfo->birthdate ?? old('dateofbirth') }}" placeholder="Enter Date of Birth" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="old_password">{{sectorWiseLabel('current_password')}}</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" value="" placeholder="Enter Current Password">
                                @error('old_password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="password">{{sectorWiseLabel('password')}}</label>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="confirm_password">{{sectorWiseLabel('confirm_password')}}</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="" placeholder="Enter Confirm Password">
                                @error('confirm_password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4" style="float:right;">
                        <a href="{{route('profile')}}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card"></div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>