<?php

namespace App\Controllers;

use App\Repositories\TagsRepository;
use eftec\bladeone\BladeOne;
use Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class TagController extends BaseController
{
    private TagsRepository $tagRepo;
    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->tagRepo = new TagsRepository();
    }

    public function handleTags(): void
    {
        try {
            $tags = $this->tagRepo->displayAllTags();
            $quantities = $this->tagRepo->displayTagCategoryQuantity();

            echo $this->blade->run('tag', ['tags' => $tags, 'quantities' => $quantities]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addTag(): void
    {
        try {
            $newTag = ['name' => $_POST['name']];
            $this->tagRepo->saveTag($newTag);
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

    public function selectTag(): void
    {
        try {
            $tags = $this->tagRepo->displayAllTags();
            echo $this->blade->run('question', ['tags' => $tags]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteTag(): void
    {
        try {
            $this->tagRepo->deleteTagFromQuestion($_POST['delete_question_id'], $_POST['tag_id']);
            header('location: /dashboard');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}