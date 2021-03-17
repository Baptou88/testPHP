<?php

namespace App;

class Table {

    private $query;
    private $sortable = [];
    private $columns = [];
    private $get = [];
    private $limit = 1;
    private $formatters = [];

    public function __construct(QueryBuilder $query, ?array $get = [])
    {
        $this->query = $query;
        $this->get = $get;
    }
    /**
     * 
     */
    public function sortable(string ...$sortable)
    {
        $this->sortable = $sortable;
    }

    public function columns(array $columns)
    {
        
        $this->columns = $columns;
    }
    public function render()
    {
        $page = $this->get['p'] ?? 1;
        $count = (clone $this->query)->count();
        $this->query
            ->limit($this->limit)
            ->page($page);

        $retour = "<table class=\"table table-striped table-sm\">";
        $retour .= $this->tHead();
        $retour .= $this->tBody();
        $retour .= "</table>";
        $retour .= "<p>nb records: $count</p>";
        $pages = ceil($count / $this->limit);
        if ($pages > 1 && $page > 1)
        {
            // $retour .= "<a href=?p=". ($page-1) . ">page-1</a>";
            $retour .= "<a href=?" . URLHelper::withParam($this->get,"p",$page-1) . ">page-1</a>";
        }
        if ($pages > 1 && $page < $pages)
        {
            // $retour .= "<a href=?p=". ($page+1) . ">page+1</a>";
            $retour .= "<a href=?" . URLHelper::withParam($this->get,"p",$page+1). ">page+1</a>";
        }
        return $retour;
    }
    private function tHead(): string
    {
        $retour = "<thead><tr>";
        foreach ($this->columns as $key => $value) {
            //$retour .= "<th>$value</th>";
            $retour .= "<th>".$this->th($key)."</th>";
        }
        $retour .= "</tr></thead>";
        return $retour;
    }
    private function td($key, array $item):string
    {
        if (isset($this->formatters[$key])) {
            //dump($item);
            // return "<td>".  $this->formatters[$key]($item[$key]) . "<td>";
            return "<td>".  $this->formatters[$key]($item) . "<td>";
        }
        return "<td>$item[$key]</td>";
    }
    private function tBody(): string
    {
        $retour = "<tbody>";
       $records = $this->query->fetchAll();

        foreach ($records as $record ) {
            $retour .= "<tr>";
            foreach ($this->columns as $key => $value) {

                //$retour .= "<td>$record[$key]</td>";
                $retour .= $this->td($key,$record);
            }
            $retour .= "</tr>";
        } 
        $retour .= "</tbody>";
        return $retour;
    }
    public function format($key , callable $function):self
    {
        $this->formatters[$key] = $function;
        return $this;    
    }
    public function getcolumns()
    {
        dump($this->columns);
    }

    private function th(string $key): string   
    {
        
        if (in_array($key,$this->sortable)) {
            return "<a href=\"#\">" . $this->columns[$key] . "</a>";
        }else {
            return $this->columns[$key];
        }
    }

    public function dumpcolumns()
    {
        $this->getcolumns();
        foreach ($this->columns as $key => $value) {
            dump( $key . " " . $value  );
        }
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */ 
    public function setLimit($limit):self
    {
        $this->limit = $limit;

        return $this;
    }
}