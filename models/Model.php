<?php

require "Database.php";

abstract class Model {
    protected static $db;

    public static function init() {
        if (!self::$db) {
            self::$db = new Database();
        }
    }

    abstract protected static function getTableName(): string;

    public static function all() {
        self::init();
        $sql = "SELECT * FROM " . static::getTableName();

        $records = self::$db->query($sql)->fetchAll();
        return  $records;
    }

    public static function find($id): ?self {
        self::init();

        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id = :id LIMIT 1";
        $record = self::$db->query($sql, ['id' => $id])->fetch();

        return $record ? new self($record) : null;
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
}