<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Cache</title>
</head>
<body>
    <div class="container my-5">
        @foreach($not_json_data as $key => $value) 
           @foreach ($value as $skey => $svalue)
                <p>   {{$skey}}  --- {{$svalue}}   </p>
                
            @endforeach
            <br>
        @endforeach   
                 
    </div>

    i am cache

    
</body>
</html>