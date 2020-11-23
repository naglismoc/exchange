<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        .alert{
          background-color:#eb2121;
          width:400px
        }
        .alert-info{
          background-color:#f5e50d;
          width:400px
        }
        .alert-success{
          background-color:#39eb0d;
          width:400px
        }
        .down{
          color:red;
        }
        .up{
          color:green;
        }
        #pusher{
          margin-left:500px;
        }
    a{
      text-decoration: none;
    }
        </style>
</head>
<body>
    <h2>STOCK EXCHANGE</h2>

 
    @if ($errors->any())
    <div class="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

  @if(session()->has('success_message'))
      <div class="alert alert-success">
          {{session()->get('success_message')}}
      </div>
  @endif
  
  @if(session()->has('info_message'))
      <div class="alert alert-info">
          {{session()->get('info_message')}}
      </div>
  @endif


      <form action="{{route('stock.store')}}" method="post">
        <label for="name">Stock name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>
        <label for="acronym">Acronym:</label><br>
        <input type="text" id="acronym" name="acronym" value="{{ old('acronym') }}"><br>
        <input type="submit" value="Submit">
        @csrf
      </form> 

      <form action="{{route('trade.populate')}}" method="post">
      <label id="pusher" for="cars">Choose a stock to populate:</label>
      <select name="stocks" id="stocks">
        @foreach ($stocks as $stock)
        <option  value="{{$stock->id}}">{{$stock->acronym}}</option>
        @endforeach
      </select>
      <input type="submit" value="populate">
      @csrf
    </form> 

    {{-- <form action="{{route('stock.index')}}" method="post">
      <label id="pusher" for="cars">Sort by:</label>
      <select name="sort" id="stocks">
        <option  value="priceaz">kaina 1 - 100</option>
        <option  value="priceza">kaina 100 - 1</option>

      </select>
      <input type="submit" value="populate">
      @csrf --}}
    </form> 
<table>
  <tr>
    <th>Code
      <a href="{{route('stock.sort','acronym_az')}}">▲</a>
      <a href="{{route('stock.sort','acronym_za')}}">▼</a>
    </th>
    <th>name
      <a href="{{route('stock.sort','name_az')}}">▲</a>
      <a href="{{route('stock.sort','name_za')}}">▼</a>
    </th>
    <th>price
      <a href="{{route('stock.sort','price_up')}}">▲</a>
      <a href="{{route('stock.sort','price_down')}}">▼</a>
      </th>
    <th>trade volume</th>
    <th>price movement(h)</th>
  </tr>
  @foreach ($stocks as $stock)
  <tr>
    <td>{{$stock->acronym}}</td>
    <td>{{$stock->name}}</td>
    <td>{{$stock->lastPrice()}}</td>
    <td>{{$stock->tradeCount()}}</td>
    <td>{!!$stock->priceMovement()!!}</td>

  </tr>  
  @endforeach
 
  
</table>
</body>
</html>