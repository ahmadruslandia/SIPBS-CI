<h1>Laporan Kriteria</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Atribut</th>
            <th>Bobot</th>
        </tr>
    </thead>
    <?php
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row->kode_criteria ?></td>
            <td><?= $row->nama_criteria ?></td>
            <td><?= $row->atribut ?></td>
            <td><?= $row->bobot ?></td>
        </tr>
    <?php endforeach ?>
</table>