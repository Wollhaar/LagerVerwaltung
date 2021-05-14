<?php

class class_lager {
    public int $id;
    public $bezeichnung;
    //public $kapazitaet; // in prozent?
    public $gate; // als modul schnittstelle??? oder als Eingangs- und/oder Ausgangspunkt(Tor) für Waren
//    public $properties;


    static $db;


    public function __construct($data = false)
    {
        $this->id = $data['art_id'];
        $this->name = $data['name'];
        $this->gate = $data['gate'];
    }

    public static function getAll(): array
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM lager LEFT JOIN artikel ON lager.lager_id = artikel.art_id";

        $stmt = self::$db->prepare($sql);
        if ($stmt->execute()) ('success');
        $res = $stmt->get_result();

        $ret = array();
//        response::send($res->fetch_assoc());
        while ($row = $res->fetch_assoc()) {
            $ret[] = new class_artikel($row);
            $ret[] = $row;
            echo json_encode($row);
        }
//        response::send($ret);
        return $ret;
    }

    public function annahme($data): bool
    {
        self::$db = db::get_db();
        $sql = "INSERT INTO lager (`name`, `bezeichnung`, `gate`) VALUES(?, ?, ?)";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('sss',
            $data['name'],
            $data['beschreibung'],
            $data['preis'],
        );

        return (bool) $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        self::$db = db::get_db();

        $sql = "UPDATE artikel SET ";
        foreach ($data as $attr => $value) {
            $sql .= " $attr = ?";
        }
        $sql .= " WHERE art_id = ? LIMIT 1";

        $amnt = str_repeat('s', count($data));

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param($amnt, $data);

        return (bool) $stmt->execute();
    }

    public function inventur() {}

    public function abgabe() {}
}