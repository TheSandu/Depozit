<?php 

/**
 * Class is used to vaidate password and other strings
 * 
 */


class Validator
{
	
	public static function passwordValidation( $password )
	{
		# code...
	}

	public static function SqlInjectionValidation( $SqlExpresion )
	{
        $forbiddenChar = array( '<%=', '*', ';' ,'+', '--', '\'', 
        						'X00', 'X04', 'X08','X0D', 'X1B', 'X20', 'X7F', 'X0A',
        						'.JS', 
        						'DROP', 'SELECT', 'FROM','DELETE', 'OR', 'AND', 'ALTER', 'ORDER BY', 'CREATE', 'INSERT', 'UPDATE', 'UNION',
        						'<SCRIPT>', '<OBJECT>', '<APPLET>', '<EMBED>','<FORM>', '<IFRAME>', '<COMMENT>', '<BODY>','<NOSCRIPT>');
            
        $SqlExpresion = str_ireplace($forbiddenChar, "", $SqlExpresion);
        return $SqlExpresion;
	}
}
?>