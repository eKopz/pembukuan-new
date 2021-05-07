<table>
    <thead>
        <tr>
            <th>Nama Anggota</th>
            <th>Simpanan Pokok</th>
            <th>Simpanan Wajib</th>
            <th>Simpanan Manasuka</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($simpanan as $value)
            <tr>
                <td>{{ $value->nama }}</td>
                <td>Rp. {{ number_format($value->simpanan_pokok,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->simpanan_wajib,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->simpanan,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->simpanan_pokok + $value->simpanan_wajib + $value->simpanan,0,',','.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>