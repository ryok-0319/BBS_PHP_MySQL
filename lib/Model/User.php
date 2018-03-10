<?php

namespace MyApp\Model;

class User extends \MyApp\Model {

  public function create($values) {
    $stmt = $this->db->prepare("insert into users (email, password, created_at, modified_at) values (:email, :password, now(), now())");
    $res = $stmt->execute([
      ':email' => $values['email'],
      ':password' => $values['password']
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email and password = :password");
    $stmt->execute([
      ':email' => $values['email'],
      ':password' => $values['password']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    
    return $user;
  }

  public function findAll() {
    $stmt = $this->db->query("select * from threads order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
