<?php


class class_transaktion
{
    public int $id;
    public $bezeichnung;
    public $typ;
    public $propelities;
    public $datum;
    public $artikelList;
//    public class_lieferant $lieferant;
//    public class_lager $lager;


    static $db;


    public function __construct($data = false)
    {
        $this->id = $data['trans_id'];
        $this->bezeichnung = $data['bezeichnung'];
        $this->typ = $data['typ'];
        $this->datum = $data['date'];
//        $this->anzahl = $data['name'];
//        $this->properties = $data['name'];
    }

    public static function getAll(): array
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM artikel LIMIT 1";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = new class_transaktion($row);
        }
        return $ret;
    }

    public function registrieren() {}

    public static function new($data): bool
    {
        self::$db = db::get_db();
        $sql = "INSERT INTO transaktion (`bezeichnung`, `typ`, `liefer_id`, `lager_id`) VALUES(?, ?, ?, ?)";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('sss',
            $data['bezeichnung'],
            $data['typ'],
            $data['liefer_id'],
            $data['lager_id'],
        );

        return (bool) $stmt->execute();
    }
    public static function edit($id, $data): bool
    {
        self::$db = db::get_db();

        $sql = "UPDATE transaktion SET ";
        foreach ($data as $attr => $value) {
            $sql .= " $attr = ?";
        }
        $sql .= " WHERE trans_id < ?";

        $amnt = str_repeat('s', count($data));

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param($amnt, $data);

        return (bool) $stmt->execute();
    }

    public function ausfuehren() {}

    public function loeschen() {}
}