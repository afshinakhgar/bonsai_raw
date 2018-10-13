
@if(isset($messages['error']))

    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> خطا</h4>
        @foreach($messages['error'] as $error)

            @if(is_array($error))
                @foreach($error as $row)
                    <ol >

                    @foreach($row as $rowD)

                        {{$rowD}}

                    @endforeach
                    </ol>

                @endforeach

            @else
                <ol >

                {!! $error !!}
                </ol>
            @endif
        @endforeach
    </div>
@endif


@if(isset($messages['success']))

    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        @foreach($messages['success'] as $message)
            <ol >
                <i class="icon fa fa-check-circle"></i>{!! $message !!}
            </ol>
        @endforeach
    </div>
@endif



