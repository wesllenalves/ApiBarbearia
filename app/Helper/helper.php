<?php

if (! function_exists('include_routes')) {

    /**
     * Acessa um diretorio e seus subdiretorios para requerer todos os arquivos
     *
     * @param $pasta
     */
    function include_routes($pasta)
    {
        try {
            $rdi = new recursiveDirectoryIterator($pasta);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}