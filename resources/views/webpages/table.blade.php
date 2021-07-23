<div class="table-responsive">
    <table class="table" id="webpages-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($webpages as $webpage)
            <tr>
                <td>{{ $webpage->name }}</td>
                <td>
                    {!! Form::open(['route' => ['webpages.destroy', $webpage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('webpages.show', [$webpage->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('webpages.edit', [$webpage->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
