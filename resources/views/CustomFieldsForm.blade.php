<!DOCTYPE html>
<html lang="en">
<head>
  <title>Entity Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/css/app.css" rel="stylesheet">
  <script src="/js/app.js"></script>
</head>
<style>
  #Done{
    position: absolute;
    top: 450px;
    right: 200px;
  }
</style>
<body>

<div class="container">
<h1>Entity Information</h1>
<hr>
  <ul class="nav nav-tabs" id="mytabs">
    <li class="active"><a data-toggle="tab" href="#Create">Create Columns</a></li>
    <li><a data-toggle="tab" href="#Edit">Edit Columns</a></li>
    <li><a data-toggle="tab" href="#Delete">Delete Columns</a></li>
  </ul>

  <div class="tab-content">
    <div id="Create" class="tab-pane fade in active">
    <form action="/AddCulomn" method="POST">
    {{csrf_field()}}
    @if (Session::has('DeletedMessage'))
       <div class="alert alert-warning">{{ Session::get('DeletedMessage') }}</div>
    @endif
    @if (Session::has('Message'))
       <div class="alert alert-info">{{ Session::get('Message') }}</div>
    @endif
    @if (Session::has('Error'))
       <div class="alert alert-danger">{{ Session::get('Error') }}</div>
    @endif
    @if (Session::has('EditMessage'))
       <div class="alert alert-success">{{ Session::get('EditMessage') }}</div>
    @endif
    <h3>Add New Column</h3>
    <br>
     <div class="input-group input-group-lg col-xs-6">
        <span class="input-group-addon">Name</span>
        <input type="text" name="Name" class="form-control">
        <span class="input-group-addon">Type</span>
        <select class="form-control" name="Type">
          <option>integer</option>
          <option>double</option>
          <option>string</option>
          <option>text</option>
        </select>
    </div>
    <br>
    <div class="col-xs-6 col-xs-offset-5">
    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Add"/>
    </div>
    </form>
    </div>

    <div id="Edit" class="tab-pane fade in">
    @if(count($Columns) == 0)
      <div class="alert alert-info">No Columns to Edit</div>
    @else
    <form action="/edit" method="POST">
    <h3>Edit exicting Columns</h3>
    <br>
    {{csrf_field()}}
      @php $i=0; @endphp
      @foreach($Columns as $Column)      
      <div class=" input-group input-group-lg col-xs-6">
        <span class="input-group-addon">Name</span>
        <input type="text" class="form-control" name="Name[{{$i}}]" value="{{$Column->Name}}">
        <span class="input-group-addon">Type</span>
        <select class="form-control" name="Type[{{$i}}]">
        @php
        if($Column->Type == "string"){
        @endphp
          <option selected>string</option>
          <option>text</option>
          <option>integer</option>
          <option>double</option>
        @php
        }
        else if( $Column->Type == "text" ){
        @endphp
          <option>string</option>
          <option selected>text</option>
          <option>integer</option>
          <option>double</option>
        @php
        }
        else if( $Column->Type == "integer" ){
        @endphp
          <option>string</option>
          <option>text</option>
          <option selected>integer</option>
          <option>double</option>
        @php
        }
        else if( $Column->Type == "double" ){
        @endphp
          <option>string</option>
          <option>text</option>
          <option>integer</option>
          <option selected>double</option>
        @php
        }
        $i++;
        @endphp
        </select>
        </div>
      @endforeach
      <br>
      <div class="col-xs-6 col-xs-offset-5">
        <button class="btn btn-lg btn-primary" >Edit</button>
      </div>
    </form>
    @endif
    </div>
    <div id="Delete" class="tab-pane fade in">
      
      <form method="POST" action="/delete">
      @if(count($Columns)>0)
      <h3>Delete Columns</h3>
      <br>
      {{csrf_field()}}
      <div class="input-group input-group-lg col-xs-6">
     
        <span class="input-group-addon">Choose a Column</span>
        
        <select class="form-control" name="ColumnDelete">
        
          @foreach($Columns as $Column)
          <option>{{$Column->Name}}</option>
          @endforeach
        
        </select>
        @else
        <div class="alert alert-info">No Columns to Delete</div>
        @endif
      </div>
      <br>
      @if(count($Columns)>0)
      <div class="col-xs-6 col-xs-offset-5">
        <input type="submit" class="btn btn-lg btn-primary" id="DeleteButton" name="submit" value="Delete"/>
      </div>
      @endif
      </form>
    </div>
  </div>
    <a id="Done" href="/Show" class="btn btn-lg btn-success">Done</a>
  </div>
</body>
</html>