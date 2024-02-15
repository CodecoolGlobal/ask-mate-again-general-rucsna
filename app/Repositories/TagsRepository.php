<?php

namespace App\Repositories;

use App\Database;

class TagsRepository
{
   public function displayAllTags(): bool|array
   {
       $db = Database::getInstance()->getConnection();
       $query = $db->prepare('SELECT * FROM tag');
       $query->execute();

       return $query->fetchAll();
   }

   public function displayTagCategoryQuantity(): bool|array
   {
       $db = Database::getInstance()->getConnection();
       $query = $db->prepare('
            SELECT name, COUNT(id_tag) AS quantity 
            FROM rel_question_tag
            JOIN tag ON rel_question_tag.id_tag = tag.id
            GROUP BY id_tag');
       $query->execute();

       return $query->fetchAll();
   }

   public function displayTags($id): bool|array
   {
       $db = Database::getInstance()->getConnection();
       $query = $db->prepare("
            SELECT name FROM rel_question_tag
            JOIN tag ON rel_question_tag.id_tag = tag.id
            WHERE id_question=?");
       $query->execute([$id]);

       return $query->fetchAll();
   }

   public function saveTag($name): int
   {
       $db = Database::getInstance()->getConnection();
       $query = $db->prepare("INSERT INTO tag(name) VALUES (:name)");
       $query->execute(['name' => $name['name']]);
       return $db->lastInsertId();
   }
}