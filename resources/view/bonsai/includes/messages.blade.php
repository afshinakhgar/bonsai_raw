@if(isset($messages['error']))
<div>
    <ul class="alert alert-danger alert-dismissible" role="alert">
    @foreach($messages['error'] as $error)
        <ol>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

            <strong></strong> {!! $error !!}
        </ol>
    @endforeach
    </ul>
</div>
@endif



@if(isset($messages['success']))
    <div>
        <ul class="alert alert-success alert-dismissible" role="alert">
            @foreach($messages['success'] as $message)
                <ol>
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

                    <strong></strong> {!! $message !!}
                </ol>
            @endforeach
        </ul>
    </div>
@endif