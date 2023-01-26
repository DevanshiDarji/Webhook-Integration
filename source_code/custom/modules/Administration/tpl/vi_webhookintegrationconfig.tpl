{*
/*********************************************************************************
 * This file is part of package WebHook Integration.
 * 
 * Author : Variance InfoTech PVT LTD (http://www.varianceinfotech.com)
 * All rights (c) 2022 by Variance InfoTech PVT LTD
 *
 * This Version of WebHook Integration is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of Variance InfoTech PVT LTD
 * 
 * You can contact via email at info@varianceinfotech.com
 * 
 ********************************************************************************/
*}
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="custom/modules/Administration/css/VIWebhookIntegrationConfig.css">
	</head>

	<body>
 		<div>
			<table style="width:100%;">
				<tr>
					<td>
						<h2 class="module-title-text">{$MOD.LBL_WEBHOOK_INTEGRATION}</h2>
					</td>
					<td style="float:right;margin-top:16px;">
						&nbsp;&nbsp;
						<input type="button" name="btn_back" value="back" class="button btn_back" onclick=window.location.href='{$ADMINISTRATIONVIEW}' style="margin-left:10px;">
						
						<a href="index.php?module=VIWebHookIntegrationLicenseAddon&action=license"><button class="button">{$MOD.LBL_UPDATE_LICENSE}</button></a>
					<td>
				</tr>
			</table>
		</div>
		<!-- Suitecrm box design start -->
		    {$HELP_BOX_CONTENT}
		    <!-- Suitecrm box design end -->
	
		<form method ='post'>
			<div>
				<table id="enable_webhook_integartion">
					<tr>
						<td><b>{$MOD.LBL_WEBHOOK_INTEGRATION_DESCRIPTION}</b></td> 
						<td>
							<label class="switch">
		    					<input type="checkbox" id="enabled_webhook_integration" name="enabled_webhook_integration" {if $ENABLE eq 1}checked="checked"{/if}>
		    					<span class="slider round" id='slider_round'></span>
	    					</label>
	    				</td>
					</tr>
				</table>
			</div>
			<br/>
			<div>
				<p><a href="https://store.suitecrm.com/docs/webhook-integration/user-guide" target="_blank">{$MOD.LBL_WEBHOOK_WORKS_LABEL}</a></p>
			</div>
		</form>
	</body>
</html>
{literal}
<script type="text/javascript" src="custom/modules/Administration/js/VIWebhookIntegrationConfig.js"></script>
{/literal}