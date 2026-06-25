<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayU...</title>
</head>
<body onload="document.payuForm.submit()">
    <h3>Please wait, redirecting to PayU Money...</h3>
    <form action="<?php echo e($payuUrl); ?>" method="POST" name="payuForm">
        <input type="hidden" name="key" value="<?php echo e($data['key']); ?>">
        <input type="hidden" name="txnid" value="<?php echo e($data['txnid']); ?>">
        <input type="hidden" name="amount" value="<?php echo e($data['amount']); ?>">
        <input type="hidden" name="productinfo" value="<?php echo e($data['productinfo']); ?>">
        <input type="hidden" name="firstname" value="<?php echo e($data['firstname']); ?>">
        <input type="hidden" name="email" value="<?php echo e($data['email']); ?>">
        <input type="hidden" name="phone" value="<?php echo e($data['phone']); ?>">
        <input type="hidden" name="surl" value="<?php echo e($data['surl']); ?>">
        <input type="hidden" name="furl" value="<?php echo e($data['furl']); ?>">
        <input type="hidden" name="hash" value="<?php echo e($data['hash']); ?>">
        <input type="hidden" name="udf1" value="<?php echo e($data['udf1']); ?>">
        <input type="hidden" name="udf2" value="<?php echo e($data['udf2']); ?>">
        <input type="hidden" name="udf3" value="<?php echo e($data['udf3']); ?>">
        <input type="hidden" name="udf4" value="<?php echo e($data['udf4']); ?>">
        <input type="hidden" name="service_provider" value="payu_paisa">
    </form>
</body>
</html>
<?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/subscription/payu_form.blade.php ENDPATH**/ ?>