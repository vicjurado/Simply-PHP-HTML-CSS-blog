<?php

function recortarTexto($texto, $longitud = 400)
{
    $texto = $texto . " ";
    $texto = substr($texto, 0, $longitud);
    $texto = substr($texto, 0, strrpos($texto, " "));
    $texto = $texto . "...";
    return $texto;
}

?>