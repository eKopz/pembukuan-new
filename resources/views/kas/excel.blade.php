<table>
    <thead>
        <tr>   
            <th>No Bukti</th>
            <th>Tanggal</th>
            <th>Uraian</th>
            <th>Debet</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kas as $value)
            <tr>
                <td>{{ $value->no_bukti }}</td>
                <td>{{ $value->created_at->format('d M Y') }}</td>
                <td>{{ $value->uraian }}</td>
                @if ($value->jenis_kas == 1)
                    <td>Rp. {{ number_format($value->jumlah,0,',','.') }}</td>
                    <td> - </td>
                @else
                    <td> - </td>
                    <td>Rp. {{ number_format($value->jumlah,0,',','.') }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>