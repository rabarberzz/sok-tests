<?php

class SectionModel
{
    private $uid;
    private $name;
    private $description;
    private $parent_uid;
    public $children;

    public function __construct($uid, $name, $description, $parent_uid) {
        $this->uid = $uid;
        $this->name = $name;
        $this->description = $description;
        $this->parent_uid = $parent_uid;
    }

    public function getSectionArr() : array{
            return array(
            'uid' => $this->uid,
            'name' => $this->name,
            'description' => $this->description,
            'parent_uid' => $this->parent_uid
        );
    }

    public function setNameAndDescription($name, $description){
        $this->name = $name;
        $this->description = $description;
    }

    public function getNameDescArr() : array {
        return array(
            'name' => $this->name,
            'description' => $this->description
        );
    }

    public function getParentUid() {
        return $this->parent_uid;
    }
    public function getUid() {
        return $this->uid;
    }

}