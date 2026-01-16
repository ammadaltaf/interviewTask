<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.app')
    <div class="container mt-4">
        <h2>Admin Dashboard</h2>
        <div class="row">
            @foreach($data as $key => $value)
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">{{ ucfirst(str_replace('_', ' ', $key)) }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $value }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
