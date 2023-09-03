<thead>
<tr>
    {{-- <th></th> --}}
    <th>#</th>
    @foreach($fields as $header)
        <th>{{strtoupper($header['title'])}}</th>
    @endforeach
    <th></th>
</tr>
</thead>
