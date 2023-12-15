<?php
require_once 'Models/Produk.php';
require_once 'Models/Kategori.php';

class ProdukController
{

    private $produkModel;

    public function __construct()
    {
        $this->produkModel = new Produk();
    }

    public function index()
    {
        view('dashboard/index', ['page' => 'produk']);
    }

    public function save()
    {
        $foto = $_FILES['foto'] ?? null;

        if ($foto && $foto['size'] > 1024 * 1024) {
            $message = [
                'tipe' => 'error',
                'pesan' => 'Kesalahan : Ukuran Foto Maksimal 1024kb',
            ];
        } else {
            $result = $this->produkModel->store($_POST);

            if ($result === true) {
                $message = [
                    'tipe' => 'success',
                    'pesan' => 'Data berhasil disimpan!',
                ];

                if ($foto) {
                    $this->produkModel->uploadfoto($this->produkModel->getConn()->lastInsertId(), $foto);
                }
            } else {
                $message = [
                    'tipe' => 'error',
                    'pesan' => $result->errorInfo['2'],
                ];
            }
        }

        $_SESSION['flash_message'] = $message ?? null;
        header('Location: /dashboard/produks');
    }

    public function update()
    {
        $foto = $_FILES['foto'] ?? null;

        if ($foto && $foto['size'] > 1024 * 1024) {
            $message = [
                'tipe' => 'error',
                'pesan' => 'Kesalahan : Ukuran Foto Maksimal 1024kb',
            ];
        } else {
            $result = $this->produkModel->edit($_POST);

            if ($result === true) {
                $message = [
                    'tipe' => 'success',
                    'pesan' => 'Data berhasil diubah!',
                ];

                if ($foto) {
                    $this->produkModel->uploadfoto($_POST['id'], $foto);
                }
            } else {
                $message = [
                    'tipe' => 'error',
                    'pesan' => $result->errorInfo['2'],
                ];
            }
        }

        $_SESSION['flash_message'] = $message ?? null;
        header('Location: /dashboard/produks');
    }

    public function delete($id)
    {
        $result = $this->produkModel->destroy($id);
        if ($result === true) {
            $message = [
                'tipe' => 'success',
                'pesan' => 'Data berhasil dihapus!',
            ];
        } else {
            // Pesan error diambil dari PDO Exception pada Model yang menangani
            $message = [
                'tipe' => 'error',
                'pesan' => $result->errorInfo['2'],
            ];
        }

        $_SESSION['flash_message'] = $message;
        header('Location: /dashboard/produks');
    }

}

?>