<?php
require_once '../config/db.php';

class Item
{
  private static $table = 'items';
  private static $category_table = 'categories';

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
    $sql = "SELECT it.*, cit.name AS category_name 
      FROM " . self::$table . " it 
      LEFT JOIN " . self::$category_table . " cit 
      ON it.category_id = cit.id"
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
    $sql = "SELECT it.*, cit.name AS category_name 
      FROM " . self::$table . " it 
      LEFT JOIN " . self::$category_table . " cit 
      ON it.category_id = cit.id WHERE it.id = :id"
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
    self::initConnection();

    $cotent_data = json_decode($data['data_content']);

    // Inputs Verification
    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item name']);
    } elseif (!trim($data['category_id'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item category']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item title']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item meta-title']);
    } elseif (!trim($cotent_data[0]->title)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ subtitle']);
    } elseif (!trim($cotent_data[0]->description)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ description']);
    } else {

      $add_item_query = "INSERT INTO " . self::$table . " 
        (category_id, name, title, slug, logo, data_content, meta_title, file, status) VALUES 
        (:category_id, :name, :title, :slug, :logo, :data_content, :meta_title, :file, :status) LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($add_item_query);

      $stmt->bindValue(':category_id', $data['category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo', $data['logo']);
      $stmt->bindValue(':data_content', $data['data_content']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item added successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function updateOne($data)
  {
    self::initConnection();

    $cotent_data = json_decode($data['data_content']);

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item name']);
    } elseif (!trim($data['category_id'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item category']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item title']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item meta-title']);
    } elseif (!trim($cotent_data[0]->title)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ subtitle']);
    } elseif (!trim($cotent_data[0]->description)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ description']);
    } else {

      $update_query = "UPDATE " . self::$table . " 
        SET category_id = :category_id, name = :name, title = :title, slug = :slug, logo = :logo, data_content = :data_content, meta_title = :meta_title, file = :file, status = :status WHERE id = :id LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($update_query);

      $stmt->bindValue(':category_id', $data['category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo', $data['logo']);
      $stmt->bindValue(':data_content', $data['data_content']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':id', $data['update_id']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item updated successfully']);
      } else {
        throw new Exception('Something went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();

    $delete_query = "DELETE FROM " . self::$table . " 
      WHERE id = :id LIMIT 1"
    ;

    $stmt = self::$pdo->prepare($delete_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'Item deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
