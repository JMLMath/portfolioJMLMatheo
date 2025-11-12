<?php
class Controller_outil extends Controller
{
    public function action_showOutil()
    {
        $outilDAO = OutilDAO::getModel();
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $outil = $outilDAO->getOutilFromId($id);

            $data = $outil->getAllAttributes();
            $this->render('outil', $data);
        }
    }

    public function action_default()
    {
        echo "default"; // temporairement
    }
}
?>