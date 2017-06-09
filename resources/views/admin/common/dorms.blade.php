<div>
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        @foreach($dorms as $key => $dorm)
            <li role="presentation" @if($key == 0) class="active" @endif>
                <a href="#dorm-{{$dorm->id}}" role="tab">{{$dorm->name}}</a>
            </li>
        @endforeach
    </ul>
    <div id="myTabContent" class="tab-content">
        @foreach($dorms as  $key => $dorm)
            <div role="tabpanel" class="tab-pane @if($key == 0) active @endif in" id="dorm-{{$dorm->id}}">
                @foreach($dorm->children as $child)
                    <div class="col-md-4">
                        <label class="checkbox-inline ng-scope">
                            <input type="checkbox"
                                value="{{$child->id}}"
                                name="dorm_id"
                                {{in_array($child->id, $userDrom) ? 'checked' : null}}>
                            <span class="ng-binding">{{$child->name}}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
