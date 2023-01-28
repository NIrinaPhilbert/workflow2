@extends('layouts.app')
@section('content')
<h1>Detail Document</h1>
<a href="" class="btn btn-primary my-3">Document</a>
<h2>{{$document->title}}</h2>
<h3>{{$document->description}}</h3>
<p>
    <iframe src="{{url('/storage/'.$document->file)}}" style="width:600px;height:500px;"></style>></iframe>
</p>
@endsection