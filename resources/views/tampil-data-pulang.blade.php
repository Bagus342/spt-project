@extends('templates.template')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <form>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control float-right" id="search" name="date" value="">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-info">Cari</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="/pulang/view/cetak" class="btn btn-primary float-right text-bold ml-1"><i class="fas fa-print"></i>&nbsp;CETAK LAPORAN</a>
                                        <a href="/pulang/view/list" class="btn btn-success float-right text-bold"><i class="fas fa-plus"></i>&nbsp;TAMBAH</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabel_pemasukan" class="table table-bordered table-striped ">
                                        <thead>
                                            <tr>
                                                <th>Tipe</th>
                                                <th>No SP</th>
                                                <th>Wilayah</th>
                                                <th>Pemilik</th>
                                                <th>Petani</th>
                                                <th>Tujuan</th>
                                                <th>Berat timbang</th>
                                                <th>Netto</th>
                                                <th>Harga</th>
                                                <th>Tanggal</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) === 0)
                                                <td colspan="11" style="text-align: center;">DATA KOSONG</td>
                                            @else
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->tipe }}</td>
                                                        <td>{{ $item->no_sp }}</td>
                                                        <td>{{ $item->wilayah }}</td>
                                                        <td>{{ $item->nama_petani }}</td>
                                                        <td>{{ $item->nama_sopir }}</td>
                                                        <td>{{ $item->pabrik_tujuan }}</td>
                                                        <td>{{ $item->berat_timbang }}</td>
                                                        <td>{{ $item->netto }}</td>
                                                        <td>{{ $item->harga }}</td>
                                                        <td>{{ $item->tanggal_pulang }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning update" data-target="#modal-lg" data-toggle="modal" data-id="{{ $item->id_keberangkatan }}"> Edit</button>&nbsp;
                                                            <a href="/pulang/{{ $item->id_keberangkatan }}" class="btn btn-danger">Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

                <!-- COBA PANGGIL DATA MSQL -->
                <div class="row">
                    <!-- ISI -->
                </div>

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Modal -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">UPDATE DATA KEPULANGAN</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" id="form-update">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Pulang</label>
                            <input type="date" class="form-control" placeholder="Tanggal Pulang " name="tanggal_pulang">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Bongkar</label>
                            <input type="date" class="form-control" placeholder="Tanggal Bongkar " name="tanggal_bongkar">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">No Truk</label>
                            <input type="text" class="form-control" placeholder="No Truk " name="no_truk">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Berat Pulang</label>
                            <input type="text" class="form-control" placeholder="Berat Pulang " name="berat_pulang">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Refaksi</label>
                            <input type="text" class="form-control" placeholder="Refaksi " name="refaksi">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /Modal -->

    <script src="{{ asset('Js/GlobalPulang.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
@endsection
