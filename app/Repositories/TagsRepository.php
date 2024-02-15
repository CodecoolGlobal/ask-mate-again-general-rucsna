<?php

namespace App\Repositories;

use App\Database;
use PDO;

class TagsRepository
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
   public function displayAllTags(): bool|array
   {
       $query = $this->db->prepare('SELECT * FROM tag');
       $query->execute();

       return $query->fetchAll();
   }

   public function displayTagCategoryQuantity(): bool|array
   {
       $query = $this->db->prepare('
            SELECT name, COUNT(id_tag) AS quantity 
            FROM rel_question_tag
            JOIN tag ON rel_question_tag.id_tag = tag.id
            GROUP BY id_tag');
       $query->execute();

       return $query->fetchAll();
   }

   public function displayTags($question_id): bool|array
   {
       $query = $this->db->prepare("
            SELECT name FROM rel_question_tag
            JOIN tag ON rel_question_tag.id_tag = tag.id
            WHERE id_question=?");
       $query->execute([$question_id]);

       return $query->fetchAll();
   }

   public function saveTag($name): int
   {
       $query = $this->db->prepare("INSERT INTO tag(name) VALUES (:name)");
       $query->execute(['name' => $name['name']]);
       return $this->db->lastInsertId();
   }

   public function addTagToQuestion($question_id, $tag_id): void
   {
       $query = $this->db->prepare("INSERT INTO rel_question_tag(id_question, id_tag) VALUES (?, ?)");
       $query->execute([$question_id, $tag_id]);
   }

   public function deleteTagFromQuestion($tag_id): void
   {
        $query = $this->db->prepare("");
   }
}