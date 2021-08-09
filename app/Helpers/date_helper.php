<?php

// mengambil hari dari tanggal
function hari($tanggal)
{
    $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    // tentukan nama hari
    $nama_hari = date('w', strtotime($tanggal));
    // kembalikan nama hari
    return $hari[$nama_hari];
}

// mengambil bulan dri tanggal
function bulan($tanggal)
{
    $bulan    = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
    // pisahkan untuk mengambil angka bulan
    $pecahkan = explode('-', $tanggal);
    // kembalikan nama bulan dalam bentuk string
    return $bulan[(int) $pecahkan[1]];
}

// memformat bentuk tanggal
function tanggal($tanggal, $format = null)
{
    if ($tanggal) {
        // cek apakah ada jam nya
        $tgl_jam = explode(" ", $tanggal);
        // jika hanya tanggal
        if (count($tgl_jam) < 2) {
            $new_tgl = $tgl_jam[0];
            $jam     = "";
        } else {
            $new_tgl = $tgl_jam[0];
            $jam     = " " . $tgl_jam[1];
        }

        // nama hari
        $hari = hari($new_tgl);
        // memisahkan tanggal untuk menyesuaikan posisinya
        $pecahkan = explode('-', $new_tgl);
        // nama bulan
        $nm_bulan = bulan($new_tgl);

        if ($format == 's') {
            // jika s, maka nama bulan disingkat, hanya 3 huruf pertama (tanpa hari)
            return $pecahkan[2] . ' ' . substr($nm_bulan, 0, 3) . ' ' . $pecahkan[0] . $jam;
        } elseif ($format == 'p') {
            // jika p, maka nama bulan tidak disingkat (tanpa hari)
            return $pecahkan[2] . ' ' . $nm_bulan . ' ' . $pecahkan[0] . $jam;
        } elseif ($format == 'n') {
            // jika n, maka nama bulan ganti angka (tanpa hari)
            return $pecahkan[2] . '-' . $pecahkan[1] . '-' . $pecahkan[0] . $jam;
        } else {
            // jika kosong, maka akan ditampilkan tanggal lengkap (har, tanggal bulan tahun)
            return $hari . ', ' . $pecahkan[2] . ' ' . $nm_bulan . ' ' . $pecahkan[0] . $jam;
        }
    } else {
        return "Format tanggal salah";
    }
}

// ubah tanggal ke format sql
function tanggal_sql($tanggal)
{
    if ($tanggal) {
        // pisahkan berdasarkan -
        $pisahkan_tanggal = explode("-", $tanggal);
        // atur tanggal ke yyyy-mm-dd
        $tanggal_sql = $pisahkan_tanggal[2] . '-' . $pisahkan_tanggal[1] . '-' . $pisahkan_tanggal[0];
        return $tanggal_sql;
    } else {
        // atur ke nol
        return "0000-00-00";
    }
}
