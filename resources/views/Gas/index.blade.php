<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gas</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script  data-src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>
<body>
    <h1>Gas Weekly Price</h1>

    <body>
        <div class="container">
        <br />
        @if (\Session::has('success'))
          <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
          </div><br />
         @endif
        <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>LastWeek Price</th>
            <th>Current Price</th>
            <th>Is Increase</th>
            <th>Petrol Type</th>
            <th>Brand</th>
            <th>Name</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach($gas as $g)
            <tr>
              <td>{{$g['id']}}</td>
              <td>{{$g['last_week_price']}}</td>
              <td>{{$g['current_price']}}</td>
              <td>{{$g['isIncrease']}}</td>
              <td>{{$g['petrol_type']}}</td>
              <td>{{$g['brand_name']}}</td>
              <td>{{$g['note']}}</td>

              <td><a href="{{action('GasController@show', $g['id'])}}" class="btn btn-primary">Show</a></td>
              <td><a href="{{action('GasController@edit', $g['id'])}}" class="btn btn-warning">Edit</a></td>
              <td>
                <form action="{{action('GasController@destroy', $g['id'])}}" method="post">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
             
            @endforeach
          </tbody>
        </table>
        </div>
      
       <!-- <div>
            {{-- <td><a href="{{action('PassportController@create')}}"  style="margin-left:38px" class="btn btn-primary">Create New Passport</a></td> --}}
        </div> -->
         
      </body>
</body>
</html>