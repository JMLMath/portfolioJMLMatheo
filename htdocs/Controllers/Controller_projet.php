<?php
class Controller_projet extends Controller
{
    public function action_showProjet()
    {
        $projetDAO = ProjetDAO::getModel();
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $projet = $projetDAO->getProjetFromId($id);

            $data = $projet->getAllAttributes();
            $this->render('projet', $data);
        }
    }

    public function action_showAllProjet()
    {
        $projetDAO = ProjetDAO::getModel();
        
        $allProjet = $projetDAO->getAllProjet();
        $all = [];
        foreach($allProjet as $p)
        {
            //adding all projet as an array in the $all array
            $all[] = $p->getAllAttributes();
        }
        
        $this->render('all_projet', ["all" => $all]);
    }

    public function action_default()
    {
        echo "default"; // temporairement
    }
}
?>