<?php

namespace App\Controllers;

use App\Repositories\TagsRepository;
use Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class TagController extends BaseController
{
    public function displayTag(): void
    {
        try {
            $tagRepo = new TagsRepository();
            $tags = $tagRepo->displayAllTags();
            $quantities = $tagRepo->displayTagCategoryQuantity();

            echo $this->blade->run('tag', ['tags' => $tags, 'quantities' => $quantities]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}