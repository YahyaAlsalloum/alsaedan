<div class="dropdown table-icons">
    <a href="@if ($baseRoute != null) {{ $baseRoute . '/' . $ob->id . '/edit' }}@else
                {{ route($route . '.edit', $ob->id) }}  @endif" 
                {{-- target="_blanck" --}}
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

{{-- <div class="dropdown table-icons">
    <a  onclick="editAjaxForm()" href="javascript:void(0)" class="dropdown-item">
        <i class="fa fa-edit"></i>
    </a>
    <input type="hidden"
        value="@if ($baseRoute != null) {{ $baseRoute . '/' . $ob->id . '/edit/ajax' }}@else
    {{ route($route . '.edit', $ob->id) }} @endif"
        id="inputval" />

    <form id="delete-form-{{ $ob->id }}"
        action="@if ($baseRoute != null) {{ $baseRoute . '/' . $ob->id }}@else {{ route($route . '.destroy', $ob->id) }} @endif"
        method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <a class="dropdown-item btn-delete-model"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </form>
</div>
@push('js')
    <script type="text/javascript">
        function editAjaxForm() {
            console.log('aaaa')

            let url = $('#inputval').val();
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(data) {
                    $('#model-view').html(data.view);
                },
                error: function(data) {}
            });

        }
    </script>
@endpush --}}
