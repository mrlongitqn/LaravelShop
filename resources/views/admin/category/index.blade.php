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
            @if(isset($msg))
                {{$msg}}
                @endif
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
                @foreach($categories as $category)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        {{in_array($category->parent_id,array_keys($parent))?$parent[$category->parent_id]['name']:''}}</td>
                    <td>{{$category->desc}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{route('update-category',['id'=>$category->id])}}">Sửa</a>
                        <button data-id="{{$category->id}}" data-name="{{$category->name}}" type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#modal-danger">
                          Xóa
                        </button>
                        <!--href="{{route('delete-category',['id'=>$category->id])}}" -->
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
          <div > {{$categories->links()}}</div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="modal fade" id="modal-danger" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Xóa danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn xóa danh mục "<span id="category-name"></span>" không?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="sure-delete" type="button" class="btn btn-outline-light">Chắc chắn</button>
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Đóng lại</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script>
        var id = 0;
        $('.btn-delete').on('click', function (){
           id = $(this).data('id');
           let name = $(this).data('name');
            $('#category-name').text(name);
        });
        $('#sure-delete').on('click', function (){
            window.location.href = 'http://127.0.0.1:8000/admin/category/delete/'+id;
        });
    </script>
@endsection
