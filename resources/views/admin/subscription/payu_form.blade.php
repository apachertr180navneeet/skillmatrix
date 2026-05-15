<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayU...</title>
</head>
<body onload="document.payuForm.submit()">
    <h3>Please wait, redirecting to PayU Money...</h3>
    <form action="{{ $payuUrl }}" method="POST" name="payuForm">
        <input type="hidden" name="key" value="{{ $data['key'] }}">
        <input type="hidden" name="txnid" value="{{ $data['txnid'] }}">
        <input type="hidden" name="amount" value="{{ $data['amount'] }}">
        <input type="hidden" name="productinfo" value="{{ $data['productinfo'] }}">
        <input type="hidden" name="firstname" value="{{ $data['firstname'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="phone" value="{{ $data['phone'] }}">
        <input type="hidden" name="surl" value="{{ $data['surl'] }}">
        <input type="hidden" name="furl" value="{{ $data['furl'] }}">
        <input type="hidden" name="hash" value="{{ $data['hash'] }}">
        <input type="hidden" name="udf1" value="{{ $data['udf1'] }}">
        <input type="hidden" name="udf2" value="{{ $data['udf2'] }}">
        <input type="hidden" name="udf3" value="{{ $data['udf3'] }}">
        <input type="hidden" name="udf4" value="{{ $data['udf4'] }}">
        <input type="hidden" name="service_provider" value="payu_paisa">
    </form>
</body>
</html>
