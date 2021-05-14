<?php

class class_artikel {
    public $id;
    public $name;
    public $beschreibung;
    public $preis;
    public $anzahl;
    public $lieferant;
//    public $properties;

    static $db;


    public function __construct($data = false)
    {
        $liefer_data = class_lieferant::getSingle(intval($data['liefer_id']));

        $this->id = $data['art_id'];
        $this->name = $data['name'];
        $this->beschreibung = $data['beschreibung'];
        $this->preis = $data['preis'];
        $this->anzahl = $data['anzahl'];
        $this->lieferant = new class_lieferant($liefer_data);
//        $this->properties = $data['properties'];
    }

    public static function getAll(): array
    {
        self::$db = db::get_db();
        $sql = "SELECT * FROM artikel";

        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = new class_artikel(mb_convert_encoding($row, 'HTML-ENTITIES', 'UTF-8'));
        }
//        response::debug($ret);
        return $ret;
    }

    public static function getSingle($id): array
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM artikel WHERE art_id = ? LIMIT 1";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc() ?? array();
    }

    public static function putNew($data): bool
    {
        self::$db = db::get_db();
        $sql = "INSERT INTO artikel 
                    (
                     `name`, 
                     `beschreibung`, 
                     `preis`, 
                     `anzahl`, 
                     `liefer_id`
                     ) 
                    VALUES(?, ?, ?, ?, ?)";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('sssss',
            $data['name'],
            $data['beschreibung'],
            $data['preis'],
            $data['anzahl'],
            $data['liefer_id'],
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

        array_push($data, $id);
        $amnt = str_repeat('s', count($data));

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param($amnt, $data);

        return (bool) $stmt->execute();
    }
}