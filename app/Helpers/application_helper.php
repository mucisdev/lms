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
        // $router = service('router');
        // $controller = $router->controllerName();
        // $nama_controller = explode("\\", $controller);
        // return end($nama_controller);
        $request = Services::request();
        return $request->uri->getSegment(1);
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

if (!function_exists('enkrip_str')) {
    /**
     * Enkripsi String
     *
     * Mengenkripsi string dengan openssl_encrypt() dari PHP
     * @author Wahyu Kamaludin
     * @param   string string yang akan dienkripsi
     * @return	string string yang sudah dienkripsi
     */
    function enkrip_str(string $plainteks = null)
    {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1111222233334444';

        // Store the encryption key
        $encryption_key = "wahyuos";

        // Use openssl_encrypt() function to encrypt the data
        $encryption_str = openssl_encrypt(
            $plainteks,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );

        return $encryption_str;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('dekrip_str')) {
    /**
     * Enkripsi String
     *
     * Mengenkripsi string dengan openssl_encrypt() dari PHP
     * @author Wahyu Kamaludin
     * @param   string string yang akan dienkripsi
     * @return	string string yang sudah dienkripsi
     */
    function dekrip_str(string $encryption_str = null)
    {
        // Decryption of string process starts

        // Store the cipher method
        $ciphering = "AES-128-CTR";
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $decryption_iv = '1111222233334444';

        // Store the encryption key
        $decryption_key = "wahyuos";

        // Descrypt the string
        $decryption_str = openssl_decrypt(
            $encryption_str,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );

        return $decryption_str;
    }
}

// ------------------------------------------------------------------------


if (!function_exists('smt_aktif')) {
    /**
     * Semester aktif
     * 
     * Untuk mengambil data semester aktif berdasarkan tanggal saat ini
     */
    function smt_aktif()
    {
        $today = date('Y-m-d');
        $m_smt = new M_semester();
        $smt_aktif = $m_smt->where(['tgl_mulai <= ' => $today, 'tgl_selesai >= ' => $today])->first();
        return $smt_aktif;
    }
}
