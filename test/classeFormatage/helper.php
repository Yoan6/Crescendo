<?php

function mettreEnCouleur(string $ansiColor, string $message)
{
    fwrite(STDERR, $ansiColor . $message ."\e[0m");
}
function OK() {
    mettreEnCouleur("\e[1;32m","OK\n");
  }
function notOK()
{
    mettreEnCouleur("\e[1;4;31m","NOT OK\n");
}

?>