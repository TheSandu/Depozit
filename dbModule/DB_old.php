<?php
/**
 * Database Class 
 * Use chaining methods
 *
 * Ex: 
 *
 *     $db = new DB( hostName[string], dbName[string], userName[string], password[string]  );
 *
 *      [SELECT]	
 *     $db->select( (array)fields[strings] )
 *		  ->from( string )
 *        ->where( string )
 *        ->orderby( (array)fields[strings] )      *Optional
 * 		  ->limit( int )                           *Optional
 * 		  ->execute( void );     
 *
 *	    [INSERT]
 *     $db->insert( string, (array)fields[strings] )
 *		  ->values( (array)values[strings] )
 * 		  ->execute( void );
 */

define('DB_HOSTNAME', 'localhost');
define('DB_NAME', 'depozit_mentenance');
define('DB_USERNAME', 'sandu');
define('DB_PASSWORD', '3N5k0D7a');



class DB
{
	private $hostName;
	private $dbName;
	private $userName;
	private $password;
	private $mysql;
	private $expresionInUse = '';

	private $SqlExpresion = '';

	function __construct()
	{
		$this->hostName = DB_HOSTNAME;
		$this->dbName = DB_NAME;
		$this->userName = DB_USERNAME;
		$this->password = DB_PASSWORD;

		$this->mysql = new mysqli( $this->hostName, $this->userName, $this->password, $this->dbName);

		if ($this->mysql->connect_error) 
		{
			die("Connection failed: 42 :" . $this->mysql->connect_error . $hostName. $dbName. $userName. $password);
		}

	}

	public function connect( )
	{
		$this->hostName = DB_HOSTNAME;
		$this->dbName = DB_NAME;
		$this->userName = DB_USERNAME;
		$this->password = DB_PASSWORD;


		$this->mysql = new mysqli( $this->hostName, $this->userName, $this->password);

		if ($this->mysql->connect_error) 
		{
			die("Connection error : 62 : DB.php :<br>" . $this->mysql->connect_error);
		}
	}

	public function getHostName()
	{
		return $this->hostName;
	}

	public function getDbName()
	{
		return $this->dbName;
	}

	public function getUserName()
	{
		return $this->dbName;
	}

	public function select( $fields )
	{
		$this->expresionInUse = "select";

		if ( $this->SqlExpresion != "" ) 
		{
			$this->SqlExpresion = "";
		}

		$this->SqlExpresion .= "SELECT ";

		$filedsInString = implode(", ",$fields);
		$this->SqlExpresion .= $filedsInString;

		return $this;
	}

	public function from( $table )
	{

		$this->SqlExpresion .= " FROM ";
		$this->SqlExpresion .= $table;

		return $this;
	}

	public function where( $expresion )
	{

		$this->SqlExpresion .= " WHERE ";
		$this->SqlExpresion .= $expresion;

		return $this;
	}

	public function limit( $recordsNumber )
	{
		$this->SqlExpresion .= " LIMIT ";
		$this->SqlExpresion .= $recordsNumber;
		return $this;
	}

	public function orderby( $fields )
	{


		$this->SqlExpresion .= " ORDER BY ";

		$filedsInString = implode(", ",$fields);
		
		$filedsInString = Validator::SqlInjectionValidation( $filedsInString );
		$this->SqlExpresion .= $filedsInString;

		return $this;
	}

	public function insert( $table, $fields)
	{
		$this->expresionInUse = "insert";


		if ($this->SqlExpresion != "") 
		{
			$this->SqlExpresion = "";
		}

		$this->SqlExpresion .= "INSERT INTO ";
		$this->SqlExpresion .= $table;

		$filedsInString = implode(", ",$fields);
		$this->SqlExpresion .= " ( " . $filedsInString . " )";



		return $this;		
	}

	public function values( $values )
	{

		$this->SqlExpresion .= " VALUES ";

		for ($i = 0; $i < count($values); $i++) { 

			if ( !is_numeric( $values[ $i ] ) )
				$values[ $i ] = "'". $values[ $i ] . "'"; 

		}

		$filedsInString = implode(", ", $values);
		$this->SqlExpresion .= "(" . $filedsInString . " )";

		return $this;
	}
	
	public function update( $table )
	{
		$this->expresionInUse = "update";

		if ($this->SqlExpresion != "")
		{
			$this->SqlExpresion = "";
		}

		$this->SqlExpresion .= "UPDATE ";
		$this->SqlExpresion .= $table;

		return $this;
	}

	public function set( $fields )
	{
		$this->SqlExpresion .= " SET ";

		$changis = [];

		foreach ($fields as $fieldsName => $fieldsValue)
		{
			$changis[] = "$fieldsName = $fieldsValue";
		}

		$filedsInString = implode( ", ", $changis );
		$this->SqlExpresion .= $filedsInString;

		return $this;

	}

	public function delete( $table )
	{
		$this->expresionInUse = "delete";

		if ($this->SqlExpresion != "")
		{
			$this->SqlExpresion = "";
		}

		$this->SqlExpresion .= " DELETE FROM ";
		$this->SqlExpresion .= $table;

		return $this;
	}

	public function truncate( $table )
	{
		$this->expresionInUse = "truncate";

		if ($this->SqlExpresion != "")
		{
			$this->SqlExpresion = "";
		}

		$this->SqlExpresion .= " TRUNCATE TABLE ";
		$this->SqlExpresion .= $table;

		return $this;
	}

	public function execute()
	{
		$this->SqlExpresion .= ";";

		switch ($this->expresionInUse)
		{
			case 'select':
				$result = $this->mysql->query( $this->SqlExpresion );

				if ( $result->num_rows > 0 )
				{
				    $allSelectedData = [];

					while( $row = $result->fetch_assoc() )
					{
				        $allSelectedData[] = $row;
				    }

				    return $allSelectedData;

				} else
				{
				  return false;
				}

				break;

			case 'insert':
			case 'update':
			case 'delete':
			case 'truncate':
				return $this->queryValidation();
				break;

			default:
				// Cazu in proces de analiza
				return $this->queryValidation();
				break;	
		}
	}

	public function execute()
	{
		$this->SqlExpresion .= ";";

		switch ($this->expresionInUse) {
			case 'select':

				$result = $this->mysql->query( $this->SqlExpresion );


				if ( $result->num_rows > 0 ) {

				    $allSelectedData = [];

				    while( $row = $result->fetch_assoc() ) {
				        $allSelectedData[] = $row;
				    }

				    return $allSelectedData;

				} else {
				  return false;
				}

				break;

			case 'insert':
				if ( $this->mysql->query( $this->SqlExpresion ) === TRUE ) {
				    return true;
				}
				else {
					echo $this->mysql->error;
				    return false;
				}

				break;

			default:
				// Cazu inca nu este analizat
				break;
		}
	}

	public function getExpresion()
	{
		return $this->SqlExpresion;
	}

	public function stop()
	{
		$this->mysql->close();
	}
}