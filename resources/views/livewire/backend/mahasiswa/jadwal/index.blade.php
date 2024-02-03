@section('app.title', 'Comment')

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List Jadwal Kelas</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="input_nim" id="input_nim"
                            placeholder="Input NIM or blank to set current login" wire:model='input_nim'>

                        <button type="button" class="btn icon icon-left btn-primary" id="btn_load" wire:click='getData'><i
                                class="fas fa-sync"></i>
                            Load</button>
                        <button type="button" class="btn icon icon-left btn-danger" id="btn_update" wire:click='updateData'><i
                                class="fas fa-exclamation"></i>
                            Update</button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table-striped table-hover table" id="tbl_list">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">No.</th>
                            <th colspan="2" style="text-align: center; vertical-align: middle;">Mata Kuliah</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">Hari</th>
                            <th colspan="2" style="text-align: center; vertical-align: middle;">Jam</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">Dosen</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">Action</th>
                        </tr>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">Kode</th>
                            <th style="text-align: center; vertical-align: middle;">Nama</th>
                            <th style="text-align: center; vertical-align: middle;">Mulai</th>
                            <th style="text-align: center; vertical-align: middle;">Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_data as $val)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{  $loop->iteration }}</td>
                                <td>{{ $val['kelas_kode'] }}</td>
                                <td>{{ $val['matkul_nama'] }}</td>
                                <td>{{ $val['hari_nama'] }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ $val['jadwal_mulai'] }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ $val['jadwal_selesai'] }}
                                </td>
                                <td>{{ $val['dosen_nama'] }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ $val['act'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Resources --}}
{{-- External Code --}}
@section('private.css.file')

@endsection

@section('private.js.file')

@endsection

{{-- Internal Code --}}
@section('private.css.code')

@endsection

@section('private.js.code')

    <script></script>

@endsection
