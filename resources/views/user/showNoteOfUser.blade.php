@extends('layouts.master')
@section('content')
<table border="1px">
    <thead>
    <tr>
        {{--        <th>No.</th>--}}
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>

    </tr>
    </thead>
    <tbody>


    @foreach($notes as $note)

        <tr>
            <td>{{$note->name}}</td>
            <td>{{$note->description}}</td>
            <td>{{$note->category}}</td>
        </tr>
    @endforeach
    </tbody>
    <a href="{{route('users.index')}}"><button>Back</button></a>

</table>

@endsection
