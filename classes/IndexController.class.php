<?php

class IndexController
{
    // main item array.
    private $mainItemArray;

    //constructor
    public function __construct() {
        $this->loadTreeFromFile();
    }

    //private controller functions
    // function builds tree from section model object array
    private function buildTree(array $nodesArr, $parentUid = 0){
        $branch = array();
        foreach ($nodesArr as $node) {
            if ($node->getParentUid() == $parentUid){
                $children = $this->buildTree($nodesArr, $node->getUid());
                if ($children) {
                    $node->children = $children;
                }
                $branch[] = $node;
            }
        }
        return $branch;
    }
    //prepare html for tree view
    private function prepareTreeHtml($tree){
        if (!is_null($tree) && count($tree) > 0){
            echo '<ul>';
            foreach ($tree as $node) {
                //echo '<li>' . $node->getSectionArr()['name'];
                $uid = $node->getUid();
                echo "<li>" . "<a class='tree-node' onclick='loadNode(this);' data-uid='$uid' >" . $node->getSectionArr()['name'] .'</a>';
                $this->prepareTreeHtml($node->children);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    //prepare html for displaying node data
    public function prepareNodeHtml($nodeUid) {
        $nodeObj = $this->findInArray($this->mainItemArray, $nodeUid);

        if ($nodeObj) {
            $nodeName = $nodeObj->getSectionArr()['name'];
            $nodeDescription = $nodeObj->getSectionArr()['description'];
            echo <<<NODEHTML
                <h4>$nodeName</h4>
                <p>$nodeDescription</p>
            NODEHTML;
        }else {
            echo "<h4> Node not found </h4>";
        }
    }
    // resets tree array
    private function resetTree() {
        return $this->buildTree($this->mainItemArray);
    }

    // finds item in array and returns it
    private function findInArray($array, $uid){
        $node = null;
        foreach ($array as $item) {
            if ($item->getUid() === $uid){
                $node = $item;
            }
        }
        return $node;
    }
    //saves the main array to file
    private function saveTreeToFile() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/tree.json';
        $detailedArr = array();
        foreach ($this->mainItemArray as $item) {
            $detailedArr[] = $item->getSectionArr();
        }
        file_put_contents($filePath, json_encode($detailedArr));
    }
    //loads array from file to the main array
    private function loadTreeFromFile() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/tree.json';
        $readResult = json_decode(file_get_contents($filePath), true);
        foreach ($readResult as $item) {
            $SectionObj = new SectionModel($item['uid'], $item['name'], $item['description'], $item['parent_uid']);
            $this->mainItemArray[] = $SectionObj;
        }
    }

    //public functions
    //function makes a temporary tree array which is used for preparing html drawing it on page.
    public function getTree() {
        $this->prepareTreeHtml($this->resetTree());
    }
    // function which creates and adds new item to main item array and then saves it to file.
    public function addItem($name, $description, $uid, $isChild) {
        if ($isChild == 'false' || $uid == 'undefined') {
            $parentUid = null;
            if ($uid != 'undefined'){
                $referenceNode = $this->findInArray($this->mainItemArray, $uid);
                $parentUid = $referenceNode->getParentUid();
            }
            $newItemObj = new SectionModel(uniqid(), $name, $description, $parentUid);
            $this->mainItemArray[] = $newItemObj;
        }elseif ($isChild == 'true'){
            $parentUid = $uid;
            $newItemObj = new SectionModel(uniqid(), $name, $description, $parentUid);
            $this->mainItemArray[] = $newItemObj;
        }else{
            return false;
        }
        $this->saveTreeToFile();
        return true;
    }
    // function removes item by uid from main array, saves it to file and returns a message
    public function removeItem($uid) {
        foreach ($this->mainItemArray as  $value){
            if ($value->getParentUid() == $uid){
                return 'child';
            }
        }
        foreach ($this->mainItemArray as $key => $value){
            if ($value->getUid() == $uid){
                unset($this->mainItemArray[$key]);
            }
        }
        $this->saveTreeToFile();
        return 'true';
    }
    // searches node by uid and returns its data for view to use.
    public function getNodeDataForEdit($uid) {
        $targetObj = $this->findInArray($this->mainItemArray, $uid);
        if (is_null($targetObj)){
            return null;
        }
        return $targetObj->getNameDescArr();
    }
    // edits the node with data provided from form in edit page, returns message.
    public function editNode($uid, array $arr) {
        $bSuccess = false;
        $name = $arr['name'];
        $description = $arr['description'];
        foreach ($this->mainItemArray as $key => $value){
            if ($value->getUid() == $uid){
                $this->mainItemArray[$key]->setNameAndDescription($name, $description);
                $this->saveTreeToFile();
                $bSuccess = true;
            }
        }
        return $bSuccess;
    }

} //index controller end

