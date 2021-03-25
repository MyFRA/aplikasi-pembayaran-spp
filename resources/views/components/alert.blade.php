<div>
    <script>
        @if( $status == 'success' ) 
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ $message }}',
            })
        @else
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ $message }}',
            })
        @endif 
    </script>
</div>