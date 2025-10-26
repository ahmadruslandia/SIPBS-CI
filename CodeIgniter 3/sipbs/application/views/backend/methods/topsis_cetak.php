<h1><?= $title ?></h1>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa
        </h3>
    </div>
    <div class="table-responsive collapse">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <thead>
                    <th>#</th>
                    <?php foreach ($criteria as $key => $val) : ?>
                        <th><?= $val->nama_criteria ?></th>
                    <?php endforeach ?>
                </thead>
            </tr>
            <?php foreach ($rel_alternative as $key => $val) : ?>
                <tr>
                    <td><?= $alternative[$key]->nama_alternative ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= (isset($crips[$v]->nama_crips)) ? $crips[$v]->nama_crips : "-" ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel-heading">
    <h3 class="panel-title">
        Data Nilai
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <thead>
                <th>#</th>
                <?php foreach ($criteria as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach ?>
            </thead>
        </tr>
        <?php foreach ($rel_nilai as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <?php foreach ($val as $k => $v) : ?>
                    <td><?= $v ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<div class="panel-heading">
    <h3 class="panel-title">
        Normalisasi
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <thead>
                <th>#</th>
                <?php foreach ($criteria as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach ?>
            </thead>
        </tr>
        <?php foreach ($topsis->normal as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <?php foreach ($val as $k => $v) : ?>
                    <td><?= round($v, 4) ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="panel-heading">
    <h3 class="panel-title">
        Normalisasi Matriks
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <?php foreach ($criteria as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tr>
            <td>Bobot</td>
            <?php foreach ($criteria as $k => $v) : ?>
                <td><?= $v->bobot ?></td>
            <?php endforeach ?>
        </tr>
        <?php foreach ($topsis->terbobot as $key => $val) : ?>
            <tr>
                <td><?= $alternative[$key]->nama_alternative ?></td>
                <?php foreach ($val as $k => $v) : ?>
                    <td><?= round($v, 5) ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="panel-heading">
    <h3 class="panel-title">
        Jarak Solusi & Nilai Preferensi
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <?php foreach ($criteria as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <?php foreach ($topsis->solusi_ideal as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <?php foreach ($val as $k => $v) : ?>
                    <td><?= round($v, 5) ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<div class="panel-heading">
    <h3 class="panel-title">
        Jarak Solusi & Nilai Preferensi
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Positif</th>
                <th>Negatif</th>
                <th>Preferensi</th>
            </tr>
        </thead>
        <?php foreach ($topsis->jarak_solusi as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= round($val['positif'], 5) ?></td>
                <td><?= round($val['negatif'], 5) ?></td>
                <td><?= round($topsis->pref[$key], 5) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<div class="panel-heading">
    <h3 class="panel-title">
        Perangkingan
    </h3>
</div>
<div class="table-responsive collapse">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Total</th>
            <th>Rank</th>
        </tr>
        <?php foreach ($topsis->rank as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $alternative[$key]->nama_alternative ?></td>
                <td><?= round($topsis->pref[$key], 4) ?></td>
                <td><?= $val ?> </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>