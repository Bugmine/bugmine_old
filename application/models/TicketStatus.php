<?php
/**
 * User: Stefan
 * Date: 19.11.2014
 * Time: 20:16
 */

namespace application\models;


class TicketStatus extends \CI_Model{
    private $id;
    private $name;
    private $close;

    /**
     * @return mixed
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * @param mixed $close
     */
    public function setClose($close)
    {
        $this->close = $close;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    function loadTicketStatus($id) {
        $query = $this->db->get_where($this->db->dbprefix("ticketstatus"), array('id' => $id));
        $result = $query->result_array();
        $this->setId($result[0]["id"]);
        $this->setName($result[0]["name"]);
        $this->setClose($result[0]["close"]);
    }
} 