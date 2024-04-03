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
            <h4 class="page-title">活动</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ route('admin.event.create') }}"><button type="button" class="btn btn-primary">添加</button></a>
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
                                <th scope="col"><b>活动名称</b></th>                               
                                <th scope="col"><b>活动管理者</b></th>
                                <th scope="col"><b>活动更新时间</b></th>
                                <th scope="col"><b>活动状态</b></th>
                                <th scope="col"><b>控制选项</b></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>
                                    <td>{{ $event->updated_by }}</td>
                                    <td>{{ $event->updated_at }}</td>
                                    <td>{{ $event->is_publish == 1 ? '发布中' : '不发布' }}</td>                                        
                                    <td>
                                        <a href="{{ route('admin.event.edit', $event) }}"><i class="far fa-edit"
                                                title="更改活动内容"></i></a>
                                        <a href="{{ route('admin.event.show', $event) }}"><i class="fas fa-eye"
                                                title="查看活动内容"></i></a>

                                        @if (Auth::user()->role == 'superadmin')
                                        <form method="POST" action="{{ route('admin.event.destroy', $event->id) }}"
                                            accept-charset="UTF-8" style="display:inline;" title="删除活动">
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