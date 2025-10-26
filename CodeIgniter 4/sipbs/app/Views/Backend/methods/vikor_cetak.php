<h1><?= $title ?></h1>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Alternatif Kriteria
        </h3>
    </div>
    <div class="table-responsive collapse">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($criteria as $key => $val) : ?>
                        <th><?= $val['nama_criteria'] ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($vikor->data as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $alternative[$key]->nama_alternative ?></td>
                    <?php foreach ($val as $k => $v) : $minmax[$k][$key] = $v ?>
                        <td><?= round($v, 3) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right">Max</td>
                    <?php foreach ($vikor->minmax as $key => $val) : ?>
                        <td><?= round($val['max'], 3) ?></td>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Min</td>
                    <?php foreach ($vikor->minmax as $key => $val) : ?>
                        <td><?= round($val['min'], 3) ?></td>
                    <?php endforeach ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Normalisasi Matriks
        </h3>
    </div>
    <div class="table-responsive collapse">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <?php foreach ($criteria as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($vikor->normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 3) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Nilai Utilitas (S) dan Ukuran Regret (R)
        </h3>
    </div>
    <div class="table-responsive collapse">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <?php foreach ($criteria as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td>Bobot</td>
                    <?php foreach ($vikor->bobot as $key => $val) : ?>
                        <td><?= round($val, 4) ?></td>
                    <?php endforeach ?>
                    <td>S</td>
                    <td>R</td>
                </tr>
            </thead>
            <?php foreach ($vikor->terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 3) ?></td>
                    <?php endforeach ?>
                    <td><?= round($vikor->total_s[$key], 3) ?></td>
                    <td><?= round($vikor->total_r[$key], 3) ?></td>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="<?= count($criteria) + 1 ?>">S*</td>
                    <td><?= round($vikor->nilai_s['max'], 3) ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="<?= count($criteria) + 1 ?>">S-</td>
                    <td><?= round($vikor->nilai_s['min'], 3) ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="<?= count($criteria) + 1 ?>">R*</td>
                    <td>&nbsp;</td>
                    <td><?= round($vikor->nilai_r['max'], 3) ?></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="<?= count($criteria) + 1 ?>">R-</td>
                    <td>&nbsp;</td>
                    <td><?= round($vikor->nilai_r['min'], 3) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Perangkingan
        </h3>
    </div>
    <div class="table-responsive collapse">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Nilai v</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <?php foreach ($vikor->rank as $key => $val) :
                \App\Helpers\query("UPDATE tb_alternative SET total_vikor='{$vikor->nilai_v[$key]}', rank_vikor='$val' WHERE kode_alternative='$key'");
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $alternative[$key]->nama_alternative ?></td>
                    <td><?= round($vikor->nilai_v[$key], 3) ?></td>
                    <td><?= round($vikor->rank[$key], 3) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>