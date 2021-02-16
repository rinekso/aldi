<table>
    <thead>
    <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jenjang</th>
        <th>Kelas</th>
        <th></th>
        <th>keterangan jenjang</th>
        <th>id</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jenjang as $j)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $j->nama_jenjang }}</td>
            <td>{{ $j->id_jenjang }}</td>
        </tr>
    @endforeach
    </tbody>
</table>