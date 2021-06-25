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
                                            <div class="col-9">
                                                <form>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <select class="form-control" id="pabrik" name="utipe">
                                                            @foreach ( $pg as $i )
                                                                <option value="{{ $i->nama_pg }}">{{ $i->nama_pg }}</option>
                                                            @endforeach
                                                            </select>
                                                            <select class="form-control" id="type" name="utipe">
                                                                <option value="SPT">SPT</option>
                                                                <option value="AMPERA">AMPERA</option>
                                                            </select>
                                                            <input type="text" class="form-control float-right" id="date-range" name="date" value="<?= date('Y-m-d') ?> / <?= date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-3">
                                                <button type="button" id="filter" class="btn btn-secondary text-bold"><i
                                                class="fas fa-filter"></i>&nbsp;Cari</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-secondary float-right text-bold" data-target="#modal-lg-tambah" data-toggle="modal"><i class="fas fa-plus"></i>&nbsp;Tambah </a>
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
                                                <th>Berat (Kwintal)</th>
                                                <th>Netto</th>
                                                <th>Harga</th>
                                                <th>Tanggal</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='list-data'>
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
                                                    <td>{{ formatRupiah($item->harga) }}</td>
                                                    <td>{{ formatTanggal($item->tanggal_keberangkatan) }}</td>
                                                    <td><a href="/transaksi/berangkat/cetak/{{ $item->id_keberangkatan }}" class="btn btn-primary text-bolds"><i class="fas fa-print"></i>&nbsp;Cetak</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <script src="{{ asset('Js/LaporanTransaksi.js') }}"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <script>
                    $('#date-range').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD',
                            separator: " / "
                        }
                    });
                </script>
            @endsection
