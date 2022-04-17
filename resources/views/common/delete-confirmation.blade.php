<!--
Params
    target
    Action
    Title
    Content
-->
<div class="modal fade" id="{{$target}}">

<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" action="{{$action}}" >
        <div class="modal-header">
            <h4 class="modal-title">
                @if(isset($title))
                    {{$title}}
                @else
                    <span>Really want to delete?</span>
                @endif
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            @if(isset($content))
                <p>{{$content}}</p>
            @else
                <p>Are you sure you want to delete?</p>
            @endif
        </div>
        <div class="modal-footer justify-content-between">
            @csrf()
            @method('DELETE')
            <button type="submit" class="btn btn-danger" >Delete</button>
            <button type="button" data-dismiss="modal" class="btn btn-success">Cancel</button>
        </div>
    </form>
    </div>
</div>
</div>