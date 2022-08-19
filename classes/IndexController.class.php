<?php

class IndexController
{
//    private $testTree;
//    private $testNodesArr;
//    private SectionModel $testObj;
    private $loadTest;

    //constructor
    public function __construct() {
//        $testObj = new TestClass();
//        $this->testNodesArr = $testObj->initNodes();
        $this->loadTreeFromFile();
        //var_dump($this->testTree);
        //$this->resetTree();
        //$this->saveTreeToFile();
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
                echo "<li >" . "<a class='tree-node' onclick='loadNode(this);' data-uid='$uid' >" . $node->getSectionArr()['name'] .'</a>';
                $this->prepareTreeHtml($node->children);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    //prepare html for displaying node data
    public function prepareNodeHtml($nodeUid) {
        //$nodeObj = $this->findInTree($nodeUid, $this->loadTest);
        //var_dump($this->testTree);
        //$this->loadTreeFromFile();
        $nodeObj = $this->findInArray($this->loadTest, $nodeUid);

        //var_dump($nodeObj);

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
//        $this->testTree = $this->buildTree($this->loadTest);
        return $this->buildTree($this->loadTest);
        //var_dump($this->testTree);
    }
    private function findInTree($nodeUid, $nodeArr) {
        if (!is_null($nodeArr) && count($nodeArr) > 0){
            foreach ($nodeArr as $node){
                if ($node->getUid() == $nodeUid) {
                    return $node;
                }else {
                    $this->findInTree($nodeUid, $node->children);
                }
            }
        }
        return null;
    }
    private function findInArray($array, $uid){
        $node = null;
        foreach ($array as $item) {
            if ($item->getUid() === $uid){
                $node = $item;
            }
        }
        return $node;
    }
    private function saveTreeToFile() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/tree.json';
        $detailedArr = array();
        foreach ($this->loadTest as $item) {
            $detailedArr[] = $item->getSectionArr();
        }
        file_put_contents($filePath, json_encode($detailedArr));
    }
    private function loadTreeFromFile() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/tree.json';
        $readResult = json_decode(file_get_contents($filePath), true);
        foreach ($readResult as $item) {
            $SectionObj = new SectionModel($item['uid'], $item['name'], $item['description'], $item['parent_uid']);
            $this->loadTest[] = $SectionObj;
        }
    }

    //public functions
    public function getTree() {
        //$this->resetTree();
        return $this->prepareTreeHtml($this->resetTree());
    }
    public function addItem($name, $description, $uid, $isChild) {
        if ($isChild == 'false' || $uid == 'undefined') {
            $parentUid = null;
            if ($uid != 'undefined'){
                $referenceNode = $this->findInArray($this->loadTest, $uid);
                $parentUid = $referenceNode->getParentUid();
            }
            $newItemObj = new SectionModel(uniqid(), $name, $description, $parentUid);
            $this->loadTest[] = $newItemObj;
        }elseif ($isChild == 'true'){
            $parentUid = $uid;
            $newItemObj = new SectionModel(uniqid(), $name, $description, $parentUid);
            $this->loadTest[] = $newItemObj;
        }else{
            return false;
            die();
        }
        $this->saveTreeToFile();
        return true;
    }
    public function removeItem($uid) {
        foreach ($this->loadTest as $key => $value){
            if ($value->getParentUid() == $uid){
                return 'child';
            }
        }
        foreach ($this->loadTest as $key => $value){
            if ($value->getUid() == $uid){
                unset($this->loadTest[$key]);
            }
        }
        $this->saveTreeToFile();
        return 'true';
    }



} //index controller end

class TestClass {
    public function initNodes() {
        $rootnode1 = new SectionModel(uniqid(), 'root1', 'node desc', null);
        $rootnode2 = new SectionModel(uniqid(),'root2', 'node desc', null);
        $subnode1 = new SectionModel(uniqid(),'sub1', 'sub desc', $rootnode1->getUid());
        $subnode2 = new SectionModel(uniqid(),'sub2', 'sub2 desc', $rootnode2->getUid());
        $subsubnode1 = new SectionModel(uniqid(),'subsub1', 'subsub1 desc', $subnode2->getUid());
        return $nodesArr = array($rootnode1, $rootnode2, $subnode1, $subnode2, $subsubnode1);
    }
}