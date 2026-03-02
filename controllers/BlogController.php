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
        return "views/blog/create.view.php";
    }

    public function store() {
        Blog::create($_POST);
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

        $post->body = trim($_POST['body'] ?? '');
        $post->save();

        $this->redirect('/posts/' . $id);
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