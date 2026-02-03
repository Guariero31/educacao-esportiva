<?php

if (!function_exists('removeMascaraCpf')) {
    function removeMascaraCpf($cpf)
    {
        return preg_replace('/[^0-9]/', '', $cpf);
    }
}
if (!function_exists('timeFormat')) {
    function timeFormat($time)
    {
        $tempo = \Carbon\Carbon::createFromFormat('H:i:s', trim($time));
        return $tempo->format('H:i');
    }
}
