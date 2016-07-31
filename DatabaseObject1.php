<?php
include_once( 'interfaces/IDatabaseObject.php' );

class DatabaseObject implements IDatabaseObject 
{
	private $transaction = false;
	private $properties = array();
	private $values = array();	
	private $table;
	private $index;
	private $ID;
	
	
	function __construct($properties, $table, $index, $row = NULL)
	{
		$this->properties = $properties;
		$this->table = $table;
		$this->index = $index;
				
		if (!is_null($row)) {
			foreach($this->properties as $key => $value) {
				if (strstr($value, '_fk_')) {
					$n = $row[$value];

					if (isset($_SESSION['GOC'])) {
						if (isset($_SESSION['GOC'][$key])) {
							if (isset($_SESSION['GOC'][$key][$n])) {
								$this->values[$value] = $_SESSION['GOC'][$key][$n];

								$_SESSION['GOC']['HIT']++; 
							}
							else {
								$c = new ReflectionClass($key);
								$o = $c->newInstance();

								$o->Load($n);	

								$_SESSION['GOC'][$key][$n] = $this->values[$value] = $o;
								$_SESSION['GOC']['MISS']++; 
							}
						}
						else {
							$_SESSION['GOC'][$key] = array();

							$c = new ReflectionClass($key);
							$o = $c->newInstance();

							$o->Load($n);	

							$_SESSION['GOC'][$key][$n] = $this->values[$value] = $o;
							$_SESSION['GOC']['MISS']++; 
						}
					}
					else {
						$c = new ReflectionClass($key);
						$o = $c->newInstance();

						$o->Load($n);	

						$this->values[$value] = $o;
					}
				}				
				else {
					$this->values[$value] = $row[$value];      
                    
				}
			}
			
			$this->ID = $row[$this->index];
		}
	}
	
	function __set($name, $value)
	{
		global $pdo;
		
		if (array_key_exists($name, $this->properties)) {
			if (!$this->transaction) {
				$pdo->beginTransaction();
				$this->transaction = true;
			}
			
			if ($value instanceof IDatabaseObject) {
				if ($this->ID) {
					$pdo->exec("UPDATE " . $this->table . " SET " . $this->properties[$name] . " = '" . $value->ID . "' WHERE " . $this->index . " = " . $this->ID);
				}
				else {
					$pdo->exec("INSERT INTO " . $this->table . " (" . $this->properties[$name] . ") VALUES ('" . $value->ID . "')");
					$this->ID = $pdo->lastInsertId();				
				}
			}
			else {
				if ($this->ID) {
					$pdo->exec("UPDATE " . $this->table . " SET " . $this->properties[$name] . " = '" . $value . "' WHERE " . $this->index . " = " . $this->ID);
				}
				else {
				
					$pdo->exec("INSERT INTO " . $this->table . " (" . $this->properties[$name] . ") VALUES ('" . $value . "')");
					$this->ID = $pdo->lastInsertId();
				}
			}
			
			return $this->values[$this->properties[$name]] = $value;
		}
		else {
			throw new Exception("Gerenciador: Propriedade inválida: $name");
		}
	}
	
	function __get($name)
	{
		switch ($name) {			
			case 'ID':
				return $this->ID;
				
			default:
				return $this->values[$this->properties[$name]];
		}
	}
		
	function Load($id = NULL)
	{
		global $pdo;
		
		if ( is_null( $id ) == false && is_numeric( $id ) )
		{
			$SQL = "SELECT " . $this->index . ",";
			
			foreach ($this->properties as $key => $value) 
            {
				$SQL .= $value . ",";	
			}
			
			$SQL[strlen($SQL)-1] = " ";
			$SQL .= "FROM " . $this->table . " WHERE " . $this->index . " = " . $id;
			
			$cmd = $pdo->query($SQL);
			
			if ( $cmd -> rowCount() > 0 )
			{
				foreach ( $cmd as $row ) {
					foreach($this->properties as $key => $value) {
						if (strstr($value, '_fk_')) {
							$class = new ReflectionClass($key);
							$this->values[$value] = $class->newInstance();	
							$this->values[$value]->Load($row[$value]);
						}				
						else {
							$this->values[$value] = $row[$value];
						}				
					}
					
					$this->ID = $row[$this->index];
					return true;
				}
			}
			else
				return false;
		}
		else
			return false;
	}
	
	function Save()
	{
		global $pdo;
		
		if ($this->transaction) {
			$pdo->commit();
			$this->transaction = false;
		}
		
		return true;
	}
	
	function Delete()
	{
		global $pdo;
		
		if ($this->ID) {
			$SQL = "DELETE FROM " . $this->table . " WHERE " . $this->index . " = " . $this->ID;
			
			if ($pdo->exec($SQL) > 0)
				return true;
			else 
				return false;
		}
		else {
			return false;
		}
	}
}

?>
