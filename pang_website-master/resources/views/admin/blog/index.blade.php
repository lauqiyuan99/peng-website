@extends('layouts.share')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
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
                        <h4 class="page-title">彭氏来源管理</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <a href="{{ route('admin.blog.create') }}"><button type="button" class="btn btn-primary">添加</button></a>
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
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col"><b>媒体类型</b></th>
                                            <th scope="col"><b>媒体路径</b></th>
                                            <th scope="col"><b>说明</b></th>
                                            <th scope="col"><b>是否发布</b></th>
                                            <th scope="col"><b>年份</b></th>
                                            <th scope="col"><b>页面</b></th>
                                            <th scope="col"><b>创建时间</b></th>
                                            <th scope="col"><b>控制选项</b></th>
                                        </tr>
                                    </thead>
                                    @foreach ($blogs as $blog)
                                        <tbody class="customtable">
                                            <tr>
                                                <td>{{ $blog->media_type }}</td>
                                                <td>{{ $blog->media_path }}</td>
                                                <td>{{ $blog->description }}</td>
                                                @if ($blog->is_publish == 1)
                                                    <td>Yes</td>
                                                @else
                                                    <td>No</td>
                                                @endif
                                                <td>{{ $blog->year }}</td>
                                                <td>{{ $blog->page_id }}</td>
                                                <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.blog.edit', $blog) }}"><i
                                                            class="far fa-edit" title="更改资料"></i></a>
                                                    <a href="{{ route('admin.blog.show', $blog) }}"><i
                                                            class="fas fa-eye" title="查看详细资料"></i></a>

                                                    @if (Auth::user()->role == 'superadmin')
                                                    <form method="POST"
                                                        action="{{ route('admin.blog.destroy', $blog->id) }}"
                                                        accept-charset="UTF-8" style="display:inline;"
                                                        title="删除资料">
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
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">{{ $blogs->links() }}</div>
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
