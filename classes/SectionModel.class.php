<?php

class SectionModel
{
    public $uid;
    protected $name;
    protected $description;
    public $parent_uid;
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

    public function getParentUid() {
        return $this->parent_uid;
    }
    public function getUid() {
        return $this->uid;
    }
}