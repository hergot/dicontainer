<?php

namespace hergot\dicontainer;

interface ServiceInterface {
    /**
     * Retrieve service instance
     * 
     * @return mixed
     */
    public function getInstance();
}