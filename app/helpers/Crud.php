<?php

class Crud
{
    public static function route(CrudController $controller)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'create':
                        $controller->create();
                        break;
                    case 'edit':
                        $controller->edit($_GET['id']);
                        break;
                    case 'delete':
                        $controller->delete($_GET['id']);
                        break;
                    default:
                        $controller->index();
                        break;
                }
            } else {
                $controller->index();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'store':
                        $controller->store($_POST);
                        break;
                    case 'update':
                        $controller->update($_GET['id'], $_POST);
                        break;
                    default:
                        $controller->index();
                        break;
                }
            } else {
                $controller->index();
            }
        }
    }
}