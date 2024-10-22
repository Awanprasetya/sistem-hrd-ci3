<style>
  /* Gradient background untuk tabel */
  #example {
    background: linear-gradient(to right, #4e73df, #2e59d9); /* Gradient biru */
    color: white;
  }
  #example thead {
    background: linear-gradient(to right, #4e73df, #2e59d9); /* Warna header tabel */
  }
  #example tbody tr {
    background: rgba(255, 255, 255, 0.1); /* Efek transparan untuk baris tabel */
  }
  #example tbody tr:hover {
    background: rgba(255, 255, 255, 0.2); /* Efek hover saat baris disorot */
  }

  /* Ubah warna teks untuk tabel */
  #example th, #example td {
    color: white; /* Menjaga warna teks putih */
  }
  #example td {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Border bawah baris tabel */
  }
   /* Mengubah ukuran tombol pada tabel */
   #example .btn {
    padding: 10px 20px; /* Mengubah ukuran tombol */
    font-size: 14px; /* Mengatur ukuran teks dalam tombol */
    border-radius: 25px; /* Membuat tombol berbentuk rounded */
  }

  /* Menambahkan padding lebih pada tombol action */
  #example .btn-sm {
    padding: 8px 15px; /* Ukuran tombol kecil */
    font-size: 13px; /* Ukuran font lebih kecil */
    border-radius: 25px; /* Menjaga bentuk rounded */
  }

  /* Menambahkan efek hover pada tombol */
  #example .btn:hover {
    opacity: 0.9; /* Efek transparansi saat tombol dihover */
    transition: 0.3s; /* Animasi halus saat hover */
  }

  /* Mengatur warna tombol untuk aksi */
  #example .btn-primary {
    background-color:mediumseagreen;
    border-color: #4e73df;
  }
  #example .btn-warning {
    background-color: #f6c23e;
    border-color: #f6c23e;
  }
  #example .btn-danger {
    background-color: #e74a3b;
    border-color: #e74a3b;
  }

  /* Menjaga agar tombol tetap konsisten saat loading atau disabled */
  #example .btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
  #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.8);
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .spinner {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="loading">
  <div class="spinner"></div>
</div>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Sisa Cuti</h1>
  </div>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Data Sisa Cuti</a></li>
  </ol>

  <?php
  $success = $this->session->flashdata('success');
  $error = $this->session->flashdata('error');
  $this->session->unset_userdata('success');
  $this->session->unset_userdata('error');
  ?>

  <!-- Flash Messages -->
  <?php if(!empty($success)): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo $success; ?>',
        showConfirmButton: true
      });
    </script>
  <?php endif; ?>

  <?php if(!empty($error)): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo $error; ?>',
        showConfirmButton: true
      });
    </script>
  <?php endif; ?>

  <div class="row mb-3">
    <div class="col">
      <a class="btn btn-outline-primary" href="<?php echo base_url().'c_cuti/index'?>" >Kembali</a>
      <a class="btn btn-outline-warning" href="<?php echo base_url().'c_cuti/sisa_cuti_export_excel'?>"><i class="fa fa-print"></i>&nbsp;Export To Excel</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-9">
          <h6 class="m-0 font-weight-bold text-primary">Data Sisa Cuti</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <div class="row mb-3">
                  <div class="col-lg-3">
                  <form id="filterForm" method="POST" action="<?php echo base_url('c_cuti/v_sisa_cuti/'); ?>">
                    <div class="input-group mb-3">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                

                  </div>
              </div>
            <table id="example" class="table table-bordered Datatables">
              <thead>
                <tr style="font-size:small;">
                  <th>No.</th>
                  <th>No&nbsp;Finger</th>
                  <th>Nama</th>
                  <th>Tahun</th>
                  <th>Jatah&nbsp;Cuti</th>
                  <th>Sisa&nbsp;Cuti</th>
                  <th>Status</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_cuti as $n ){
                ?>
                <tr style="font-size:x-small;">
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->nm_karyawan; ?></td>
                  <td><?= $n->tahun; ?></td>
                  <td><?= $n->jatah_cuti; ?></td>
                  <td><?= $n->sisa_cuti; ?></td>
                  <td style="font-size: 15px;"><?php if($n->status_cuti == 'Masih Ada Cuti'){ ?>
                    <span class="badge badge-pill badge-success"><?php echo $n->status_cuti?></span>
                  <?php }else{?>
                    <span class="badge badge-pill badge-danger"><?php echo $n->status_cuti?></span>

                    <?php }?>
                  </td>
                  <!-- <td>
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id_cuti?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteCuti('<?php echo $n->id_cuti; ?>')">Hapus</button>
                  </td>
                 -->
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
<script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>
<script>
  new DataTable('#example');
</script>

<script>
function deleteCuti(id_cuti) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data ini tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke fungsi delete di controller
            window.location.href = "<?php echo base_url('c_cuti/delete/'); ?>" + id_cuti;
        }
    });
}
</script>
<script>
  // Tampilkan loading saat halaman dimuat
  $(window).on('load', function() {
    // Hilangkan loading setelah halaman selesai dimuat
    $('#loading').fadeOut('slow');
  });
</script>