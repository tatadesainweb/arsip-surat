<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #343a40;
            color: white;
            padding: 20px 10px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Menu</h4>
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Welcome</a>
        <a href="{{ route('arsip.index') }}" class="{{ request()->routeIs('arsip.*') ? 'active' : '' }}">Arsip</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    </div>

    <!-- Konten Halaman -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus data ini?
          </div>
          <div class="modal-footer">
            <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            const deleteForm = document.getElementById('deleteForm');

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    let actionUrl = this.getAttribute('data-url');
                    deleteForm.setAttribute('action', actionUrl);
                    confirmDeleteModal.show();
                });
            });
        });
    </script>
</body>
</html>
