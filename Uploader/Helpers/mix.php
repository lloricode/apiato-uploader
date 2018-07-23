<?php

if (!function_exists('formatBytesUnits')) {
    function formatBytesUnits($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'Pi'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
    
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
