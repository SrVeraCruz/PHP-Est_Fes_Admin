<?php
require_once '../Services/UserService.php';
require_once '../Services/NewsService.php';
require_once '../Services/EventService.php';
require_once '../Services/NewsletterService.php';
require_once '../Services/CategoryService.php';
require_once '../Services/ItemService.php';
require_once '../Services/SlideService.php';

header("Content-Type: application/json");
$uri = $_GET['url'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
  case 'api/users':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(UserService::GET($_GET['id']));
      } else {
        json_encode(UserService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(UserService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(UserService::DELETE($_POST));
      } else {
        json_encode(UserService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/news':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(NewsService::GET($_GET['id']));
      } else {
        json_encode(NewsService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(NewsService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(NewsService::DELETE($_POST));
      } else {
        json_encode(NewsService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;
  
  case 'api/events':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(EventService::GET($_GET['id']));
      } else {
        json_encode(EventService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(EventService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(EventService::DELETE($_POST));
      } else {
        json_encode(EventService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/newsletter':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(NewsletterService::GET($_GET['id']));
      } else {
        json_encode(NewsletterService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(NewsletterService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(NewsletterService::DELETE($_POST));
      } else {
        json_encode(NewsletterService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;
    
  case 'api/categories':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(CategoryService::GET($_GET['id']));
      } else {
        json_encode(CategoryService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(CategoryService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(CategoryService::DELETE($_POST));
      } else {
        json_encode(CategoryService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/items':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(ItemService::GET($_GET['id']));
      } else {
        json_encode(ItemService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(ItemService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(ItemService::DELETE($_POST));
      } else {
        json_encode(ItemService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/slides':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(SlideService::GET($_GET['id']));
      } else {
        json_encode(SlideService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(SlideService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(SlideService::DELETE($_POST));
      } else {
        json_encode(SlideService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/register':
    // require_once '../../middleware/redirect-user.php';

    if ($method === 'POST') {
      json_encode(UserService::POST($_POST));
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/login':
    // require_once '../../middleware/redirect-user.php';

    if ($method === 'POST') {
      if (isset($_POST['email']) && isset($_POST['password'])) {
        json_encode(UserService::LOGIN($_POST['email'], $_POST['password']));
      } else {
        sendNotFound();
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/logout':
    if ($method === 'POST') {
      json_encode(UserService::LOGOUT());
    } else {
      sendNotAllowed();
    }
    break;

  default:
    sendNotFound();
    break;
}


function sendNotFound()
{
  http_response_code(404);
  echo json_encode(['message' => 'Not Found']);
}

function sendNotAllowed()
{
  http_response_code(405);
  echo json_encode(['message' => 'Method Not Allowed']);
}
