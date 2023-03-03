<?php

function add_task($title, $description, $categoryID)
{
    global $db;
    $query = 'INSERT INTO todoitems ( CategoryID, Title, Description  ) VALUES (:categoryID, :title, :description )';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}


function delete_task($title)
{
    global $db;
    $query = 'DELETE FROM todoitems where Title = :title';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $statement->closeCursor();
}

function get_todoitems_by_category($categoryID)
{
    global $db;
    if ($categoryID) {
        $query = 'SELECT  A.ItemNum, A.Title, A.Description, C.categoryName From todoitems A
            LEFT JOIN categories C ON A.categoryID = C.categoryID
                WHERE A.categoryID = :categoryID ORDER BY A.ItemNum';
    } else {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, C.categoryName From todoitems A
        LEFT JOIN categories C ON A.categoryID = C.categoryID ORDER BY C.categoryID';
    }
    $statement = $db->prepare($query);
    if ($categoryID) {
        $statement->bindValue(':categoryID', $categoryID);
    }
    $statement->execute();
    $todoitems = $statement->fetchAll();
    $statement->closeCursor();
    return $todoitems;
}

?>