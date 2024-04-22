@if (session()->has('success'))
    <script>
        let timerInterval;
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true,
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        let timerInterval;
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session('error') }}",
            timer: 3000,
            timerProgressBar: true,
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
    </script>
@endif

@if (session()->has('warning'))
    <script>
        let timerInterval;
        Swal.fire({
            icon: "warning",
            title: "Informasi!",
            text: "{{ session('warning') }}",
            timer: 3000,
            timerProgressBar: true,
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
    </script>
@endif
