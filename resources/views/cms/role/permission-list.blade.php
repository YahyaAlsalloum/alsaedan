@if ( array_key_exists('list', $permission ) )
    <tr> <td colspan="4" class="role-title">{{$permission['label']}}</td> </tr>
    @foreach( $permission['list'] as $perm)
        @include('cms.role.permission-list',['permission'=> $perm])
    @endforeach
    <tr><td colspan="4"></td></tr>
@else
    <tr>
        <td class="role-check" style="width: 40%">{{$permission['label']}}</td>
        @if(in_array('read',$permission['rule']))
            <td style="width: 20%"><input type="checkbox"
                                          name="permissions[{{$permission['id']}}][read]"
                                          style="margin-right: 5px"
                                          value="{{str_replace(asset(''),'', $permission['route'])}}"
                                          @if ( isset($role) && $role->permissions!= null &&
                                          array_key_exists($permission['id'],$role->permissions)
                                          && array_key_exists('read',$role->permissions[$permission['id']]) )
                                            checked
                                          @endif
                >Read</td>
        @else
            <td style="width: 20%"></td>
        @endif
        @if(in_array('modify',$permission['rule']))
            <td style="width: 20%"><input type="checkbox"
                                          name="permissions[{{$permission['id']}}][modify]"
                                          style="margin-right: 5px"
                                          value="{{str_replace(asset(''),'', $permission['route'])}}"
                                          @if ( isset($role) && $role->permissions!= null &&
                                                                    array_key_exists($permission['id'],$role->permissions)
                                                                    && array_key_exists('modify',$role->permissions[$permission['id']]) )
                                          checked
                    @endif>Modify</td>
        @else
            <td style="width: 20%"></td>
        @endif
        @if(in_array('bank',$permission['rule']))
            <td style="width: 20%"><input type="checkbox"
                                          name="permissions[{{$permission['id']}}][bank]" style="margin-right: 5px"
                                          value="{{str_replace(asset(''),'', $permission['route'])}}"
                                          @if ( isset($role) && $role->permissions!= null &&
                                                                    array_key_exists($permission['id'],$role->permissions)
                                                                    && array_key_exists('bank',$role->permissions[$permission['id']]) )
                                          checked
                    @endif>Bank</td>
        @else
            <td style="width: 20%"></td>
        @endif
    </tr>
@endif
