<?php
class VIKOR
{
    public $data, $atribut, $bobot, $index_vikor;
    public $minmax, $normal, $terbobot, $total_r, $total_s, $nilai_r, $nilai_s, $nilai_v, $rank;
    function __construct($data, $atribut, $bobot, $index_vikor = 0.5)
    {
        $this->data = $data;
        $this->atribut = $atribut;
        $this->bobot = $bobot;
        $this->index_vikor = $index_vikor;
        $this->minmax();
        $this->normal();
        $this->terbobot();
        $this->total_sr();
        $this->nilai_sr();
        $this->nilai_v();
        $this->rank();
    }
    function rank()
    {
        $data = $this->nilai_v;
        asort($data);
        $no = 1;
        $this->rank = array();
        foreach ($data as $key => $value) {
            $this->rank[$key] = $no++;
        }
    }
    function nilai_v()
    {
        $this->nilai_v = array();
        foreach ($this->total_s as $key => $val) {
            $v = $this->index_vikor;
            $s = $this->total_s[$key];
            $r = $this->total_r[$key];
            $s_min = $this->nilai_s['min'];
            $s_plus = $this->nilai_s['max'];
            $r_min = $this->nilai_r['min'];
            $r_plus = $this->nilai_r['max'];
            $this->nilai_v[$key] = $v * ($s - $s_min) / ($s_plus - $s_min) + (1 - $v) * ($r - $r_min) / ($r_plus - $r_min);
        }
    }
    function nilai_sr()
    {
        $this->nilai_s['max'] = max($this->total_s);
        $this->nilai_s['min'] = min($this->total_s);
        $this->nilai_r['max'] = max($this->total_r);
        $this->nilai_r['min'] = min($this->total_r);
    }
    function total_sr()
    {
        foreach ($this->terbobot as $key => $val) {
            $this->total_s[$key] = array_sum($val);
            $this->total_r[$key] = max($val);
        }
    }
    function terbobot()
    {
        $arr = array();
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = $v * $this->bobot[$k];
            }
        }
        $this->terbobot = $arr;
    }
    function normal()
    {
        $arr = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = ($this->minmax[$k]['max'] - $v) / ($this->minmax[$k]['max'] - $this->minmax[$k]['min']);
            }
        }
        $this->normal = $arr;
    }
    function minmax()
    {
        $arr = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$k][$key] = $v;
            }
        }
        $arr2 = array();
        foreach ($arr as $key => $val) {
            if ($this->atribut[$key] == 'benefit') {
                $arr2[$key]['min'] = min($val);
                $arr2[$key]['max'] = max($val);
            } else {
                $arr2[$key]['min'] = max($val);
                $arr2[$key]['max'] = min($val);
            }
        }
        $this->minmax = $arr2;
    }
}

class TOPSIS
{
    public $rel_alternative;
    public $bobot;
    public $bobot_normal;
    public $atribut;
    public $kuadrat;
    public $kuadrat_total;
    public $akar;
    public $normal;
    public $terbobot;
    public $solusi_ideal;
    public $matriks_solusi;
    public $jarak_solusi;
    public $pref;
    public $rank;

    function __construct($rel_alternative, $atribut, $bobot)
    {
        $this->rel_alternative = $rel_alternative;
        $this->bobot = $bobot;
        $this->atribut = $atribut;
        $this->get_bobot_normal();
        $this->normal();
        $this->terbobot();
        $this->solusi_ideal();
        $this->jarak_solusi();
        $this->pref();
        $this->rank();
    }
    function rank()
    {
        $temp = $this->pref;
        arsort($temp);
        $no = 1;
        $this->rank = array();
        foreach ($temp as $key => $value) {
            $this->rank[$key] = $no++;
        }
    }

    function get_bobot_normal()
    {
        $this->bobot_normal = array();
        $total = array_sum($this->bobot);
        foreach ($this->bobot as $key => $val) {
            $this->bobot_normal[$key] = $val;
        }
    }

    function normal()
    {
        foreach ($this->rel_alternative as $key => $val) {
            foreach ($val as $k => $v) {
                $this->kuadrat[$key][$k] = $v * $v;
            }
        }
        $this->kuadrat_total = array();
        foreach ($this->kuadrat as $key => $val) {
            foreach ($val as $k => $v) {
                if (!isset($this->kuadrat_total[$k]))
                    $this->kuadrat_total[$k] = 0;
                $this->kuadrat_total[$k] += $v;
            }
        }
        foreach ($this->kuadrat_total as $key => $val) {
            $this->akar[$key] = sqrt($val);
        }
        foreach ($this->rel_alternative as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = $v / $this->akar[$k];
            }
        }
    }
    function terbobot()
    {
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $this->terbobot[$key][$k] = $v * $this->bobot_normal[$k];
            }
        }
    }
    function solusi_ideal()
    {
        $temp = array();
        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                $temp[$k][$key] = $v;
            }
        }
        foreach ($temp as $key => $val) {
            $max = max($val);
            $min = min($val);
            if ($this->atribut[$key] == 'benefit') {
                $this->solusi_ideal['positif'][$key] = $max;
                $this->solusi_ideal['negatif'][$key] = $min;
            } else {
                $this->solusi_ideal['positif'][$key] = $min;
                $this->solusi_ideal['negatif'][$key] = $max;
            }
        }
    }
    function jarak_solusi()
    {
        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                foreach ($this->solusi_ideal as $a => $b) {
                    $this->matriks_solusi[$a][$key][$k] = pow($v - $b[$k], 2);
                }
            }
        }

        $this->jarak_solusi = array();
        foreach ($this->matriks_solusi as $key => $val) {
            foreach ($val as $k => $v) {
                foreach ($v as $a => $b) {
                    if (!isset($this->jarak_solusi[$k][$key]))
                        $this->jarak_solusi[$k][$key] = 0;
                    $this->jarak_solusi[$k][$key] += $b;
                }
            }
        }
        foreach ($this->jarak_solusi as $key => $val) {
            foreach ($val as $k => $v) {
                $this->jarak_solusi[$key][$k] = sqrt($v);
            }
        }
    }
    function pref()
    {
        $this->pref = array();
        foreach ($this->jarak_solusi as $key => $val) {
            if (($val['positif'] + $val['negatif']) == 0)
                $this->pref[$key] = 0;
            else
                $this->pref[$key] = $val['negatif'] / ($val['positif'] + $val['negatif']);
        }
    }
}

function get_resuslts($sql)
{
    $CI = &get_instance();
    return $CI->db->query($sql)->result();
}

function get_row($sql)
{
    $CI = &get_instance();
    return $CI->db->query($sql)->row();
}

function get_var($sql)
{
    $CI = &get_instance();
    $row = $CI->db->query($sql)->row_array();

    if ($row)
        return current($row);
}

function query($sql)
{
    $CI = &get_instance();
    return $CI->db->query($sql);
}

function load_view($view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('header', $data);
    $CI->load->view($view, $data);
    $CI->load->view('footer', $data);
}

function view_cetak($view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('backend/header_cetak', $data);
    $CI->load->view($view, $data);
    $CI->load->view('backend/footer_cetak', $data);
}
function kode_oto($field, $table, $prefix, $length)
{
    $CI = &get_instance();
    $query = $CI->db->query("SELECT $field AS kode FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    $row = $query->row_object();

    if ($row) {
        return $prefix . substr(str_repeat('0', $length) . (substr($row->kode, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}
function load_message($message = '', $type = 'danger')
{
    if ($type == 'danger') {
        $data['title'] = 'Error';
    } else {
        $data['title'] = 'Success';
    }

    $data['class'] = $type;
    $data['message'] = $message;

    load_view('message', $data);
}

function get_crips_option($kode_criteria, $selected = '')
{
    $CI = &get_instance();
    $rows = $CI->crips_model->get_crips_by_criteria($kode_criteria);

    $a = '';
    foreach ($rows as $row) {
        if ($selected == $row->kode_crips)
            $a .= "<option value='$row->kode_crips' selected>$row->nama_crips</option>";
        else
            $a .= "<option value='$row->kode_crips'>$row->nama_crips</option>";
    }
    return $a;
}

function get_criteria_option($selected = '')
{
    $CI = &get_instance();
    $rows = $CI->criteria_model->tampil();

    $a = '';
    foreach ($rows as $row) {
        if ($selected == $row->kode_criteria)
            $a .= "<option value='$row->kode_criteria' selected>$row->nama_criteria</option>";
        else
            $a .= "<option value='$row->kode_criteria'>$row->nama_criteria</option>";
    }
    return $a;
}

function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function print_error()
{
    return validation_errors('<div class="alert alert-danger" alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
}

function dd($arr)
{
    echo '<pre>' . print_r($arr, 1) . '</pre>';
}
