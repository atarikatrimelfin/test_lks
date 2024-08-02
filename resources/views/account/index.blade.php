<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="pt-5 d-flex justify-content-between">
            <div class="col">
                <h1>Welcome to Data Account</h1>
            </div>
            <div class="">
                <a href="/logout" class="btn btn-danger">Logout</a>
                <a href="/home" class="active">Dashboard Author Admin</a>
        <a href="/account/index">Account</a>
          <a href="/post/index">Post</a>
            </div>
        </div>

        <!-- create list of books -->
        <div class="row">
            <div class="col-12">
                <a class="btn btn-success" href="/register">Add</a>
            </div>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($account as $acc)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $acc->username }}</td>
                                <td>{{ $acc->name }}</td>
                                <td>{{ $acc->role }}</td>
                                <td>Password Encrypted</td>
                                <td>
                                    <a href="{{ route('account.edit', $acc->username) }}" type="button"
                                        class="btn btn-warning rounded-3">Ubah</a>
                                    <form method="POST" action="{{ route('account.delete', $acc->username) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-3">Hapus</button>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach                       
                    </tbody>
                </table>
            </div>
                
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>