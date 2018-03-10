<?php

namespace MyApp\Model;

class Comment extends \MyApp\Model {

  public function create($user_id, $content, $thread_id) {
    $stmt = $this->db->prepare("insert into comments (user_id, content, thread_id, created_at) values (:user_id, :content, :thread_id, now())");
    $stmt->execute([
      ':user_id' => $user_id,
      ':content' => $content,
      ':thread_id' => $thread_id
    ]);
  }

  public function edit($content, $id) {
    $stmt = $this->db->prepare("update comments set content = :content where id = :id");
    $stmt->execute([
      ':content' => $content,
      ':id' => $id
    ]);
  }

  public function delete($id) {
    $stmt = $this->db->prepare("delete from comments where id = :id");
    $stmt->execute([
      ':id' => $id
    ]);
  }

  public function findAll($id) {
    $stmt = $this->db->prepare("select * from comments where thread_id = :thread_id");
    $stmt->execute([':thread_id' => $id]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function findComment($id) {
    $stmt = $this->db->prepare("select * from comments where id = :id");
    $stmt->execute([':id' => $id]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetch();
  }
}
