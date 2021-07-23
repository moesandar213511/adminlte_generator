<div class="table-responsive">
    <table class="table" id="adsWebpages-table">
        <thead>
            <tr>
                <th>Ads Id</th>
        <th>Webpage Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($adsWebpages as $adsWebpage)
            <tr>
                <td>{{ $adsWebpage->ads_id }}</td>
            <td>{{ $adsWebpage->webpage_id }}</td>
                <td>
                    {!! Form::open(['route' => ['adsWebpages.destroy', $adsWebpage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adsWebpages.show', [$adsWebpage->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('adsWebpages.edit', [$adsWebpage->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
