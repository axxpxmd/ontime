<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Total Jam</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presents as $present)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $present->user->username }}</td>
                <td>{{ $present->user->nama }}</td>
                <td>{{ $present->keterangan }}</td>
                @if ($present->jam_masuk)
                    <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                @else
                    <td>-</td>
                @endif
                @if($present->jam_keluar)
                    <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                    <td>
                        {{$present->total_jam ? $present->total_jam : '-'}}
                    </td>
                @else
                    <td>-</td>
                    <td>-</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
