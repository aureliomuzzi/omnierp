<?php

namespace App\Services;

class UploadService
{
    public static function upload($arquivo)
    {
        $nomeArquivo = md5(mt_rand(0, 9999) . mt_rand(0, 9999)) . "." . $arquivo->getClientOriginalExtension();
        $arquivo->storeAs('public/images', $nomeArquivo);
        return '/storage/images/' . $nomeArquivo;
    }
}
