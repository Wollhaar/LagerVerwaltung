<?php


class class_transaktion
{
    public $id;
    public $bezeichnung;
    public $typ;
    public $datum;
    public $artikelList;
    public $lieferant;
    public $lager;


    public function __construct($data = false)
    {
        $lieferant = new class_lieferant(class_lieferant::getSingle($data['liefer_id']));
        $lager = new class_lager(class_lager::getSingle($data['lager_id']));

        $this->id = $data['trans_id'];
        $this->bezeichnung = $data['bezeichnung'];
        $this->typ = $data['typ'];
        $this->datum = $data['datum'];
        $this->lieferant = $lieferant;
        $this->lager = $lager;
    }

    public static function getAll(): array
    {
        $sql = "SELECT trans_id, bezeichnung, typ, datum, liefer_id, lager_id FROM transaktion";
        $stmt = db::get_db()->prepare($sql);
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
        $sql = "INSERT INTO transaktion (`bezeichnung`, `typ`, `liefer_id`, `lager_id`) VALUES(?, ?, ?, ?)";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('ssss',
            $data['bezeichnung'],
            $data['typ'],
            $data['liefer_id'],
            $data['lager_id'],
        );

        return $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        $sql = "DESCRIBE transaktion";
        $stmt = db::get_db()->query($sql);

        $sql = "UPDATE transaktion SET ";
        $arr = array();
        while ($attr = $stmt->fetch_assoc()) {
            if (key_exists($attr['Field'], $data)) {
                $sql .= " $attr[Field] = ?,";
                array_push($arr, $data[$attr['Field']]);
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE trans_id = ? LIMIT 1";

        array_push($arr, $id);
        $amnt = str_repeat('s', count($arr));

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param($amnt, ...$arr);

        return (bool) $stmt->execute();
    }

    public function ausfuehren() {}

    public function loeschen() {}
}