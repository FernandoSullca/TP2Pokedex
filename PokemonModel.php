<?php
class PokemonModel
{
    private $id;
    private $OrderNumber;
    private $imagePath;
    private $name;
    private $description;
    private $weight;
    private $height;
    private $parent;
    private $type;

    public function __construct($id, $OrderNumber,$name,$imagePath, $description, $weight, $height, $parent, $type)
    {
        $this->id=$id;
        $this->OrderNumber=$OrderNumber;
        $this->name=$name;
        $this->imagePath=$imagePath;
        $this->description=$description;
        $this->weight=$weight;
        $this->height=$height;
        $this->parent=$parent;
        $this->type=$type;
    }

    public function add($database){
        try{
            $sql = "INSERT INTO pokemon (id, order_number,image_path,name,description,weight,height,parent_id) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?,?)";
            $stmt = $database->prepare($sql);
            $stmt->bind_param("iisssiii",
                    $this->id,
                    $this->OrderNumber,
                    $this->imagePath,
                    $this->name,
                    $this->description,
                    $this->weight,
                    $this->height,
                    $this->parent
                );
            $stmt->execute();
            $this->addRelationType($database);
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    private function addRelationType($database){
        try {
            foreach($this->type as $typeID){
                $pokemon = $this->get($database);
                $sql = "INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (?, ?)";
                $stmt = $database->prepare($sql);
                $stmt->bind_param("ii", $pokemon->id,$typeID);
                $stmt->execute();
            }
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
    private function deleteRelationType($database){
        try{
            $sql = 'DELETE FROM pokemon__pokemon_type WHERE pokemon_id = ?';
            $stmt = $database->prepare($sql);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function get($database){
        try{
            $sql = "SELECT * FROM pokemon WHERE order_number = ? AND name = ? limit 1";
            $stmt = $database->prepare($sql);
            $stmt->bind_param("is",$this->OrderNumber, $this->name);
            $stmt->execute();
            $resultSet = $stmt->get_result();
            return $resultSet->fetch_object();
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function modify($database){
        try{
            $sql = 'UPDATE pokemon SET 
                           order_number = ?,
                           image_path = ?,
                           name = ?,
                           description = ?,
                           weight = ?,
                           height = ?,
                           parent_id = ?
                     WHERE id = ?';
            $stmt = $database->prepare($sql);
            $stmt->bind_param("isssiiii",
                $this->OrderNumber,
                $this->imagePath,
                $this->name,
                $this->description,
                $this->weight,
                $this->height,
                $this->parent,
                $this->id
            );
            $stmt->execute();
            $this->deleteRelationType($database);
            $this->addRelationType($database);
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function delete($database){
        try{
            $sql = 'DELETE FROM pokemon WHERE id = ?';
            $stmt = $database->prepare($sql);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
            $this->deleteRelationType($database);
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
}