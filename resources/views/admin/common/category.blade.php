<div>
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        @foreach($categories as $key => $category)
            <li role="presentation" @if($key == 0) class="active" @endif>
                <a href="#categoty-{{$category->id}}" role="tab">{{$category->name}}</a>
            </li>
        @endforeach
    </ul>
    <div id="myTabContent" class="tab-content">
        @foreach($categories as  $key => $category)
            <div role="tabpanel" class="tab-pane @if($key == 0) active @endif in" id="categoty-{{$category->id}}">
                @foreach($category->children as $child)
                    <div class="col-md-4">
                        <label class="checkbox-inline ng-scope">
                            <input type="checkbox"
                                value="{{$child->id}}"
                                name="category_ids[]"
                                {{in_array($child->id, $ownerCategoryIds) ? 'checked' : null}}>
                            <span class="ng-binding">{{$child->name}}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
