<?php

class class_lager {
    public $id;
    public $name;
    //public $kapazitaet; // in prozent?
    public $gate; // als modul schnittstelle??? oder als Eingangs- und/oder Ausgangspunkt(Tor) für Waren


    public function __construct($data = false)
    {
        if (!$data) return;

        $this->id = $data['lager_id'];
        $this->name = $data['name'];
        $this->gate = $data['gate'];
    }

    public static function getAll(): array
    {
        $sql = "SELECT * FROM lager";

        $stmt = db::get_db()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = new class_lager($row);
        }
        return $ret;
    }

    public static function getSingle($id): array
    {
        $sql = "SELECT * FROM lager WHERE lager_id = ? LIMIT 1";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc() ?? array();
    }

    public function annahme($data): bool
    {
        $sql = "INSERT INTO lager (`name`, `bezeichnung`, `gate`) VALUES(?, ?, ?)";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('sss',
            $data['name'],
            $data['beschreibung'],
            $data['preis'],
        );

        return $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        $sql = "DESCRIBE artikel";
        $stmt = db::get_db()->query($sql);
        $sql = "UPDATE lager SET ";

        $arr = array();
        while ($attr = $stmt->fetch_assoc()) {
            if (key_exists($attr['Field'], $data)) {
                $sql .= " $attr[Field] = ?,";
                array_push($arr, $data[$attr['Field']]);
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE lager_id = ? LIMIT 1";

        array_push($arr, $id);
        $amnt = str_repeat('s', count($arr));

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param($amnt, ...$arr);

        return $stmt->execute();
    }

    public function inventur() {}

    public function abgabe() {}
}