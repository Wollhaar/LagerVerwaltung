<?php
class response{
    private static $debug = array();
    public static $er = true;

    public static function send($array, $code = 200) {
        session::save();

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($code);

        if (!is_array($array)) $array = array($array);
        if (!empty(self::$debug)) {
            $array['_debug'] = self::$debug;
        }

        if (self::$er) {
            if (!empty($out = ob_get_clean())) {
                $array['_error'] = $out;
            }
        }

        echo json_encode($array, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR);
        die();
    }

    public static function debug($data) {
        self::$debug[] = var_export($data, true);
    }
}