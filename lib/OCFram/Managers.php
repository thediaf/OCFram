<?php
    namespace OCFram;

    class Managers
    {
        protected   $appi = null,
                    $dao = null,
                    $managers = [];

        public function __contruct($appi, $dao)
        {
            $this->appi = $appi;
            $this->dao = $dao;
        }

        public function getManagerOf($module)
        {
            if (!is_string($module) || empty($module))
            {
                throw new \InvalidArgumentException('Le module spécifié est invalide');
            }

            if (!isset($this->managers[$module]))
            {
                $manager = '\\Model\\' . $module . 'Manager' . $this->appi;

                $this->managers[$module] = new $manager($this->dao);
            }            

            return $this->managers[$module];
        }
    }