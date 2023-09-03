<thead>
<tr>
    <th>#</th>
    @foreach($fields as $header)
        <th>{{strtoupper($header['title'])}}</th>
    @endforeach

</tr>
</thead>
