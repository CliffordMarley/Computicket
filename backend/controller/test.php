<?php
	include_once("DPOIntegration.php");
	$res = verifyToken("3D3C4EF8-3032-46AB-BEAA-D074BC6AE7C6","EVT-4557");
	echo json_encode($res);
?>