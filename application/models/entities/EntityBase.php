<?php

/**
 * User: Stefan
 * Date: 20.11.2014
 * Time: 18:14
 */
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class EntityBase extends CI_Model
{
    private $id;

    /**
     * @return long
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param long $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

} 