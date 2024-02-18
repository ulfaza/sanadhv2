{{ csrf_field() }}
<style>
  table {
    border-collapse: collapse;
    font-size: 12px;
  }

  table, th, td {
    border: 1px solid black;
  }

  th {
    background-color: #ddd;
  }
</style>
<h4>
	Rekapitulasi Kartu Hijau <br>
	@foreach($ujikh as $u)
	{{ $u->tingkat }} {{ $u->k_nama }} <br>
	{{ $u->kh_nama }} {{ $u->th_ajaran }} {{ $u->smt }} <br>
	{{ Auth::user()->nama }}
	@endforeach
</h4>
<table>
	<thead>
		<tr>
			<th>No</th>
			<th>NIS</th>
            <th id="siswa">Nama Siswa</th>
            <th>{{ $aspek1 }} Max:{{ $max_a1 }}</th>
            <th>{{ $aspek2 }} Max:{{ $max_a2 }}</th>
            <th>{{ $aspek3 }} Max:{{ $max_a3 }}</th>
            <th>{{ $aspek4 }} Max:{{ $max_a4 }}</th>
            <th>Total</th>
        </tr>
	</thead>

	<tbody>
		@foreach($rekapkh as $row)
		<tr>
			<td>{{$no++}}</td>
			<td>{{ $row->nis }}</td>
			<td>{{ $row->s_nama }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>