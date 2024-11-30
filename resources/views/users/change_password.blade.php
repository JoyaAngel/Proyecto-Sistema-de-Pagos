<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    @if (Auth::user()->must_change_password)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> For your security, please change your password after continue to protect your account from unauthorized access.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2><i class="fas fa-key"></i> Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password-update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> New Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Submit</button>

                            @if (!Auth::user()->must_change_password)
                                <a href="{{ route('index') }}" class="btn btn-danger btn-block mt-2"><i class="fas fa-times"></i> Cancel</a>
                                
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @vite('resources/js/app.js', 'resources/css/app.css')
</body>
</html>