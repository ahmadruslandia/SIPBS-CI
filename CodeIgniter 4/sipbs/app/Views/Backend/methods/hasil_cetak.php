<h1>Laporan Hasil Metode</h1>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Alternatif</th>
            <th>Keterangan</th>
            <th>Total TOPSIS</th>
            <th>Total VIKOR</th>
            <th>Rank TOPSIS</th>
            <th>Rank VIKOR</th>
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
            <td><?= round($row->total_topsis, 4) ?></td>
            <td><?= round($row->total_vikor, 4) ?></td>
            <td><?= $row->rank_topsis ?></td>
            <td><?= $row->rank_vikor ?></td>
        </tr>
    <?php endforeach ?>
</table>