<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">variant</th>
            <th scope="col">price</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $all_data as $row )
        <tr>
            <th>{{ $row->title }}</th>
            <td>{{ $row->description }}</td>
            <td>{{ $row->productViriant->variant }}</td>
            <td>{{ $row->productViriantPrice->price }}</td>
            <td> <a href="{{ route('product.edit') }}" class="btn btn-success">Edit</a> </td>
        </tr>
        @endforeach


    </tbody>
</table>
