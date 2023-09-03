<div class="dropdown table-icons">
    <a href="@if ($baseRoute != null) {{ $baseRoute . '/' . $ob->id . '/edit' }}@else
                {{ route($route . '.edit', $ob->id) }} @endif"
        class="dropdown-item">
        <i class="fa fa-edit"></i>
    </a>
    <form id="delete-form-{{ $ob->id }}"
        action="@if ($baseRoute != null) {{ $baseRoute . '/' . $ob->id }}@else {{ route($route . '.destroy', $ob->id) }} @endif"
        method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <a class="dropdown-item btn-delete-model"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </form>

</div>
