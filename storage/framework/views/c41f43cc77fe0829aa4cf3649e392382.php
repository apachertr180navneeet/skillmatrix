<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;">
    <tbody>
        <tr>
            <td align="left" style="">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:0;padding:0;width:100%">
                    <tbody>
                        <tr>
                            <td width="100%" cellpadding="0" cellspacing="0" style="">
                                <table align="left" cellpadding="0" cellspacing="0" role="presentation">
                                    <tbody>
                                        <tr align="left">
                                            <td align="left">
                                                <?php if(isset($email)): ?>
                                                    <p>Hi : <?php echo e($email); ?></p>
                                                <?php else: ?>
                                                    <p>Hi : <?php echo e($name); ?></p>
                                                <?php endif; ?>
                                                <h3>Welcome to <?php echo e(config('app.name')); ?>.</h3>
                                                <?php if(isset($token)): ?>
                                                    <p>Please click this link to create new password : <strong><a href="<?php echo e($token); ?>">Click Here</a></strong></p>
                                                <?php else: ?>
                                                    <p> Your forgot password 6 digits code is : <strong><?php echo e($code); ?></strong></p>
                                                    <p>Note : This code is valid for 2 hour only.</p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/email/forgot-password.blade.php ENDPATH**/ ?>