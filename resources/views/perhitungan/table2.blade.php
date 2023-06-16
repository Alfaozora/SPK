<!-- Tabel kedua -->
<table class="table table-bordered table-striped table-hover" id="table2">
    <thead class="text-center" style="vertical-align:middle;">
        <tr>
            <th>
                Kriteria
            </th>
            @foreach($kriterias as $kriteria)
            <th class="text-center" style="vertical-align:middle;">{{$kriteria->nama_kriteria}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-center" style="vertical-align:middle;">
        @php
        $no = 0;
        @endphp
        @foreach($kriterias as $kriteria)
        <tr>
            <td class="text-left" style="vertical-align:middle;">{{$kriteria->nama_kriteria}}</td>
            @foreach($kriterias as $kriteria2)
            <td class="text-center" style="vertical-align:middle;">
                @if($kriteria->kode_kriteria == $kriteria2->kode_kriteria)
                1
                @else
                @if($kriteria->kode_kriteria > $kriteria2->kode_kriteria)
                <input class="form-control form-control-sm text-center" type="text" name="nilai[{{$kriteria->kode_kriteria}}][{{$kriteria2->kode_kriteria}}]" value="0" readonly="">
                @else
                <select class="form-control form-control-sm" name="nilai[{{$kriteria->kode_kriteria}}][{{$kriteria2->kode_kriteria}}]">
                    @foreach ($nilaiintensitas as $n)
                    <option value="{{$n->jum_nilai}}">{{$n->keterangan}}</option>
                    @endforeach
                </select>
                @endif
                @endif
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>