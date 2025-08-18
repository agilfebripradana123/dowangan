<?php
if (!function_exists('mask')) {
    function mask($value) {
        $val = trim((string) $value);
        $len = strlen($val);
        return $len > 3 ? substr($val, 0, 3) . str_repeat('*', $len - 3) : $val;
    }
}

if (!function_exists('getYoutubeId')) {
    function getYoutubeId($url) {
        $url = trim((string) $url);
        if ($url === '') return null;

        // Ambil dari query ?v=
        $parts = parse_url($url);
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $q);
            if (!empty($q['v']) && preg_match('/^[\w-]{11}$/', $q['v'])) {
                return $q['v'];
            }
        }

        // Ambil dari path: /shorts/ID, /embed/ID, /v/ID, youtu.be/ID
        if (!empty($parts['path'])) {
            if (preg_match('~/(shorts|embed|v)/([\w-]{11})~', $parts['path'], $m)) {
                return $m[2];
            }
            if (preg_match('~^/([\w-]{11})$~', $parts['path'], $m)) {
                return $m[1];
            }
        }

        // Kalau yang disimpan memang ID murni
        if (preg_match('/^[\w-]{11}$/', $url)) {
            return $url;
        }
        return null;
    }

}
