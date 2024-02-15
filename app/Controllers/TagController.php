<?php

namespace App\Controllers;

use App\Repositories\TagsRepository;
use Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class TagController extends BaseController
{
    public function handleTags(): void
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

    public function addTag(): void
    {
        try {
            $newTag = ['name' => $_POST['name']];
            $tagRepo = new TagsRepository();
            $tagRepo->saveTag($newTag);
            header('location: /dashboard');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function useTagForm(): void
    {
        try {
            echo $this->blade->run('new_tag_form');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}