<?php

class class_lieferant {
    public $id;
    public $name;
    public $adresse;
//    public $properties;


    static $db;


    public function __construct($data = false)
    {
        if (!$data) return;
        $this->id = (int) $data['liefer_id'];
        $this->name = $data['name'];
        $this->adresse = $data['adresse'];
//        $this->adresse = array_combine(array_walk(explode(';', $data['adresse']), ''));
    }

    public static function getAll(): array
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM lieferant INNER JOIN artikel";

        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
//        response::send($res->fetch_assoc());
        while ($row = $res->fetch_assoc()) {
            $ret[] = $row;
        }
//        response::send($ret);
        return $ret;
    }

    public static function getSingle(int $id): array
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM lieferant WHERE liefer_id = ? LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $res = $stmt->get_result();
//        response::send($res);

        return $res->fetch_assoc() ?? array();
    }

    public static function putNew($data): bool
    {
        self::$db = db::get_db();
        $sql = "INSERT INTO lieferant (`name`, `adresse`) VALUES(?, ?)";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('ss',
            $data['name'],
            $data['adresse'],
        );

        return (bool) $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        self::$db = db::get_db();

        $sql = "UPDATE lieferant SET ";
        foreach ($data as $attr => $value) {
            $sql .= " $attr = ?";
        }
        $sql .= " WHERE art_id < ?";

        $amnt = str_repeat('s', count($data));

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param($amnt, $data);

        return (bool) $stmt->execute();
    }
}