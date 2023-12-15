<!-- Bootstrap Modal -->
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="produkModalLabel" aria-hidden="true">
    <form method="POST" enctype="multipart/form-data" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel"><span id="modal-title"></span> Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- bagian konten modal akan di isi oleh javascript dibawah -->
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Deksripsi Produk"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="photo" class="col-sm-3 col-form-label">Produk Photo</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori_select" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="kategori_select" name="kategori_id"
                                aria-label="Kategori Select">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-end">
                        <button type="submit" class="invisible btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4><i class="bi bi-cart me-1"></i> Daftar <small class="text-secondary">Produk</small></h4>
</div>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <button type='button' class='btn btn-sm btn-success mb-2' data-bs-toggle='modal'
            data-bs-target='#produkModal'><i class='bi bi-plus'></i>Tambah Data</button>
        <form id="formCari">
            <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control border border-primary" placeholder="Masukkan Nama Produk"
                    aria-label="Nama Produk" aria-describedby="produk-cari" id="keywordCari">
                <span class="input-group-text border border-primary">Cari</span>
            </div>
        </form>
    </div>
    <div class="table-responsive-sm">
        <table class="table" id="table_produk">
            <thead class="table-success">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    //saat dokumen ready, tambahkan data dari produk ke <tbody> /tabel body
    $(document).ready(() => {
        const setTabelData = (url = null) => {
            $.ajax({
                url: url ? url : '/api/produks',
                type: 'GET',
                success: function (response) {
                    const tbody = response.map((produk, index) => `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${produk.nama_produk}</td>
                            <td>${produk.deskripsi}</td>
                            <td><img src="${produk.foto}" alt="No_Image" width="64" height="64"/></td>
                            <td>${produk.nama_kategori}</td>
                            <td>
                                <button type='button' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#produkModal' data-bs-id='${produk.id}'><i class='bi bi-pencil-square'></i>Edit</button>
                                <button type='button' class='btn btn-sm btn-danger delete' data-bs-toggle='modal' data-bs-target='#produkModal' data-bs-id='${produk.id}'><i class='bi bi-trash'></i>Hapus</a>
                            </td>
                        </tr>
                    `).join('');
                    $('#table_produk tbody').append(tbody);
                }
            });
        }

        //init tabel data untuk pertama kali dokumen di load
        setTabelData();

        // ini javascript bagian form cari jika disubmit
        $('#formCari').submit((event) => {
            event.preventDefault();
            const keywordCari = $('#keywordCari').val();
            const url = `/api/produk/cari/${keywordCari}`;
            //kosongkan tabel 
            $('#table_produk tbody').html('');
            setTabelData(url);
        });

    });

    //ini javascript bagian modal
    const modalBody = $('.modal-body').html();

    $('#produkModal').on('shown.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const id = button.data('bs-id');

        $.ajax({
            url: '/api/produk/' + id,
            type: 'GET',
            success: function (response) {
                produk = response;
                let title = button.hasClass('delete') ? 'Hapus' : produk.id ? 'Edit' : 'Tambah';
                let formAction = button.hasClass('delete') ? `delete/${produk.id}` : produk.id ? 'update' : 'save';
                $('#modal-title').text(title);

                if (button.hasClass('delete')) {
                    $('.modal-body').html(`<p>Apakah anda yakin ingin menghapus data : <b class="text-danger">${produk.nama_produk}</b> ini ?</p>`);
                } else {
                    $('.modal-body').html(modalBody);
                    $('#id').val(produk.id || '');
                    $('#nama_produk').val(produk.nama_produk || '');
                    $('#deskripsi').val(produk.deskripsi || '');

                    $.ajax({
                        url: '/api/kategoris',
                        type: 'GET',
                        success: function (response) {
                            let kategoriSelect = $('#kategori_select');
                            kategoriSelect.empty();
                            kategoriSelect.append('<option>Pilih Kategori</option>');

                            response.forEach(function (kategori) {
                                kategoriSelect.append(`<option value="${kategori.id}" ${kategori.id == produk.kategori_id ? 'selected' : ''}>${kategori.nama_kategori}</option>`);
                            });
                        }
                    });
                }

                $('form#modal-form').attr('action', "/dashboard/<?= $page ?>/" + formAction);
                $('button[type="submit"]').removeClass('invisible');
                $('button[type="submit"]').text(title);
            }
        });
    });

</script>