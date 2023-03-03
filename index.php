<?php
require('model/database.php');
require('model/todo_db.php');
require('model/category_db.php');


// POST Data
$title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
$categoryName = filter_input(INPUT_POST, "categoryName", FILTER_UNSAFE_RAW);
$categoryID = filter_input(INPUT_POST, "categoryID", FILTER_UNSAFE_RAW);

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if($action){
        $action = 'list_categories';
    }
}

// GET Data
$todoitems = filter_input(INPUT_POST, "todoitems", FILTER_VALIDATE_INT);
if(!$todoitems){
    $todoitems = filter_input(INPUT_GET, "todoitems", FILTER_VALIDATE_INT);
}


switch($action){
    case 'list_categories':
        $categories = get_categories();
        include('view/show_category.php');
        break;
    case 'add_category':
        add_category($categoryName);
        header("Location: .?action=list_categories");
        break;
    case 'add_task':
        if($title && $description && $categoryID){
            add_task($title, $description, $categoryID);
            header("Location: .?action=$list_todoitems");
        }else{
            $error_message = "Invalid Task data .Check all felids and try again";
            include("view/error.php");
            exit();
        }
        break;
    case "delete_task":
        if ($title) {
            try {
                delete_task($title);
            } catch (PDOException $e) {
                $error_message = "You cannot delete a course if assignments exists in the course";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=$list_todoitems");
        }
        break;
    case "delete_category":
        if ($categoryName) {
            try {
                delete_category($categoryName);
            } catch (PDOException $e) {
                $error_message = "You cannot delete a category if assignments exists in the course";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        }
    default:
    $categoryName = get_category_name($categoryID);
    $categories = get_categories();
    $todoitems = get_todoitems_by_category($categoryID);
    include("view/display_tasks.php");
}

?>