<?php


    namespace Library\DataAccess;


    use JsonSerializable;

    abstract class Identifier implements JsonSerializable
    {
        //<editor-fold defaultstate="collapsed" desc="Properties">
        //</editor-fold>
        public function asString()
        {
            return $this->__toString();
        }

        abstract public function asInt();

        abstract public function __toString();

    }