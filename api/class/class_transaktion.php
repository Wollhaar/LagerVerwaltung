<?php


class class_transaktion
{
    public int $id;
    public $bezeichnung;
    public $typ;
    public $propelities;
    public $datum;
    public $artikelList;
    public class_lieferant $lieferant;
    public class_lager $lager;

    public function registrieren() {}

    public function ausfuehren() {}

    public function loeschen() {}
}