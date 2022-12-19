<?php

    class Tarefa {

        private $id;
        private $idStatus;
        private $tarefa;
        private $dataCadastro;

        public function __construct() {
            //$this->id = $id;
            //$this->idStatus = $idStatus;
            //$this->tarefa = $tarefa;
            //$this->dataCadastro = $dataCadastro;
        }

        public function __get($attribute) {
            return $this->$attribute;
        }

        public function __set($attribute, $value) {
            $this->$attribute = $value;
        }
    }
?>