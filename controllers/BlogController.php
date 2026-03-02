<?php

require_once "models/Blog.php";

class BlogController {
    public function index() {
        $posts = Blog::all();
        require "views/blog/index.view.php";
    }

    public function show($id) {
        $post = Blog::find($id);

        if (!$post) {
            http_response_code(404);
            echo "Ieraksti nav atrasti!";
            return;
        }

        require "views/blog/show.view.php";
    }

    public function create() {
        require "views/blog/create.view.php";
    }

    public function store() {
        $content = trim($_POST['content'] ?? '');
        $errors = [];

        if ($content === '') {
            $errors['content'] = 'Ieraksts nedrīkst būt tukšs';
            require "views/blog/create.view.php";
            return;
        }

        Blog::create(['content' => $content]);
        $this->redirect('/');
    }

    public function edit($id) {
        $post = Blog::find($id);

        if (!$post) {
            http_response_code(404);
            echo "Ieraksts nav atrasts!";
            return;
        }

        require "views/blog/edit.view.php";
    }

    public function update($id) {
        $post = Blog::find($id);

        if (!$post) {
            http_response_code(404);
            echo "Ieraksts nav atrasts!";
            return;
        }

        $content = trim($_POST['content'] ?? '');
        $errors = [];

        if ($content === '') {
            $errors['content'] = 'Ieraksts nedrīkst būt tukšs';
            require "views/blog/edit.view.php";
            return;
        }

        $post->content = $content;
        $post->save();

        $this->redirect('/show?id=' . $id);
    }

    public function destroy($id) {
        $post = Blog::find($id);

        if ($post) {
            $post->delete();
        }

        $this->redirect('/');
    }

    private function redirect($path) {
        header('Location: ' . $path);
        exit();
    }
}