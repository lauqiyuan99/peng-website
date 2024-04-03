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
                <h4 class="page-title">彭姓渊源</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{ route('admin.family_origin.create') }}"><button type="button"
                                    class="btn btn-primary" id="addBtn">添加</button></a>
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
                                    {{-- <th scope="col"><b>照片</b></th> --}}
                                     <th scope="col"><b>年份</b></th>
                                    <th scope="col"><b>内容</b></th>                                   
                                    <th scope="col"><b>控制选项</b></th>

                                </tr>
                            </thead>
                            @foreach ($family_origin_list as $family_origin)
                                <tbody class="customtable">
                                    <tr>
                                        <td>{{$family_origin->particular_year}}</td>
                                        <td>{{ $family_origin && $family_origin->family_origin_content ? $family_origin->family_origin_content : '' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.family_origin.edit', $family_origin) }}"><i
                                                    class="far fa-edit" title="更改工作资料"></i></a>
                                            <a href="{{ route('admin.family_origin.show', $family_origin) }}"><i
                                                    class="fas fa-eye" title="查看详细资料"></i></a>

                                            @if (Auth::user()->role == 'superadmin')
                                                <form method="POST"
                                                    action="{{ route('admin.family_origin.destroy', $family_origin->id) }}"
                                                    accept-charset="UTF-8" style="display:inline;" title="删除渊源">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    <button type="submit" id="deleteBtn"
                                                        style="background-color: transparent;
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
                                </tbody>
                                @endforeach
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