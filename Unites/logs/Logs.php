<?php


/**
 * For Logs manage
 */

class Logs
{
	public function getAllLogs( $DB )
	{
		$Logs = $DB->select(["*"])
				     ->from("logs")
				     ->execute();

		return $Logs;
	}

	public function tableFromLogsArray( $Logs )
	{
		$table = "";

		for ($i = 0, $LogsCount = count($Logs); $i < $LogsCount; $i++) { 
            $table .= "<tr>" .
                "<td>".$Logs[$i]['biroul']."</td>" .
                "<td>".$Logs[$i]['biroul']."</td>" .
                "<td>".$Logs[$i]['depozitul']."</td>" .
                "<td>".$Logs[$i]['destinatarul']."</td>" .
                "<td>".$Logs[$i]['gestionar']."</td>" .
                "<td>".$Logs[$i]['nr_depozit']."</td>" .
                "<td>".$Logs[$i]['denumirea']."</td>" .
                "<td>".$Logs[$i]['eliberat']."</td>" .
                "<td>".$Logs[$i]['masura']."</td>" .
                "<td>".$Logs[$i]['pretul']."</td>" .
                "<td>".$Logs[$i]['solicitat']."</td>".
            "</tr>";
		}

		return $table;
	}

	public function getAllLogsAsTable( $DB )
	{
		$Logs = $this->getAllLogs( $DB );

		return $this->tableFromLogsArray( $Logs );
	}

	public function insert( $values, $DB )
	{
        
        $fields = ["biroul", "depozitul", "destinatarul", "gestionar", "nr_depozit", "denumirea", "eliberat", "masura", "pretul", "solicitat"];
		$DB->insert( 'logs', $fields )
		   ->values( $values )
		   ->execute();
	}
}