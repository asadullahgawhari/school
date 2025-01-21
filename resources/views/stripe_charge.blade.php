<!DOCTYPE html>
<html>
<head>
	<title>Stripe Checkout</title>
</head>
<body>
<script src="https://js.script.com/v3"></script>
<script type="text/javascript">
	var session_id = '{{ $session_id }}';
	var script = Stripe('{{ $setPublicKey }}');
		stripe.redirectToCheckout({
			sessionId: session_id
		}).then(function (result) {
		});
</script>
</body>
</html>