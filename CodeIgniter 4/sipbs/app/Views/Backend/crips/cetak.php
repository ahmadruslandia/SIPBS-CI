<h1>Laporan Crips</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kriteria</th>
            <th>Nama Crips</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <?php
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row['nama_criteria'] ?></td>
            <td><?= $row['nama_crips'] ?></td>
            <td><?= $row['nilai'] ?></td>
        </tr>
    <?php endforeach ?>
</table>