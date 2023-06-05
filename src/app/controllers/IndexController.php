<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // redirected to index view

    }

    public function addWordAction()
    {
        $english = $this->request->getPost('english');
        $dutch = $this->request->getPost('dutch');

        $sql = "INSERT INTO `dictionary`(`english`, `dutch`) VALUES ('$english','$dutch')";
        $this->db->execute($sql);
        $this->response->redirect('/index/');
    }

    public function dictToFileAction()
    {
        include_once APP_PATH . "/messages/nl_NL.php";
        $sql = "SELECT * FROM `dictionary`";
        $result = $this->db->fetchAll(
            $sql,
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        foreach ($result as $value) {
            $dutch = $value['dutch'];
            $english = $value['english'];
            $messages[$english] = $dutch;
        }
        echo "<pre>";
        print_r($messages);
        die;
    }
}
