<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-2 text-center">
            <button class="btn btn-outline-info">
                <a href="{{ route('user.index') }}" class="nav-link">See Users List</a>
            </button>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h1>Covid Vaccine User Registration Form</h1>
            </div>
            <div class="card-body">
                @if (request()->session()->has('msg'))
                    <div class="alert alert-info">
                        <h3>{{ session('msg') }}</h3>
                    </div>
                @else
                    
                @endif
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="National ID"><strong>National ID:</strong></label>
                        <input type="number" name="nid" id="nid" class="form-control" placeholder="Enter Your National ID">
                    </div>
                    <div class="form-group mb-3">
                        <label for="Name"><strong>Name:</strong></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="Email"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="Vaccine Centers"><strong>Vaccine Centers:(Select One)</strong></label>
                        <select name="center_id" id="center_id" class="form-control">
                            @foreach ($vaccineCenters as $index => $center)
                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-outline-success">Submit For Vaccine Registration</button>
                    </div>
                    <br>
                    @if ($errors->any())
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert alert-danger" role="alert">
                                    <span>Warning alert!</span> {{ $error }}
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    @else
                        
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>