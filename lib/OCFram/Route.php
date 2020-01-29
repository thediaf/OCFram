<?php
    namespace OCFram;

    class Route
    {
        protected   $action,
                    $module,
                    $url;
        protected   $varsName;
        protected   $vars = [];
        
        public function __construct($url, $module, $action, $varsName)
        {

        }

        public function hasVars()
        {
            return !empty($this->varsName);
        }

        public function match($url)
        {
            if (preg_match('`^'.$this->url.'$`', $url, $matches))
            {
                return $matches;
            }
            else
            {
                return false;
            }
        }

        public function setActiion($action)
        {
            if (is_string($action))
            {
                $this->action = $action;
            }
        }

        public function setModule($module)
        {
            if (is_string($module))
            {
                $this->module = $module;
            }
        }

        public function setUrl($url)
        {
            if (is_string($action))
            {
                $this->url = $url;
            }
        }

        public function setVarsName(array $varsName)
        {
            $this->varsName = $varsName;
        }

        public function setVars(array $vars)
        {
            $this->vars = $vars;
        }

        public function action() { $this->action; }
        public function module() { $this->module; }
        public function url() { $this->url; }
        public function varsName() { $this->varsName; }
        public function vars() { $this->vars; }
        

    
    }