@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <a href="javascript:void(0)" onclick="goBack()" class="form-list-of">
                <i class="fas fa-chevron-left"></i>
            </a>
            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">{{ $title}}</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    {{-- <h5>{{ $title }}</h5> --}}
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="contract-edit-form">save</button>
                            <button class="admin-form-close-btn">close</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="contract-edit-form" method="POST" action="{{route('role.update',$role)}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                <div class="form-group">
                                    <label class="control-label col-12" for="name">Role Name<span class="required" style="color:red">*</span></label>
                                    <div class="col-12">
                                        <input type="text" id="name" name="name" required value="{{$role->name}}" class="form-control col-12"/>
                                    </div>
                                </div>
                            </div><!-- /.col-* -->

                            <div class="col-lg-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                <div class="form-group">
                                    <label class="control-label col-sm-2 col-xs-12" for="permissions">Choose Permissions</label>
                                    <div class="col-md-10 col-sm-10">
                                        <table class="role-table">
                                            <tr>
                                                <th>Country Access</th>
                                                <th>Allow</th>
                                            </tr>
                                            @foreach($country_permissions['list'] as $country)
                                                <tr>
                                                    <td style="width: 60%">
                                                        {{$country['label']}}
                                                    </td>
                                                    <td style="width: 40%">
                                                        <input type="checkbox"  name="permissions[country][{{$country['rule']}}]"

                                                               @if ( $role->permissions!= null
                                                                && array_key_exists('country',$role->permissions))
                                                                @foreach($role->permissions['country'] as $co =>$v)
                                                                    @if ( $co == $country['rule'])
                                                                        checked
                                                                    @endif
                                                                @endforeach
                                                                @endif
                                                        />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <label class="control-label col-sm-2 col-xs-12" for="permissions"></label>

                                    <div class="col-md-10 col-sm-10">
                                        <table class="role-table">
                                            <tr>
                                                <th style="width: 40%">Module Name</th>
                                                <th style="width: 20%">Read</th>
                                                <th style="width: 20%">Modify</th>
                                                <th style="width: 20%">Bank</th>
                                            </tr>
                                            @foreach($permissions as $permission)
                                                <tr><td colspan="4"></td></tr>
                                                @include('cms.role.permission-list',$permission)

                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.col-* -->


                        </div><!-- /.row -->
                    </form>
                </div><!-- /.x_content -->
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row.admin-form-container -->
@endsection
@push('css')
    <style>
        table, th, td {
            width: 70%;
            margin: 2%;
            border: 1px solid black;
            border-collapse: collapse;
        }
        .role-title{
            font-size: 16px;
            color: black;
            font-weight: 700;
        }
        .role-check{
            font-size: 14px;
            color: black;

        }
    </style>
@endpush

@push('js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endpush
