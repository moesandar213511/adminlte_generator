<div class="table-responsive">
    <table class="table" id="ads-table">
        <thead>
            <tr>
                <th>Photo</th>
        <th>Name</th>
        <th>Webpage</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($webpage_arr as $data)
            <tr>
            <td><img width="100px" height="100px" src="{{asset('/upload/ads/'.$data->photo)}}" alt=""></td>
            <td>{{ $data->name }}</td>
            <td>@foreach ($data['webpages'] as $webpage)
                {{ $webpage }}<br>
                @endforeach
            </td>
                <td>
                    {!! Form::open(['route' => ['ads.destroy', $data->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ads.show', [$data->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('ads.edit', [$data->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
