{{--@extends('layouts.master')--}}
{{--@section('content')--}}
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <a href="" class="btn btn-success btn-add" data-target="#modal-add" data-toggle="modal">Add</a>
    <a href="{{ route('admin.logout') }}"><button>Log out</button></a>
    {{--    @foreach($notes as $note)--}}
    {{--    <button data-url="{{route('notes.add', $note->id)}}" type="button" data-target="#modal-add" data-toggle="modal" class="btn btn-warning btn-add">Add</button>--}}
    {{--    @endforeach--}}

    <hr>
    <label for="keyword">Tìm kiếm note theo tên</label>
    <div class="form-g">
    <input type="text" name="keyword" id="keyword" class="form-control">
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="listNote">
            @foreach($notes as $key=>$note)
                <tr>
                    <td id="{{$note->id}}">{{$key+1}}</td>
                    <td id="name-{{$note->id}}">{{$note->name}}</td>
                    <td id="description-{{$note->id}}">{{$note->description}}</td>
                    <td id="category-{{$note->id}}">{{$note->category}}</td>
                    <td>
                        <button data-url="{{route('notes.show', $note->id)}}" type="button" data-target="#show"
                                data-toggle="modal" class="btn btn-info btn-show">Detail
                        </button>
                        <button data-url="{{route('notes.update', $note->id)}}" type="button" data-target="#edit"
                                data-toggle="modal" class="btn btn-warning btn-edit">Edit
                        </button>
                        <button data-url="{{route('notes.destroy', $note->id)}}" type="button" data-target="#delete"
                                data-toggle="modal" class="btn btn-danger btn-delete">Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$notes->links()}}

</div>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"
        charset="utf-8" async defer></script>
<script type="text/javascript" charset="utf-8">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('note.add')
@include('note.detail')
@include('note.edit')

<script type="text/javascript">
    $(document).ready(function () {

        let origin= location.origin;
        $(document).on('keyup','#keyword', function (){
            var keyword = $(this).val();
            $.ajax({
                type: "get",
                url: "/search",
                data: {keyword: keyword},
                dataType: "json",
                success: function (response) {
                    $('#listNote').html(response);
                }
            })

        })

        $('#form-add').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            let name = $('#name-add').val();
            let desc = $('#description-add').val();
            let category = $('#category-add').val();
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    name: name,
                    description: desc,
                    category: category,
                },
                success: function (response) {
                    toastr.success(response.message)
                    $('#modal-add').modal('hide');
                    console.log(response.data)
                    $('tbody').prepend('<tr>' +
                        '<td id = "' + response.data.id + '" > ' + response.data.id + ' </td>' +
                        '<td id="name-' + response.data.id + '">' + response.data.name + '</td>' +
                        '<td id="description-' + response.data.id + '">' + response.data.description + '</td>' +
                        '<td id="category-' + response.data.id + '">' + response.data.category + '</td>' +
                        '<td><button data-url="{{asset('')}}notes/' + response.data.id + '" type="button" data-target="#show" data-toggle="modal" class="btn btn-info btn-show">Detail</button>' +
                        '<button data-url="{{asset('')}}notes/' + response.data.id + '" type="button" data-target="#edit" data-toggle="modal" class="btn btn-warning btn-edit">Edit</button>' +
                        '<button data-url="{{asset('')}}notes/' + response.data.id + '" type="button" data-target="#delete"data-toggle="modal" class="btn btn-danger btn-delete">Delete</button></td></tr>');

                    setTimeout(function (){
                        window.location.href= "{{route('notes.index')}}";
                    }, 1500);
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            })
        })
        $('.btn-show').click(function () {
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    console.log(response)

                    $('h1#id').text(response.data.id)
                    $('h1#name').text(response.data.name)
                    $('h1#description').text(response.data.description)
                    $('h1#category').text(response.data.category)
                    $('h1#created_at').text(response.data.created_at)
                    $('h1#update_at').text(response.data.update_at)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
        $('.btn-delete').click(function () {
            var url = $(this).attr('data-url');
            var _this = $(this);
            if (confirm('Có chắc muốn xóa không thế??')) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    success: function (response) {
                        window.location.reload()
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                })
            }
        })

        $('.btn-edit').click(function (e) {
            var url = $(this).attr('data-url');
            $('#modal-edit').modal('show');
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    $('#id-note').val(response.data.id)
                    $('#name-edit').val(response.data.name);
                    $('#description-edit').val(response.data.description);
                    $('#category-edit').val(response.data.category);

                    $('#form-edit').attr('data-url', '{{ asset('notes/') }}/' + response.data.id)
                },
                error: function (error) {

                }
            })
        })
        $('#form-edit').submit(function (e) {
            e.preventDefault();
            let idNote = $('#id-note').val();
            $.ajax({
                type: 'put',
                url: origin + '/admin/notes/' + idNote,
                data: {
                    name: $('#name-edit').val(),
                    description: $('#description-edit').val(),
                    category: $('#category-edit').val(),
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })

    })
</script>
</body>
</html>
{{--@endsection--}}
