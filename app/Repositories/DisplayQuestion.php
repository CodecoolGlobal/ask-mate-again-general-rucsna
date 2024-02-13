<?php

namespace App\Repositories;

use app\Database;

class DisplayQuestion
{

   public function displayQuestionById($id)
   {
       $db = Database::getInstance()->getConnection();
       $query = $db->prepare('SELECT * FROM question WHERE id = $id');
       $query->execute();

       return $query->fetch();
   }
}