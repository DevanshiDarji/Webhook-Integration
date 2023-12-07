<?php
 
//post_execute logic
global $sugar_config;
global $current_user;
$databaseType = $sugar_config['dbconfig']['db_type'];
if($databaseType == 'mysql'){
	//webhook integration configuration table
	$WebHookIntegration = "CREATE TABLE IF NOT EXISTS vi_enable_webhooksintegration(
																enable int(3)
															)";
	$WebHookIntegrationResult = $GLOBALS['db']->query($WebHookIntegration);
}else if($databaseType == 'mssql'){
	//webhook integration configuration table
	$WebHookIntegration = "IF NOT EXISTS (SELECT * FROM dbo.sysobjects where id = object_id(N'dbo.[vi_enable_webhooksintegration]') and OBJECTPROPERTY(id, N'IsTable') = 1)
					BEGIN
					CREATE TABLE [dbo].[vi_enable_webhooksintegration](
						[enable] [INT] NULL
					)
					END";
	$WebHookIntegrationResult = $GLOBALS['db']->query($WebHookIntegration);
}
?>