@extends('layouts.share')

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
            <h4 class="page-title">亲属关系</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ route('admin.relationship.create') }}"><button type="button"
                                class="btn btn-primary">添加</button></a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th scope="col"><b>状态</b></th> --}}
                                <th scope="col"><b>名称</b></th>
                                <th scope="col"><b>配偶名称</b></th>
                                {{-- <th scope="col"><b>性别</b></th> --}}
                                <th scope="col"><b>州属</b></th>
                                <!-- <th scope="col"><b>区域</b></th> -->
                                <th scope="col"><b>国籍</b></th>
                                {{-- <th scope="col"><b>出生日期</b></th> --}}
                                <th scope="col"><b>父母</b></th>
                                <th scope="col"><b>渡马代序</b></th>
                                <th scope="col"><b>辈分</b></th>
                                <!-- <th scope="col"><b>家庭</b></th> -->
                                <th scope="col"><b>控制选项</b></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($persons as $person)
                                <tr>
                                    {{-- <td>{{ $person->status == 'pending' ? '待定' : '确认' }}</td> --}}
                                    <td>{{ $person->name }}</td>
                                    <td>
                                        @if ($person->spouse_name != null)
                                        @php
                                        $exploded_spouse = explode('|', $person->spouse_name);
                                        @endphp
                                        {{$exploded_spouse[0]}} {{-- only display 1st wife --}}
                                        @else
                                        No spouse found
                                        @endif
                                    </td>
                                    {{-- @if ($person->gender == 1)
                                    <td>男</td>
                                    @else
                                    <td>女</td>
                                    @endif --}}
                                    <td>{{ $negeriList[$person->negeri] }}</td>
                                    <!-- <td>{{ $person->state }}</td> -->
                                    <td>{{ $person->nationality }}</td>
                                    {{-- <td>{{ $person->dob_date }}</td> --}}
                                    @if ($person->parent_id != null)
                                    <td>{{ $person->parent->name }}</td>
                                    @else
                                    <td><i>查无记录</i></td>
                                    @endif
                                    <td>{{$person->era}}</td>
                                    <td>{{$person->seniority}}</td>
                                    <!-- <td>{{$person->family}}</td> -->
                                    <td>
                                        <a href="{{ route('admin.relationship.edit', $person) }}"><i class="far fa-edit"
                                                title="更改资料"></i></a>
                                        <a href="{{ route('admin.relationship.show', $person) }}"><i class="fas fa-eye"
                                                title="查看详细资料"></i></a>
                                        @if (Auth::user()->role == 'superadmin')
                                        <form method="POST" action="{{ route('admin.relationship.destroy', $person->id) }}"
                                            accept-charset="UTF-8" style="display:inline;" title="删除资料">
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
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#data_table").DataTable();
    });
</script>
@endsection