<?php

include 'config.php';


if ( Account::isLogIn() ) {
	if ( Account::role() == 'Admin' )
	{
		Routes::toAdminPage();

	}
	elseif ( Account::role() == 'Manager' )
	{
		Routes::toManagerPage();

	}
	//elseif ( Account::role() == 'Operator' )
}
else
	Routes::toLoginPage();