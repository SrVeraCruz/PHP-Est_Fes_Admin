<?php
require_once '../config/db.php';

class User
{
  private static $table = "users";
  private static $newsletter_table = "newsletter";
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
    $sql = 'SELECT * FROM ' . self::$table;
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
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
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

    $todaysDate = new DateTime();
    $BirthDate = new DateTime($data['birth']);
    $interval = $todaysDate->diff($BirthDate);

    // Inputs Verification
    if (!trim($data['fname'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user first name']);
    } elseif (!trim($data['lname'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user last name']);
    } elseif (!trim($data['email'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user email']);
    } elseif ((strlen($data['password'])) < 8 || (strlen($data['cpassword'])) < 8) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Password Should be 8+ characters']);
    } elseif ($interval->y < 18) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The user must be over 18+']);
    } elseif (!trim($data['sex'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please choose the user gender']);
    } else {

      // Check passwords
      if ($data['password'] == $data['cpassword']) {
        // Email verification
        $email_query = 'SELECT * FROM ' . self::$table . ' WHERE email = :email';
        $stmt = self::$pdo->prepare($email_query);
        $stmt->bindValue(':email', $data['email']);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
          $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
          
        } else {
          http_response_code(400);
          return json_encode(['message_warning' => 'Email alread exist']);
        }
      } else {
        http_response_code(400);
        return json_encode(['message_error' => 'Password and Confirm Password does no Match']);
      }

      // Insert user
      $add_user_query = "INSERT INTO " . self::$table . " 
        (fname, lname, birth, sex, email, password, status, role_as, avatar) VALUES 
        (:fname, :lname, :birth, :sex, :email, :hash_password, :status, :role_as, :avatar)"
      ;

      $status = '0';
      if (isset($data['status'])) {
        $status = $data['status'];
      }

      $role_as = '0';
      if (isset($data['role_as'])) {
        $role_as = $data['role_as'];
      }

      $stmt = self::$pdo->prepare($add_user_query);
      $stmt->bindValue(':fname', $data['fname']);
      $stmt->bindValue(':lname', $data['lname']);
      $stmt->bindValue(':birth', $data['birth']);
      $stmt->bindValue(':sex', $data['sex']);
      $stmt->bindValue(':email', $data['email']);
      $stmt->bindValue(':hash_password', $hash_password);
      $stmt->bindValue(':status', $status);
      $stmt->bindValue(':role_as', $role_as);
      $stmt->bindValue(':avatar', $data['avatar']);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        if ($role_as === '0') {
          http_response_code(200);
          return json_encode(['message_success' => "User added successfully"]);
        } else {
          http_response_code(200);
          return json_encode(['message_success' => "Admin added successfully"]);
        }
      } else {
        throw new Exception("Sommething went wrong");
      }
    }
  }

  public static function updateOne($data)
  {
    self::initConnection();

    $todaysDate = new DateTime();
    $BirthDate = new DateTime($data['birth']);
    $interval = $todaysDate->diff($BirthDate);

    // Inputs Verification
    if (!trim($data['fname'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user first name']);
    } elseif (!trim($data['lname'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user last name']);
    } elseif (!trim($data['email'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the user email']);
    } elseif ((strlen($data['password'])) < 8) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Password Should be 8+ characters']);
    } elseif ($interval->y < 18) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The user must be over 18+']);
    } elseif (!trim($data['sex'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please choose the user gender']);
    } elseif ($data['role_as'] == '') {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please choose the user role']);
    } else {
      // Check the password status
      $user_query = "SELECT password,avatar 
        FROM " . self::$table . " WHERE id = :id LIMIT 1"
      ;
      $stmt = self::$pdo->prepare($user_query);
      $stmt->bindValue(':id', $data['update_id']);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data['password'] === $user_data['password']) {
          $hash_password = $data['password'];
        } else {
          // New Password
          $hash_password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
      } else {
        http_response_code(400);
        return json_encode(['message_error' => 'Invalid User']);
      }

      // Email verification
      $email_query = "SELECT id FROM " . self::$table . " WHERE email = :email LIMIT 1";
      $stmt = self::$pdo->prepare($email_query);
      $stmt->bindValue(':email', $data['email']);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $email_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($email_data['id'] !== $data['update_id']) {
          http_response_code(400);
          return json_encode(['message_warning' => 'Email alread exist']);
        }
      }

      // Updating user
      $update_query = "UPDATE " . self::$table . " 
        SET fname = :fname, lname = :lname, birth = :birth, sex = :sex, email = :email, password = :hash_password, role_as = :role_as, status = :status, avatar = :avatar WHERE id = :id"
      ;

      $stmt = self::$pdo->prepare($update_query);
      $stmt->bindValue(':fname', $data['fname']);
      $stmt->bindValue(':lname', $data['lname']);
      $stmt->bindValue(':birth', $data['birth']);
      $stmt->bindValue(':sex', $data['sex']);
      $stmt->bindValue(':email', $data['email']);
      $stmt->bindValue(':hash_password', $hash_password);
      $stmt->bindValue(':role_as', $data['role_as']);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':avatar', $data['avatar']);
      $stmt->bindValue(':id', $data['update_id']);
      $success = $stmt->execute();

      if ($success) {
        if ($data['role_as'] === '0') {
          http_response_code(200);
          return json_encode(['message_success' => "User Updated successfully"]);
        } else {
          http_response_code(200);
          return json_encode(['message_success' => "Admin Updated successfully"]);
        }
      } else {
        throw new Exception("Sommething went wrong");
      }
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();

    $email_query = 'SELECT email FROM ' . self::$table . ' WHERE id = :id LIMIT 1';
    $stmt = self::$pdo->prepare($email_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $stmt->execute();
    
    $email = '';
    if ($stmt->rowCount() > 0) {
      $email = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $delete_query = "DELETE FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$pdo->prepare($delete_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $success = $stmt->execute();

    if ($success) {
      $delete_subscription_query = "DELETE FROM " . self::$newsletter_table . " WHERE email = :email LIMIT 1";
      $stmt = self::$pdo->prepare($delete_subscription_query);
      $stmt->bindValue(':email', $email['email']);
      $success = $stmt->execute();

      http_response_code(200);
      return json_encode(['message_success' => 'User deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }

  public static function authenticate($email, $password)
  {
    session_start();
    self::initConnection();

    if (!$email) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Email is required']);
    } elseif (!$password) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Password is required']);
    } elseif (strlen($password) < 8) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Password should be 8+ characters']);
    } else {

      $user_query = "SELECT * FROM " . self::$table . " 
      WHERE email = :email Limit 1";

      $stmt = self::$pdo->prepare($user_query);
      $stmt->bindValue(':email', $email);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $hash_password = $user_data['password'];

        if (password_verify($password, $hash_password)) {
          // Role Verification
          if ($user_data['role_as'] === 1 || $user_data['role_as'] === 2) {
            // Redirect to Dashboard
            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = $user_data['role_as']; // 0=user, 1=admin, 2=super_admin
            $_SESSION['auth_user'] = [
              'user_id' => $user_data['id'],
              'user_name' => $user_data['fname'] . ' ' . $user_data['lname'],
              'user_email' => $user_data['email'],
              'user_img' => $user_data['avatar'],
            ];

            http_response_code(200);
            return json_encode(['message_success' => 'Welcomme to Dashboard']);
          } else {
            // No Permition to access Dashboard
            http_response_code(400);
            return json_encode(['message_error' => 'Permission denied. Please contact the support']);
          }
        } else {
          // Credentials does not match
          http_response_code(400);
          return json_encode(['message_error' => 'Invalid Email or Password']);
        }
      } else {
        // Credentials does not match
        http_response_code(400);
        return json_encode(['message_error' => 'Invalid Email or Password']);
      }
    }
  }

  public static function logout()
  {
    session_start();
    session_unset();
    session_destroy();

    return json_encode(['message_success' => 'Logged Out Succesfully']);
  }
}
