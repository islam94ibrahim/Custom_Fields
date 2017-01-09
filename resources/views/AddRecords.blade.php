<!DOCTYPE html>
<html>
<head>
	<title>Add Records</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/css/app.css" rel="stylesheet">
	<script src="/js/app.js"></script>
</head>
<body>
<div class="container" style="margin-top: 70px">
	<h1>Entity Records</h1>
	<hr>
	<div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Record</div>
                    <div class="panel-body">
                    @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                    @endif
                    @if(count($Columns) > 0)
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/Record') }}">
                            {{ csrf_field() }}

                            @foreach($Columns as $Column)
                            <div class="form-group">
                                <label for="{{$Column->Name}}" class="col-md-4 control-label">{{$Column->Name}}</label>

                                <div class="col-md-6">
                                @php
                                	if($Column->Type=="integer"||$Column->Type=="double"){
                                	@endphp
                                		<input id="{{$Column->Name}}" type="number" class="form-control" name="{{$Column->Name}}" min="1" step="any" required>
                            		@php
                                	}
                                	else{
                                	@endphp
                                		<input id="{{$Column->Name}}" type="text" class="form-control" name="{{$Column->Name}}" required>
                            		 @php
                                	}
                                @endphp
                                
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Record
                                    </button>

                                </div>

                            </div>

                        </form>
                    @else
                        <div class="alert alert-warning">
                                No Columns in the table !
                        </div>
                    @endif

                    </div>
                </div>
                <div class="col-md-6">
                <a href="{{url('/')}}" class="btn btn-danger">
                    Return
                </a>
                </div>
            </div>

        </div>
</div>
</body>
</html>