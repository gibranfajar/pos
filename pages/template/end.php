<script>
    $(function() {
        $("#tanggal").datepicker({
            dateFormat: "dd/mm/yy",
            dateMonth: true,
            dateYear: true
        });
    });
</script>



<!-- Vendor JS Files -->
<script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../assets/vendor/quill/quill.min.js"></script>
<script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $('.alert_notif').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Apakah kamu yakin ingin keluar?',
            text: "Anda harus login ulang untuk bisa masuk ke halaman ini lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });
    $('.alert_delete').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Apakah kamu yakin ingin hapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });
</script>

</body>

</html>