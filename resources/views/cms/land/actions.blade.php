<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle dt-options-btn" type="button" id="dropdownMenuButton{{$ob->id}}"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="cms dt-options"><span></span><span></span><span></span></div>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$ob->id}}">

        <a href="@if($baseRoute != null ){{$baseRoute.'/'.$ob->id }}@else
        {{ route($route.'.edit',['building' => $ob->id]) }} @endif" class="dropdown-item">
            Edit
        </a>

        <a href="{{route('artist.user',$ob->_id)}}" class="dropdown-item">
            Artists
        </a>


        <form id="hide-form-{{$ob->id}}"
              action="@if($baseRoute != null ){{  $baseRoute.'/'.$ob->id}}@else {{ route($route.'.destroy',$ob->id) }} @endif"
              method="POST" style="display: inline;">
            @csrf
            @method('POST')
            <a class="dropdown-item btn-hide-model">
               Delete </a>
        </form>

    </div>
</div>


