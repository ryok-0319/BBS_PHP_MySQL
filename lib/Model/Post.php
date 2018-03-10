<?php

namespace MyApp\Model;

class Post extends \MyApp\Model {

  public function create($values) {
    $stmt = $this->db->prepare("insert into threads (user_id, title, overview, created_at) values (:user_id, :title, :overview, now())");
    $stmt->execute([
      ':user_id' => $values['user_id'],
      ':title' => $values['title'],
      ':overview' => $values['overview']
    ]);
  }

  public function edit($title, $overview, $id) {
    $stmt = $this->db->prepare("update threads set title = :title, overview = :overview where id = :id");
    $stmt->execute([
      ':title' => $title,
      ':overview' => $overview,
      ':id' => $id
    ]);
  }

  public function delete($id) {
    $stmt = $this->db->prepare("delete from threads where id = :id");
    $stmt->execute([
      ':id' => $id
    ]);
  }

  public function findAll() {
    $stmt = $this->db->query("select * from threads order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function findThread($id) {
    $stmt = $this->db->prepare("select * from threads where id = :id");
    $stmt->execute([':id' => $id]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetch();
  }
}
