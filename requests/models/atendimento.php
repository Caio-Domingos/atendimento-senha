<?php
class Produto {
    public $codAtende;
    public $dataAtende;
    public $senhaAtende;
    public $statusAtende;

    function __construct(
        $codAtende, 
        $dataAtende,
        $senhaAtende,
        $statusAtende
    ) {
        $this->setCodAtende($codAtende);
        $this->setDataAtende($dataAtende);
        $this->setSenhaAtende($senhaAtende);
        $this->setStatusAtende($statusAtende);
    }

    public function setCodAtende($val) {
        $this->codAtende = $val;
    }
    public function setDataAtende($val) {
        $this->dataAtende = $val;
    }
    public function setSenhaAtende($val) {
        $this->senhaAtende = $val;
    }
    public function setStatusAtende($val) {
        $this->statusAtende = $val;
    }
}