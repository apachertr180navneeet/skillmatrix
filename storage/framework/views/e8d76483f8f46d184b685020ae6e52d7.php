
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    function setFlesh(status, message = '') {
        Toast.fire({
            icon: status,
            title: message
        })
    }
</script>
<?php if(Session::has('success')): ?>
<script>
    Toast.fire({
        icon: 'success',
        title: "<?php echo e(!empty(Session::get('message')) ? Session::get('message') :Session::get('success')); ?>"
    })
</script>
<?php endif; ?>
<?php if(Session::has('error')): ?>
<script>
    Toast.fire({
        icon: 'error',
        title: "<?php echo e(!empty(Session::get('message')) ? Session::get('message') :Session::get('error')); ?>"
    })
</script>
<?php endif; ?>
<?php if(Session::has('warning')): ?>
<script>
    Toast.fire({
        icon: 'warning',
        title: "<?php echo e(!empty(Session::get('message')) ? Session::get('message') :Session::get('warning')); ?>"
    })
</script>
<?php endif; ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/userlayouts/elements/sweet_alerts.blade.php ENDPATH**/ ?>