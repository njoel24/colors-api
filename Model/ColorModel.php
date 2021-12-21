<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class ColorModel extends Database
{
    public function getColors($limit)
    {
        return $this->select("SELECT * FROM colors ORDER BY hex_value ASC LIMIT ?", "i", [$limit]);
    }

    public function createColor($value)
    {
        return $this->update("INSERT INTO colors (hex_value) VALUES(?)", "s", [$value]);
    }

    public function deleteColor($value)
    {
        return $this->update("DELETE FROM colors WHERE hex_value=?", "s", [$value]);
    }
}