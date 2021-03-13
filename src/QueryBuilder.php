<?php
namespace App;

class QueryBuilder {
    private $pdo;

    private $fields = ["*"];

    private $from;
    
    private $order = [];
    
    private $limit;

    private $offset;

    private $where;

    private $params = [];

    public function __construct(?\PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function from(string $table, string $alias = null)
    {
        $this->from = $alias === null ? $table : "$table $alias";
        
        return $this;
    }
    public function toSQL():string
    {
        $sql = "SELECT ". implode(", ", $this->fields). " FROM " . $this->from;
        if ($this->where) {
            $sql .= " WHERE $this->where";
        }
        if ($this->order) {
            $sql .= " ORDER BY " . implode(", ",$this->order);
        }
        if ($this->limit > 0) {
            $sql .= " LIMIT $this->limit";
        }
        if ($this->offset !== null) {
            $sql .= " OFFSET $this->offset";
        }
        
        return $sql;
    }
    public function orderBy(string $key, string $direction = "ASC")
    {
        $direction = strtoupper($direction );
        if (in_array($direction,["ASC","DESC"]))
        {
            $this->order[] = "$key $direction";
        } else 
        {
            $this->order[] = $key;
        
        }
        return $this;
    }
    public function limit(int $limit): self
    {
        
        $this->limit = $limit;
        return $this;
    }
    public function offset($offset): self
    {
        if ($this->limit === null) {
            throw new \Exception("impossible de definir un offset sans limit");
            
        }
        $this->offset = $offset ;
        return $this;
    }

    public function page(int $page): self
    {
        $this->offset($this->limit * ($page - 1 ));
        return $this;
    }

    public function where(string $where): self
    {
        $this->where = $where;
        return $this;
    }

    public function setParam(string $key,  $value): self
    {
        $this->params[$key] = $value;
        return $this;
    }
    public function select( ...$fields): self
    {
        if (is_array($fields[0])) {
            $fields = $fields[0];
        }
        if ($this->fields===["*"]) {
            $this->fields = $fields;
        } else {
            $this->fields = array_merge($this->fields,$fields);
        }
        
        
        return $this;
    }

    public function fetch( $fields): ?string
    {
        $query = $this->pdo->prepare($this->toSQL());
        $query->execute($this->params);
        $record = $query->fetch();
        if ($record === false) {
            return null;
        }
        return $record[$fields]; 
    }
    public function fetchAll(): array
    {
        $query = $this->pdo->prepare($this->toSQL());
        $query->execute($this->params);
        $record = $query->fetchAll();
        
        return $record; 
    }
    public function fetchFirst(): ?array
    {
        $query = $this->pdo->prepare($this->toSQL());
        $query->execute($this->params);
        dump($query);
        
        $record = $query->fetchAll();
        
        if ($record != []) {
            return $record[0];
        }
        return null;
         
    }

    public function count():int
    {
        $query = clone $this;
        $query->select("COUNT(id) count");
        $req = $this->pdo->prepare($query->toSQL());
        $req->execute($query->params);
        $record = $req->fetch();
        return $record['count'];
    }

}