@extends('layouts.admin.app')

@section('title', 'Kelas Diampu')

@section('content')

    <p>Tahun Ajaran: <strong>{{ $tahunAktif->tahun_ajaran ?? '-' }}</strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Praktikum</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelas as $k)
                <tr>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->matkulDibuka->matkul->nama_matkul ?? '-' }}</td>
                    <td>{{ $k->matkulDibuka->matkul->bobot_sks ?? '-' }}</td>
                    <td>{{ ($k->matkulDibuka->matkul->praktikum ?? 0) ? 'Ya' : 'Tidak' }}</td>
                    
                    <td>
                        <a href="{{ route('dosen.kelasDiampu.show', $k->id) }}" class="btn btn-primary btn-sm">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada kelas diampu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
