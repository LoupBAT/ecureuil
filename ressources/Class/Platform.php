<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class Platform
{
    public int $id;
    public string $name;
    public string $description;
    public string $link;
    public string $img;

    public function __construct($id, $name, $description, $link, $img)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->img = $img;
    }

    // GETTERS & SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public static function getAllPlatforms($bdd)
    {
        $queryPlatforms = $bdd->prepare("SELECT * FROM platforms");
        $queryPlatforms->execute();

        $platforms = [];

        while ($row = $queryPlatforms->fetch(PDO::FETCH_ASSOC)) {
            $platforms[] = new Platform($row['id'], $row['name'], $row['description'], $row['link'], $row['img']);
        }

        return $platforms;
    }

    public static function createPlatform($name, $description, $link, $img)
    {
        global $bdd;
        $queryPlatforms = $bdd->prepare("INSERT INTO platforms (name, description, link, img) VALUES (:name, :description, :link, :img) ");
        $queryPlatforms->execute(array('name' => $name, 'description' => $description, 'link' => $link, 'img' => $img));
    }

    public static function deletePlatform($id)
    {
        global $bdd;
        $queryPlatforms = $bdd->prepare("DELETE FROM platforms WHERE id = :id");
        $queryPlatforms->execute(array('id' => $id));
    }

    public static function editPlatform($id, $name, $description, $link, $img)
    {
        global $bdd;
        $queryPlatforms = $bdd->prepare("UPDATE platforms SET name=:name, description=:description, link=:link, img=:img WHERE id=:id ");
        $queryPlatforms->execute(array('name' => $name, 'description' => $description, 'link' => $link, 'img' => $img, 'id' => $id));
    }
}
