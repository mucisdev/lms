<?php

use App\Models\M_semester;
use Config\Services;


// ------------------------------------------------------------------------

if (!function_exists('controller_name')) {
    /**
     * Mengambil nama controller
     * 
     *  @author Wahyu Kamaludin
     *  @return string Nama controller yang sedang diakses
     */
    function controller_name()
    {
        $router = service('router');
        $controller = $router->controllerName();
        $nama_controller = explode("\\", $controller);
        return strtolower(end($nama_controller));
        // $request = Services::request();
        // return $request->uri->getSegment(1);
    }
}

// ------------------------------------------------------------------------

if (!function_exists('method_name')) {
    /**
     * Mengambil nama controller
     * 
     *  @author Wahyu Kamaludin
     *  @return string Nama controller yang sedang diakses
     */
    function method_name()
    {
        $router = service('router');
        return $router->methodName();
    }
}

// ------------------------------------------------------------------------

if (!function_exists('uuid_v4')) {
    /**
     * UUID versi 4
     *
     * Membuat nilai UUID versi 4 secara otomatis.
     * @author Dan Storm
     * @link http://catalystcode.net/
     * @license GNU LPGL
     * @version 2.1
     *
     * @param boolean
     * @return string Nilai UUID versi 4
     */
    function uuid_v4(bool $trim = false)
    {

        $format = ($trim == false) ? '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' : '%04x%04x%04x%04x%04x%04x%04x%04x';

        return sprintf(
            $format,

            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}

// ------------------------------------------------------------------------

if (!function_exists('set_password')) {
    /**
     * Set Password
     *
     * Ubah pasword dengan password_hash default.
     * @author Wahyu Kamaludin
     * @param   string Text password
     * @return	string  Return password_hash
     */
    function set_password(string $pass)
    {
        // hash dengan password_default
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}

// ------------------------------------------------------------------------

if (!function_exists('response')) {
    /**
     * Response
     *
     * Mengirimkan array response
     * @author Wahyu Kamaludin
     * @param   boolean status berupa true atau false
     * @param   string pesan yang ingin disampaikan
     * @return	array  Return array
     */
    function response(bool $status, string $message)
    {
        if ($status)
            $response = [
                'status' => true,
                'message' => $message,
                'type' => 'success'
            ];
        else {
            $response = [
                'status' => false,
                'message' => $message,
                'type' => 'danger'
            ];
        }

        return $response;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('arr_trim')) {
    /**
     * Array trim
     *
     * Menghapus spasi (awal dan akhir) pada nilai array dengan fungsi array_map()
     * @author Wahyu Kamaludin
     * @param   array data array yang akan di trim
     * @return	array Return array yang sudah di trim
     */
    function arr_trim(array $array)
    {
        $arr_trim = array_map('trim', $array);
        return $arr_trim;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('file_tipe')) {
    /**
     * File tipe
     * 
     * menentukan ikon sesuai jenis file
     */
    function file_tipe($ext)
    {
        $ext = strtolower($ext);
        if ($ext == '.docx' or $ext == '.doc') :
            $icon = 'align-middle fas fa-fw fa-file-word text-primary';
        elseif ($ext == '.xls' or $ext == '.xlsx' or $ext == '.csv') :
            $icon = 'align-middle fas fa-fw fa-file-excel text-success';
        elseif ($ext == '.pdf') :
            $icon = 'align-middle fas fa-fw fa-file-pdf text-danger';
        elseif ($ext == '.ppt' or $ext == '.pptx') :
            $icon = 'align-middle fas fa-fw fa-file-powerpoint text-warning';
        elseif ($ext == '.jpg' || $ext == '.jpeg' || $ext == '.png') :
            $icon = 'align-middle fas fa-fw fa-file-image text-primary';
        else :
            $icon = 'align-middle fas fa-fw fa-file';
        endif;
        return $icon;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('time_stamp')) {
    function time_stamp($timestamp)
    {
        $awal = date_create($timestamp);
        $akhir = date_create();
        $diff = date_diff($awal, $akhir, true);
        if ($diff->y > 0) {
            $teks = $diff->y . ' tahun yang lalu';
        } else if ($diff->m > 0) {
            $teks = $diff->m . ' bulan yang lalu ';
        } else if ($diff->d > 0) {
            $teks = $diff->d . ' hari yang lalu';
        } else if ($diff->h > 0) {
            $teks = $diff->h . ' jam yang lalu';
        } else if ($diff->i > 0) {
            $teks = $diff->i . ' menit yang lalu';
        } else {
            $teks = 'Baru saja';
        }

        return $teks;
    }
}
