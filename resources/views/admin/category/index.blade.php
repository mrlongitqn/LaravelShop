@extends('admin.layout')
@section('title','Quản lý danh mục sản phẩm')
@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách danh mục</h3>
            <br/>
            <a class="btn btn-warning" href="{{route('add-category')}}">Thêm danh mục</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($data as $category)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent_name}}</td>
                    <td>{{$category->desc}}</td>
                    <td>Sửa/Xóa</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
