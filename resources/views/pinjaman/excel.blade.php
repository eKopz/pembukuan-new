<table>
    <thead>
        <tr>
            <th>Nama Anggota</th>
            <th>Tanggal Pinjaman</th>
            <th>Jumlah Pinjaman</th>
            <th>Jumlah Cicilan</th>
            <th>Sisa Angsuran</th>
            <th>Pembayaran Pokok</th>
            <th>Saldo Pinjaman</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pinjaman as $value)
            <tr>
                <td>{{ $value->anggota->nama }}</td>
                <td>{{ $value->created_at->format('d M Y H:i:s') }}</td>
                <td>Rp. {{ number_format($value->jumlah_pinjaman,0,',','.') }}</td>
                <td>{{ $value->jumlah_cicilan }}x</td>
                <td>{{ $value->jumlah_cicilan - $value->angsuran }}x</td>
                <td>Rp. {{ number_format($value->jumlah_pinjaman / $value->jumlah_cicilan,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->anggota->pinjaman,0,',','.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>