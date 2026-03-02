<?php

require "Database.php";

abstract class Model {
    protected static $db;
    protected $attributes = [];

    public function __construct(array $attributes = []) {
        $this->attributes = $attributes;
    }

    public static function init() {
        if (!self::$db) {
            self::$db = new Database();
        }
    }

    abstract protected static function getTableName(): string;

    protected static function getContentColumn(): string {
        return 'content';
    }

    public static function all() {
        self::init();
        $sql = "SELECT * FROM " . static::getTableName();

        $records = self::$db->query($sql)->fetchAll();
        
        return array_map(function($rec) {
            return new static($rec);
        }, $records);
    }

    public static function find($id): ?self {
        self::init();

        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id = :id LIMIT 1";
        $record = self::$db->query($sql, ['id' => $id])->fetch();

        // instantiate the concrete subclass rather than the abstract Model
        return $record ? new static($record) : null;
    }

    public static function create(array $data): bool {
        self::init();

        $content = trim($data['body'] ?? $data['content'] ?? $data['text'] ?? '');
        $column = static::getContentColumn();

        $sql = "INSERT INTO " . static::getTableName() . " (" . $column . ") VALUES (:content)";
        return self::$db->query($sql, ['content' => $content]) !== false;
    }

    public function save(): bool {
        self::init();

        if (empty($this->attributes['id'])) {
            return false;
        }

        $content = trim($this->attributes['body'] ?? $this->attributes['content'] ?? $this->attributes['text'] ?? '');
        $column = static::getContentColumn();

        $sql = "UPDATE " . static::getTableName() . " SET " . $column . " = :content WHERE id = :id";

        return self::$db->query($sql, [
            'content' => $content,
            'id' => $this->attributes['id'],
        ]) !== false;
    }

    public function delete(): bool {
        self::init();

        if (empty($this->attributes['id'])) {
            return false;
        }

        $sql = "DELETE FROM " . static::getTableName() . " WHERE id = :id";
        return self::$db->query($sql, ['id' => $this->attributes['id']]) !== false;
    }

    // magic property access so $model->body or $model->content works
    public function __get($name) {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    public function __isset($name) {
        return isset($this->attributes[$name]);
    }
}