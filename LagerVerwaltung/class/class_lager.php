<?php

class class_lager {
    public int $id;
    public $bezeichnung;
    //public $kapazitaet; // in prozent?
    public $gate; // als modul schnittstelle??? oder als Eingangs- und/oder Ausgangspunkt(Tor) für Waren
    public $properties;

    public function inventur() {}

    public function annahme() {}

    public function abgabe() {}
}