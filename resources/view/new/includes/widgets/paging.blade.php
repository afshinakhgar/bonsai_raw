<style>
    li a.active{
        color: #000;
        opacity: 0.4;
    }
</style>
@if($pagination['needed'])
    @for($i=1;$i<=$pagination['lastpage'];$i++)
    <li><a class="@if ($i == $pagination['page']) active @endif item" href="?page={{ $i }}">{{ $i }}</a></li>
    @endfor
@endif
