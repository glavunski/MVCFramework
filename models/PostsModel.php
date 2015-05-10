<?php

class PostsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
        "SELECT p.id,p.title,p.content,p.date_stamp,u.id as user_id,u.username,
		GROUP_CONCAT(t.name) as tags
        FROM posts as p
		LEFT JOIN posts_tags as pt on pt.post_id = p.id
        LEFT JOIN tags as t on t.id = pt.tag_id
        LEFT JOIN users as u on u.id = p.user_id
        GROUP BY pt.post_id
        ORDER BY p.id DESC;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getFilteredPosts($from,$to){
        $statement =
            self::$db->prepare(
                "SELECT p.id,p.title,p.content,p.date_stamp,u.id as user_id,u.username,
		GROUP_CONCAT(t.name) as tags
        FROM posts as p
        JOIN users as u on p.user_id = u.id
        JOIN posts_tags as pt on pt.post_id = p.id
        JOIN tags as t on pt.tag_id = t.id
        GROUP BY pt.post_id
        ORDER BY p.id DESC LIMIT ?, ?;");
        $statement->bind_param("ii",$from,$to);
        $result = $statement->fetch_all();
        return $result;
    }

    public function find($id) {
        $statement = self::$db->prepare(
        "SELECT p.id,p.title,p.content,p.date_stamp,u.id as user_id,u.username
        FROM posts as p
        JOIN users as u on p.user_id = u.id
        WHERE p.id = ?;");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($title,$content,$tags,$userId) {
        if ($title == '' || $content == '' || $tags == '') {
            return false;
        }

        $statement = self::
        $db->prepare("INSERT INTO posts(title, content, user_id) VALUES(? , ?,  ?)");
        $statement->bind_param("ssi", $title,$content,$userId);
        $statement->execute();
        if($statement->affected_rows <= 0) {
            return false;
        }

        $sepTags = explode(',',trim($tags));
        $postId = $statement->insert_id;

        foreach($sepTags as $sepTag)
        {
            $tagId = 0;
            $statement = self::
            $db->prepare("SELECT id FROM tags WHERE name = ?");
            $statement->bind_param("s",$sepTag);
            $statement->execute();
            $result = $statement->get_result()->fetch_assoc();
            if($result == null)
            {
                $newStatement =   $statement = self::
                $db->prepare("INSERT INTO tags (name) VALUES (?)");
                $newStatement->bind_param("s",$sepTag);
                $newStatement->execute();
                $tagId = $newStatement->insert_id;
            }
            else{
                $tagId = $result['id'];
            }

            $postTagStatement = self::$db->prepare("INSERT INTO posts_tags (post_id,tag_id) VALUES (?,?)");
            $postTagStatement->bind_param("ii", $postId,$tagId);
            $postTagStatement->execute();
            if($postTagStatement->affected_rows <= 0) {
                return false;
            }
        }
        return true;
    }

    public function getComments($id){
        $statement = self::$db->prepare(
            "SELECT * FROM comments
        WHERE comments.post_id = ?;");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function getByTag($id){
        $statement = self::$db->prepare(
            "SELECT p.id,p.title,p.content,p.date_stamp,u.id as user_id,u.username
        FROM posts as p
        JOIN posts_tags as pt on pt.post_id = p.id
        JOIN tags as t on t.post_id = p.id
        WHERE p.id = ?;");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all();
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
        $postTagsStatement = self::$db->prepare(
            "DELETE FROM posts_tags WHERE post_id = ?");
        $postTagsStatement->bind_param("i", $id);
        $postTagsStatement->execute();

        $statement = self::$db->prepare(
            "DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
