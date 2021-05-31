<?php

class class_artikel {
    public $id;
    public $name;
    public $beschreibung;
    public $preis;
    public $anzahl;
    public $lieferant;


    public function __construct($data = false)
    {
        $liefer_data = class_lieferant::getSingle(intval($data['liefer_id']));

        $this->id = $data['art_id'];
        $this->name = $data['name'];
        $this->beschreibung = $data['beschreibung'];
        $this->preis = $data['preis'];
        $this->anzahl = $data['anzahl'] ?? 0;
        $this->lieferant = new class_lieferant($liefer_data);

    }

    public static function getAll(): array
    {
        $sql = "SELECT art_id FROM artikel";

        $stmt = db::get_db()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $single = self::getSingle($row['art_id']);
            $ret[] = new class_artikel($single);
        }
        return $ret;
    }

    public static function getSingle($id): array
    {
        $sql = "SELECT art.art_id, 
                    art.name, 
                    art.beschreibung, 
                    art.preis, 
                    SUM(artlist.anzahl) as anzahl, 
                    art.liefer_id  
                FROM `artikel` AS art 
                LEFT JOIN artikelliste AS artlist 
                    ON art.art_id = artlist.art_id 
                LEFT JOIN transaktion AS trans 
                    ON trans.trans_id = artlist.trans_id
                WHERE art.art_id = ? AND trans.bezeichnung = 'annahme'";

        $sql2 = "SELECT SUM(artlist.anzahl) as anzahl FROM `artikel` AS art 
                    LEFT JOIN artikelliste AS artlist 
                        ON art.art_id = artlist.art_id 
                    LEFT JOIN transaktion AS trans 
                        ON trans.trans_id = artlist.trans_id
                    WHERE art.art_id = ? AND trans.bezeichnung = 'abgabe'";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc() ?? array();

        $stmt2 = db::get_db()->prepare($sql2);
        $stmt2->bind_param('s', $id);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
        $row = $res2->fetch_assoc();
        if (!empty($res) && !empty($res['anzahl'])) $res['anzahl'] -= $row['anzahl'];
        return $res;
    }


    public static function search($name): array
    {
        $sql = "SELECT * FROM artikel WHERE `name` = ? LIMIT 1";
        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc() ?? array();
    }

    public static function putNew($data): bool
    {
        $sql = "INSERT INTO artikel 
                    (
                     `name`, 
                     `beschreibung`, 
                     `preis`, 
                     `anzahl`, 
                     `liefer_id`
                     ) 
                    VALUES(?, ?, ?, ?, ?)";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('sssss',
            $data['name'],
            $data['beschreibung'],
            $data['preis'],
            $data['anzahl'],
            $data['liefer_id'],
        );

        return $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        $sql = "DESCRIBE artikel";
        $stmt = db::get_db()->query($sql);
        $sql = "UPDATE artikel SET ";

        $arr = array();
        while ($attr = $stmt->fetch_assoc()) {
            if (key_exists($attr['Field'], $data)) {
                $sql .= " $attr[Field] = ?,";
                array_push($arr, $data[$attr['Field']]);
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE art_id = ? LIMIT 1";

        array_push($arr, $id);
        $amnt = str_repeat('s', count($arr));

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param($amnt, ...$arr);

        return $stmt->execute();
    }
}