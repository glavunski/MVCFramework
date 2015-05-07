<?php

class PostsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM posts");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($title,$content) {
        if ($title == '' || $content == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO posts VALUES(NULL, ?)");
        $statement->bind_param("si", $name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $content) {
        if ($content == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE posts SET content = ? WHERE id = ?");
        $statement->bind_param("si", $content, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
