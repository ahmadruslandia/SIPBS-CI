<h1>Laporan Alternatif</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Alternatif</th>
            <th>Keterangan</th>
            <th>Alamat</th>
            <th>Nama Pengelola</th>
            <th>Nomor Telepon</th>
        </tr>
    </thead>
    <?php
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row->kode_alternative ?></td>
            <td><?= $row->nama_alternative ?></td>
            <td><?= $row->keterangan ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= $row->nama_pengelola ?></td>
            <td>+<?= $row->nomor_telepon ?></td>
        </tr>
    <?php endforeach ?>
</table>