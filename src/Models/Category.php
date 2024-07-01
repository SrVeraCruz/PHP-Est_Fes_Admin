<?php

require_once '../config/db.php';

class Category
{
  private static $table = "categories";
  private static $pdo = null;

  private static function initConnection()
  {
    if (self::$pdo === null) {
      self::$pdo = Database::getConnection();
    }
  }

  public static function getAll()
  {
    self::initConnection();
    $sql = "SELECT ct.*, pct.name AS parent_name 
      FROM " . self::$table . " ct 
      LEFT JOIN " . self::$table . " pct 
      ON ct.parent_category_id = pct.id WHERE ct.status != '2'"
    ;

    $stmt = self::$pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function getOne($id)
  {
    self::initConnection();
    $sql = 'SELECT ct.*, pct.name AS parent_name 
      FROM ' . self::$table . ' ct 
      LEFT JOIN ' . self::$table . ' pct 
      ON ct.parent_category_id = pct.id 
      WHERE ct.id = :id LIMIT 1'
    ;

    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function insertOne($data)
  {
    // Add category
    self::initConnection();

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category name']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category title']);
    } else {

      $add_query = "INSERT INTO " . self::$table . " 
        (parent_category_id, name, title, slug, logo, navbar_status) VALUES 
        (:parent_category_id, :name, :title, :slug, :logo, :navbar_status) LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($add_query);
      $stmt->bindValue(':parent_category_id', $data['parent_category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo', $data['logo']);
      $stmt->bindValue(':navbar_status', $data['navbar_status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Category added successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function updateOne($data)
  {
    // Edit category
    self::initConnection();

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category name']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category title']);
    } else {

      $update_query = "UPDATE " . self::$table . " 
        SET parent_category_id = :parent_category_id, name = :name, title = :title, slug = :slug, logo = :logo, navbar_status = :navbar_status WHERE id = :id LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($update_query);
      $stmt->bindValue(':parent_category_id', $data['parent_category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo', $data['logo']);
      $stmt->bindValue(':navbar_status', $data['navbar_status']);
      $stmt->bindValue(':id', $data['update_id']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Category updated successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    // Delete category
    self::initConnection();
    $delete_query = "UPDATE " . self::$table . " 
      SET status = '2' WHERE id = :id LIMIT 1"
    ;

    $stmt = self::$pdo->prepare($delete_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'Category deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
