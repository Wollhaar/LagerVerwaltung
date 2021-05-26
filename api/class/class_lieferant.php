<?php

class class_lieferant {
    public $id;
    public $name;
    public $strasse;
    public $hausnummer;
    public $PLZ;
    public $ort;

    public function __construct($data = false)
    {
        if (!$data) return;
        $this->id = (int) $data['liefer_id'];
        $this->name = $data['name'];
        $this->strasse = $data['strasse'];
        $this->hausnummer = $data['hausnummer'];
        $this->PLZ = $data['PLZ'];
        $this->ort = $data['ort'];
    }

    public static function getAll(): array
    {
        $sql = "SELECT * FROM lieferant";

        $stmt = db::get_db()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = new self($row);
        }
        return $ret;
    }

    public static function getSingle(int $id): array
    {
        $sql = "SELECT * FROM lieferant WHERE liefer_id = ? LIMIT 1";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc() ?? array();
    }

    public static function new($data): bool
    {
        $sql = "INSERT INTO lieferant (`name`, `adresse`) VALUES(?, ?)";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('ss',
            $data['name'],
            $data['adresse'],
        );

        return $stmt->execute();
    }

    public static function edit($id, $data): bool
    {
        $sql = "DESCRIBE lieferant";
        $stmt = db::get_db()->query($sql);
        $sql = "UPDATE lieferant SET ";

        $arr = array();
        while ($attr = $stmt->fetch_assoc()) {
            if (key_exists($attr['Field'], $data)) {
                $sql .= " $attr[Field] = ?,";
                array_push($arr, $data[$attr['Field']]);
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE liefer_id = ? LIMIT 1";
        array_push($arr, $id);
        $amnt = str_repeat('s', count($arr));

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param($amnt, ...$arr);

        return $stmt->execute();
    }

    public static function search(string $name): array
    {
        $sql = "SELECT * FROM lieferant WHERE `name` = ? LIMIT 1";

        $stmt = db::get_db()->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc() ?? array();
    }

    private function splitAdress()
    {
        $arr = explode(';', $this->adresse);
        foreach ($arr as $str) {
            $newVar = substr($str, 0, strpos($str, ':'));
            $this->$newVar = substr($str, strpos($str, ':') + 1);
        }
        unset($this->adresse);
    }
}