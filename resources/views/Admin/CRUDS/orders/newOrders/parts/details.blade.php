<tr id="tr-{{$id}}">
    {{--                <th>1</th>--}}
    <th>
        <select required  class="form-control" name="item_id[]">
            <option selected disabled>choice Item</option>

            @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->title}} </option>

            @endforeach

        </select>
    </th>
    <th>
        <select required  class="form-control" name="type_id[]">
            <option selected disabled>choice Type</option>

            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->title}} </option>

            @endforeach

        </select>
    </th>
    <th>
        <select required  class="form-control" name="stage_id[]">
            <option selected disabled>choice Stage</option>

            @foreach($stages as $stage)
                <option value="{{$stage->id}}">{{$stage->title}} </option>

            @endforeach

        </select>
    </th>
    <th>
        <input type="number" name="amount[]" class="form-control" min="1" value="1">
    </th>
    <th>
        <button class="btn rounded-pill btn-danger waves-effect waves-light delete-sup"
                data-id="{{$id}}">
                    <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
        </button>
    </th>
</tr>
