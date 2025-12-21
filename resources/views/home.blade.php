<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Header-cafeshop</h1>
         <h2>{{!empty(request()->keyword)?request()->keyword:'không có gi'}}</h2>
        <h1>
            <?php
            // echo $title;
            ?> </h1>
        < </header>
            <main>
                <h2>Nội dung - quán cafe</h2>

             <div>{{$wellcome}}</div>

              @for ($i=1;$i<=10;$i++)
              <p>Phần tử thứ:{{$i}}</p>
              @endfor
              <hr>
              @foreach($Arr as $item)
               {{$item}}
              @endforeach
               <hr>
               @forelse($Arr as $item)
               <p> Phần tử:{{$item}} </p>
                       @empty
                <p> Không có phần tử </>
               @endforelse
            </main>
            <footer>
                <h1>FOOTER- QUÁN CAFE</h1>
            </footer>

</html>
