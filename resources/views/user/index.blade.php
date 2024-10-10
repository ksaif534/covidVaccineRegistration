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
    <div class="container mt-2 mb-2 pt-2 pb-2">
        <form action="{{ route('user.search') }}" method="GET">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search For users with National ID">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        @if (request()->session()->has('msg'))
            <div class="alert alert-info">
                <h3>{{ session('msg') }}</h3>
            </div>
        @else
            
        @endif
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
        <div class="card mt-2">
            <div class="card-header">
                <h3 class="text-center"><strong>List of Registered Users</strong></h3>
            </div>
            <div class="card-body text-center">
                <table class="table table-hover table-striped table-fullwidth table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Registration Status</th>
                            @foreach ($users as $user)
                                @if ($user->registration_status == \App\UserRegistrationStatusEnum::SCHEDULED->value)
                                    <th scope="col">Vaccination Date</th>
                                    @break
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    @if ($user->registration_status == \App\UserRegistrationStatusEnum::NOT_SCHEDULED->value)
                                        <td>{{ $user->registration_status }}</td>
                                    @endif
                                    @if ($user->registration_status == \App\UserRegistrationStatusEnum::SCHEDULED->value)
                                        <td>{{ $user->registration_status }}</td>
                                        <td>{{ $user->vaccination_date }}</td>
                                    @endif
                                    @if ($users->contains('vaccination_date'))
                                        @if (!is_null($user->vaccination_date))
                                            @if (\Carbon\Carbon::parse($user->vaccination_date)->isBefore(\Carbon\Carbon::parse(\Carbon\Carbon::now())))
                                                <td>{{ \App\UserRegistrationStatusEnum::VACCINATED->value }}</td>
                                            @endif
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">
                                    Sorry, User <strong>Not Registered</strong>
                                    <p>you can <a href="{{ route('register') }}">register</a> here</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                    @if ($users instanceof \Illuminate\Support\Collection)
                        
                    @else
                        {{ $users->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>