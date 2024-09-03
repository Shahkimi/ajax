@foreach ($gred as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->kod_gred }}</td>
        <td>{{ $item->desc_gred }}</td>
        <td>
            <a href="javascript:void(0)" onClick="viewFunc({{ $item->id }})"
               class="btn btn-primary btn-sm">Lihat</a>
            <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})"
               class="btn btn-success btn-sm">Kemaskini</a>
            <a href="javascript:void(0)" onClick="deleteFunc({{ $item->id }})"
               class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
@endforeach
