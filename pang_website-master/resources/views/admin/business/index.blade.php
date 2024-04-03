@extends("layouts.share")
@section('content')
<div class="page-breadcrumb">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-success">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">商业</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ route('admin.business.create') }}"><button type="button"
                                class="btn btn-primary">添加</button></a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th scope="col"><b>状态</b></th> --}}
                                <th scope="col"><b>商业名称</b></th>
                                <!-- <th scope="col"><b>概述</b></th>
                                <th scope="col"><b>照片</b></th>
                                <th scope="col"><b>种类</b></th> -->
                                <!-- <th scope="col"><b>商业背景</b></th> -->
                                <th scope="col"><b>商业地址</b></th>
                                <th scope="col"><b>状态</b></th>
                                <th scope="col"><b>控制选项</b></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($business as $item)
                                <tr>
                                    {{-- <td>{{ $item->status == 'pending' ? '待定' : '确认' }}</td> --}}
                                    <td>{{ $item->name }}</td>
                                    <!-- <td>{{ $item->description }}</a></td> -->
                                    <!-- <td><img src="{{$item->image_path}}"></td> -->
                                    <!-- <td>{{ $item->category }}</td> -->
                                    <!-- <td>{{ $item->background }}</td> -->
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->status }}</td>   
                                    <td>
                                        <a href="{{ route('admin.business.edit', $item) }}"><i class="far fa-edit"
                                                title="更改商业资料"></i></a>
                                        <a href="{{ route('admin.business.show', $item) }}"><i class="fas fa-eye"
                                                title="查看详细资料"></i></a>

                                        @if (Auth::user()->role == 'superadmin')
                                        <form method="POST" action="{{ route('admin.business.destroy', $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline;" title="删除商业">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" style="background-color: transparent;
                                                                            background-repeat: no-repeat;
                                                                            border: none;
                                                                            cursor: pointer;
                                                                            overflow: hidden;
                                                                            outline: none;">
                                                <i class="me-2 mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#data_table").DataTable();
    });
</script>
@endsection