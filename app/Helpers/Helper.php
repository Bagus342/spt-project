<?php
function formatTanggal($tgl)
{
    $listBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
    $bulan = explode('-', $tgl);
    $nobulan = (int) $bulan[1];
    return $bulan[2] . '/' . $listBulan[$nobulan] . '/' . $bulan[0];
}
