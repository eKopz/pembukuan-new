<table>
    <thead>
        <tr>
            <td colspan="4"><h2><b>PERINCIAN PEMBAYARAN GAJI</b></h2></td>
        </tr>
        <tr>
            <td colspan="4"><h2><b>{{ $koperasi->nama }}</b></h2></td>
        </tr>
        <tr>
            <td colspan="4"><b>Periode : {{ date('F', mktime(0, 0, 0, $month, 1)) }}' {{ $year }}</b></td>
        </tr>
        <tr>
            <th style="text-align: center" rowspan="3"><b>No</b></th>
            <th style="text-align: center" rowspan="3"><b>Nama</b></th>
            <th style="text-align: center" rowspan="3"><b>Loker</b></th>
            <th style="text-align: center" rowspan="3"><b>Gaji Pokok</b></th>
            <th style="text-align: center" colspan="6"><b>Tunjangan</b></th>
            <th style="text-align: center" rowspan="3"><b>Per Bulan</b></th>
            <th style="text-align: center" rowspan="3"><b>Per Tahun</b></th>
            <th style="text-align: center" colspan="4"><b>PTKP</b></th>
            <th style="text-align: center" rowspan="3"><b>Rapel</b></th>
            <th style="text-align: center" rowspan="3"><b>Lembur</b></th>
            <th style="text-align: center" rowspan="3"><b>Jamsostek</b></th>
            <th style="text-align: center" rowspan="3"><b>Jumlah Total Gaji</b></th>
            <th style="text-align: center" colspan="9"><b>Potongan</b></th>
            <th style="text-align: center" rowspan="3"><b>Jumlah Diterima</b></th>
        </tr>
        <tr>
            <th style="text-align: center" colspan="2"><b>Makan</b></th>
            <th style="text-align: center" colspan="2"><b>Transport</b></th>
            <th style="text-align: center" colspan="2"><b>Insentif</b></th>
            <th style="text-align: center" rowspan="2"><b>Status Kerja</b></th>
            <th style="text-align: center" rowspan="2"><b>Jenis Kelamin</b></th>
            <th style="text-align: center" rowspan="2"><b>Status (menurut aturan pajak)</b></th>
            <th style="text-align: center" rowspan="2"><b>PTKP (sd.)</b></th>
            <th style="text-align: center" colspan="3"><b>Tabungan</b></th>
            <th style="text-align: center" colspan="2"><b>Pinj. Koperasi</b></th>
            <th style="text-align: center" colspan="2"><b>Mangkir</b></th>
            <th style="text-align: center" rowspan="2"><b>Pph. 21</b></th>
            <th style="text-align: center" rowspan="2"><b>Jamsostek</b></th>
        </tr>
        <tr>
            <th style="text-align: center"><b>Jml Hari</b></th>
            <th style="text-align: center"><b>Jumlah</b></th>
            <th style="text-align: center"><b>Jml Hari</b></th>
            <th style="text-align: center"><b>Jumlah</b></th>
            <th style="text-align: center"><b>Nilai</b></th>
            <th style="text-align: center"><b>Jumlah</b></th>
            <th style="text-align: center"><b>Wajib</b></th>
            <th style="text-align: center"><b>Pokok</b></th>
            <th style="text-align: center"><b>Manasuka</b></th>
            <th style="text-align: center"><b>Kali</b></th>
            <th style="text-align: center"><b>Jml</b></th>
            <th style="text-align: center"><b>Hari</b></th>
            <th style="text-align: center"><b>Jml</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gaji as $item => $value)
            <?php 
                $sub_total = $value->karyawan_koperasi->gaji_pokok + $value->makan + $value->transport + $value->insentif + $value->rapel + $value->jamsostek;

                $sub_total_tahun = $sub_total * 12;

                if ($sub_total_tahun > $value->karyawan_koperasi->pajak->total_gaji) {
                    $pajak = $sub_total_tahun - $value->karyawan_koperasi->pajak->total_gaji;

                    $pph_tahun = $pajak * 0.05;

                    $pph = $pph_tahun / 12;
                } else {
                    $pph = 0;
                }
            ?>
            <tr>
                <td>{{ $item+1 }}</td>
                <td>{{ $value->karyawan_koperasi->anggota->nama }}</td>
                <td>{{ $value->karyawan_koperasi->loker }}</td>
                <td>Rp. {{ number_format($value->karyawan_koperasi->gaji_pokok,0,',','.') }}</td>
                <td>{{ $value->makan / 12500 }}</td>
                <td>Rp. {{ number_format($value->makan,0,',','.') }}</td>
                <td>{{ $value->transport / 12500 }}</td>
                <td>Rp. {{ number_format($value->transport,0,',','.') }}</td>
                <td></td>
                <td>Rp. {{ number_format($value->insentif,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->karyawan_koperasi->gaji_pokok + $value->makan + $value->transport + $value->insentif,0,',','.') }}</td>
                <td>Rp. {{ number_format(($value->karyawan_koperasi->gaji_pokok + $value->makan + $value->transport + $value->insentif) * 12,0,',','.') }}</td>
                <td>
                    @if ($value->karyawan_koperasi->status == 1)
                        <p class="text-dark text-right">Tetap</p>
                    @elseif($value->karyawan_koperasi->status == 2)
                        <p class="text-dark text-right">Kontrak</p>
                    @elseif($value->karyawan_koperasi->status == 3)
                        <p class="text-dark text-right">Tenaga Lepas Harian (TLH)</p>
                    @else
                        <p class="text-dark text-right">Keluar</p>
                    @endif
                </td>
                <td>
                    @if ($value->karyawan_koperasi->anggota->pengguna->jenis_kelamin != null)
                        <p class="text-dark text-right">{{ $value->karyawan_koperasi->anggota->pengguna->jenis_kelamin }}</p>
                    @else
                        <p class="text-dark text-right">Tidak Diketahui</p>
                    @endif
                </td>
                <td>{{ $value->karyawan_koperasi->pajak->kode }}</td>
                <td>Rp. {{ number_format($value->karyawan_koperasi->pajak->total_gaji,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->rapel,0,',','.') }}</td>
                <td></td>
                <td>Rp. {{ number_format($value->jamsostek,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->karyawan_koperasi->gaji_pokok + $value->makan + $value->transport + $value->insentif + $value->rapel + $value->jamsostek,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->potongan_simpanan_wajib,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->potongan_simpanan_pokok,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->potongan_simpanan,0,',','.') }}</td>
                <td></td>
                <td>Rp. {{ number_format($value->potongan_pinjaman,0,',','.') }}</td>
                <td></td>
                <td>Rp. {{ number_format($value->mangkir,0,',','.') }}</td>
                <td>Rp. {{ number_format($pph,0,',','.') }}</td>
                <td>Rp. {{ number_format($value->jamsostek,0,',','.') }}</td>
                <td>Rp. {{ number_format(($value->karyawan_koperasi->gaji_pokok + $value->makan + $value->transport + $value->insentif + $value->rapel + $value->jamsostek) - ($value->potongan_simpanan_wajib + $value->potongan_simpanan_pokok + $value->potongan_simpanan + $value->potongan_pinjaman + $pph + $value->jamsostek),0,',','.') }}</td>
            </tr>            
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center"><b>Jumlah Total</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('gaji_pokok'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('makan'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('transport'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('insentif'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('gaji_pokok') + $gaji->sum('makan') + $gaji->sum('transport') + $gaji->sum('insentif'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format(($gaji->sum('gaji_pokok') + $gaji->sum('makan') + $gaji->sum('transport') + $gaji->sum('insentif')) * 12,0,',','.') }}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('rapel'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('jamsostek'),0,',','.') }}</b> </td>
            <td><b>Rp. {{ number_format($gaji->sum('gaji_pokok') + $gaji->sum('makan') + $gaji->sum('transport') + $gaji->sum('insentif') + $gaji->sum('rapel') + $gaji->sum('jamsostek'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('potongan_simpanan_wajib'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('potongan_simpanan_pokok'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('potongan_simpanan'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('potongan_pinjaman'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('mangkir'),0,',','.') }}</b></td>
            <td></td>
            <td><b>Rp. {{ number_format($gaji->sum('jamsostek'),0,',','.') }}</b></td>
            <td><b>Rp. {{ number_format($gaji->sum('total_gaji'),0,',','.') }}</b></td>
        </tr>
    </tbody>
</table>