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
            <h4 class="page-title">通告</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ route('admin.notice.create') }}"><button type="button" class="btn btn-primary">添加</button></a>
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
                                <th scope="col"><b>通告名称</b></th>                               
                                <th scope="col"><b>通告管理者</b></th>
                                <th scope="col"><b>通告更新时间</b></th>
                                <th scope="col"><b>通告状态</b></th>
                                <th scope="col"><b>控制选项</b></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($notices as $notice)
                                <tr>
                                    <td>{{ $notice->notice_name }}</td>
                                    <td>{{ $notice->updated_by }}</td>
                                    <td>{{ $notice->updated_at }}</td>
                                    <td>{{ $notice->is_publish == 1 ? '发布中' : '不发布' }}</td>                                        
                                    <td>
                                        <a href="{{ route('admin.notice.edit', $notice) }}"><i class="far fa-edit"
                                                title="更改通告内容"></i></a>
                                        <a href="{{ route('admin.notice.show', $notice) }}"><i class="fas fa-eye"
                                                title="查看通告内容"></i></a>

                                        @if (Auth::user()->role == 'superadmin')
                                        <form method="POST" action="{{ route('admin.notice.destroy', $notice->id) }}"
                                            accept-charset="UTF-8" style="display:inline;" title="删除通告">
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