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
//        $sql = "UPDATE artikel SET preis = 4.79 WHERE art_id < 4";
//        $sql = "INSERT INTO artikel (name, beschreibung, preis) VALUES('Pampers Sz:7', 'Windeln für Babys. Size: 7', 6.59)";
//        $sql = "DESCRIBE artikel";

//        $res = self::$db->query($sql);
//        response::send($res);
        $stmt = self::$db->prepare($sql);
        if ($stmt->execute()) response::send('success');
        $res = $stmt->get_result();

        $ret = array();
        response::send($res->fetch_assoc());
//        while ($row = $res->fetch_assoc()) {
//            $ret[] = new class_artikel($row);
//            $ret[] = $row;
//            echo json_encode($row);
//        }
        response::send($ret);
        return $ret;
    }

    public function registrieren() {}

    public static function putNew($data): bool
    {
        self::$db = db::get_db();
        $sql = "INSERT INTO artikel (`name`, `beschreibung`, `preis`) VALUES(?, ?, ?)";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('sss',
            $data['name'],
            $data['beschreibung'],
            $data['price'],
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
        $sql .= " WHERE art_id < ?";

        $amnt = str_repeat('s', count($data));

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param($amnt, $data);

        return (bool) $stmt->execute();
    }

    public function ausfuehren() {}

    public function loeschen() {}
}