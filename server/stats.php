<?php


function wp2android_charts()
{
	global $ml_api_key, $ml_secret_key, $ml_server_host;

	wp2android_display_charts();
}

function wp2android_display_charts()
{
	global $ml_api_key, $ml_secret_key;
	
	$parameters = array(
		'api_key' => $ml_api_key,	
		'secret_key' => $ml_secret_key
	);
	
	
	//SUBSCRIPTIONS
	$request = new WP_Http;
	$ml_host = "https://api.wp2android.wps.edu.vn";
	$url_subscriptions = "$ml_host/product/stats/devices/count";
	
	$result_subscriptions = $request->request( $url_subscriptions,
		array('method' => 'POST', 'timeout' => 10,'body' => $parameters));
		
	if($result_subscriptions)
	{
		$json_subscriptions = $result_subscriptions['body'];
	}
	
	//MODELS
	$request = new WP_Http;
	$url_models = "$ml_host/product/stats/devices/models";
	
	$result_models = $request->request( $url_models,
		array('method' => 'POST', 'timeout' => 10,'body' => $parameters));
		
	if($result_models)
	{
		$json_models = $result_models['body'];
	}
	
	//SESSIONS
	$request = new WP_Http;
	$url_sessions = "$ml_host/product/stats/events/sessions";
	
	$result_sessions = $request->request( $url_sessions,
		array('method' => 'POST', 'timeout' => 10,'body' => $parameters));
		
	if($result_sessions)
	{
		$json_sessions = $result_sessions['body'];
	}
	
	?>
	
	<script type="text/javascript" src="<?php echo $ml_host;?>/assets/highcharts.js"></script> 
	<div id="wp2android_analytics_title" style="margin-top:20px;">
		<h1>wp2android Analytics</h1>
		<div style="clear:both;">
	</div>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="wp2android_subscriptions_chart" style="width: 400px; height: 400px;margin-top:50px;margin-left:50px;"></div>
			</td>
			<td align="center">
				<div id="wp2android_sessions_chart" style="width: 400px; height: 400px;margin-top:50px;margin-left:50px;"></div>
			</td>
		</tr>
		<tr>
			<td align="center" colspan=2>
				<div id="wp2android_models_chart" style="width: 700px; height: 400px;margin-top:50px;"></div>
			</td>
		</tr>
	</table>
	



	<?php


}
?>