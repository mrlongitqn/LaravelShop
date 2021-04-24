@extends('admin.layout')
@section('title','Thêm danh mục')
@section('main')

    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thông tin danh mục</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('update-category', ['id'=>$category->id])}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label >Tên danh mục</label>
                    <input class="form-control" name="name" value="{{$category->name}}"  placeholder="Nhập tên danh mục">
                </div>
                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">Là danh mục chính</option>
                        @foreach($categories as $cat)
                            <option
                                @if($cat->id == $category->parent_id)
                                    selected="selected"
                                @endif
                                value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label >Mô tả danh mục</label>
                    <input name="desc" value="{{$category->desc}}" class="form-control"  placeholder="Nhập mô tả">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


@endsection
