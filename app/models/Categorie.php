<?php
namespace APP\Models;

use Core\Model;
use PDO;

class Categorie extends Model {
    protected $category_id;
    protected $name;
    protected $description;

    protected static $table = 'categories';

    function __construct($category_id, $name, $description) {
        if ($category_id != null) {
            $this->category_id = $category_id;
        }
        $this->name = $name;
        $this->description = $description;
    }


    // getters
    function getcategory_id(){
        return $this->category_id;
    }
    
    function getName(){
        return $this->name;
    }

    function getDescription(){
        return $this->description;
    }


    // setters 
    function setName($name){
        $this->name = $name;
    }

    function setDescription($description){
        $this->description = $description;
    }
    

    // insert and update 
    public function save(){
        return $this->category_id ? $this->update() : $this->insert();
    }

    private function insert(){
        $sql = "INSERT INTO" . self::$table . "(name, description, created_at) VALUES (:name, :description, NOW())";
        $stmt = self::db()->prepare($sql);
        $result = $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description
        ]);

        if ($result){
            $this->category_id = (int)self::db()->lastInsertId();
            return true;
        }

        return false;
    }

    private function update(){
        $sql = "UPDATE " . self::$table . "SET name = :name, description = :description WHERE category_id = :category_id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':category_id' => $this->category_id,
            ':name' => $this->name,
            ':description' => $this->description
        ]);
    }

    static public function deleteCategorie($category_id){
        $sql = "DELETE FROM " . self::$table . "WHERE category_id = :category_id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':category_id' => $category_id]);
    }

    // get all Categories
    static public function getAllCategories(){
        $sql = "SELECT * FROM " . self::$table;
        $stmt = self::db()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // get one Category
    static public function getCategory($category_id){
        $sql = "SELECT * FROM " . self::$table . "WHERE category_id = :category_id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':category_id' => $category_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}